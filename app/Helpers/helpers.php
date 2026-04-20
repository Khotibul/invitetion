<?php

use Carbon\Carbon;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Storage;

function clean_str(?string $data): string
{ // membuat URl format
	$data = str_replace(' ', '-', strtolower($data));
	return preg_replace('/[^A-Za-z0-9\-]/', '', $data);
}

function check_yt($params = null): string
{ // saring youtube
	$params_splited = explode('/', $params);
	if (in_array($params_splited[2], ['www.youtube.com', 'youtube.com']) && $params_splited[3]=='shorts') :
		$value = $params_splited[4];
	elseif (in_array($params_splited[2], ['www.youtube.com', 'youtube.com']) && $params_splited[3]!='shorts') :
		parse_str(parse_url($params, PHP_URL_QUERY), $data_url);
		$value = $data_url['v'];
	elseif (in_array($params_splited[2], ['youtu.be', 'www.youtu.be'])) :
		$value = $params_splited[3];
	else :
		$value = $params;
	endif;
	return $value;
}

function idr(string $params = null): string
{
	return "<sup class=\"text-muted\">Rp</sup>".number_format($params, 0, ',', '.');
}

function date_info($params = null): string
{
	if (!empty($params)) :
		$value = "<span class=\"d-block text-dark lh-1 small text-nowrap\">{$params->isoFormat('dddd, D MMMM Y')}</span>";
		if (Carbon::parse($params)->diffInDays(Carbon::now()) > 1) :
			$value .= "<small class=\"text-muted\">{$params->locale('id')->isoFormat('HH : mm')} WIB</small>";
		else :
			$value .= "<small>{$params->locale('id')->diffForHumans()}</small>";
		endif;
		return $value;
	else :
		return "-";
	endif;
}

function image_info($params = null): string
{
	return Storage::size($params);
}

function image_reducer($data, string $file_name): void
{
	$sizes = [
		'xs' => 60,
		'sm' => 280,
		'md' => 650,
	];

	foreach ($sizes as $key => $maxWidth) {
		try {
			$img = \Image::make($data);
			$ratio = $img->width() / $maxWidth;
			$w = (int) ($img->width() / $ratio);
			$h = (int) ($img->height() / $ratio);
			$img->resize($w, $h, function ($c) {
				$c->aspectRatio();
				$c->upsize();
			});
			$canvas = \Image::canvas($w, $h);
			$canvas->insert($img, 'center');
			// Simpan ke disk aktif (r2 atau public)
			Storage::disk(config('filesystems.default', 'public'))
				->put($key . '/' . $file_name, $canvas->encode()->getEncoded());
		} catch (\Exception $e) {
			// Fallback: simpan file asli tanpa resize
			Storage::disk(config('filesystems.default', 'public'))
				->put($key . '/' . $file_name, $data);
		}
	}
}

function isitsame($needle, $target): bool
{
	return ($needle==$target) ? true : false;	
}

function isexpired($needle, $days): bool
{
	return (Carbon::parse($needle)->addDays($days) >= now()) ? false : true;
}

function anchor(string $text = null, string $href = "#", array $class = [], array $data = [], bool $new_tab = false): string
{ // <a href>
	$class = implode(' ', $class);
	$new_tab = ($new_tab) ? '_BLANK' : '_SELF';
	$attribute = implode(' ', array_map(
		function ($v, $k) {
			if (is_array($v)) :
				return $k."[]=".implode('&'.$k."[]=", $v);
			else :
				return "data-$k=\"$v\"";
			endif;
		}, 
		$data, 
		array_keys($data)
	));
	return "<a href=\"{$href}\" class=\"{$class}\" target=\"{$new_tab}\" $attribute>{$text}</a>";
}

function image(string $src = null, string $alt = null, array $class = []): string
{ // <img src>
	$class = implode(' ', $class);
	return "<img src=\"{$src}\" alt=\"{$alt}\" class=\"{$class}\"/>";
}

function video(string $src = null, string $ogg = null, array $class = []): string
{
	$class = implode(' ', $class);
	$src_vid = "<source src=\"{$src}\" type=\"video/mp4\">" ?? null;
	$src_ogg = "<source src=\"{$ogg}\" type=\"video/ogg\">" ?? null;
	return "<video width=\"100%\" controls>{$src_vid}{$src_ogg}</video>";
}

function input_check(string $name = null, string $value = null, array $class = [], string $mode = 'single', string $label = null): string
{ // <input type>
	$class = implode(' ', $class);
	$idfor = "check".clean_str($value);
	$mode = ($mode=='single') ? 'radio' : 'checkbox';
	return "<input type=\"{$mode}\" name=\"{$name}\" id=\"{$idfor}\" class=\"{$class}\" value=\"{$value}\"/><label class=\"form-check-label\" for=\"{$idfor}\">{$label}</label>";
}


function get_preset_value($preset, $path, $default = null)
{
    // Helper to safely get nested preset values with fallback
    // Usage: get_preset_value($preset, 'profile.photo.male.image', 'default.png')
    
    $keys = explode('.', $path);
    $value = $preset;
    
    foreach ($keys as $key) {
        if (is_object($value) && isset($value->$key)) {
            $value = $value->$key;
        } elseif (is_array($value) && isset($value[$key])) {
            $value = $value[$key];
        } else {
            return $default;
        }
    }
    
    return $value ?? $default;
}

function ensure_preset_structure($preset)
{
    // Ensure preset has both profile and couple structures
    $presetArray = json_decode(json_encode($preset), true);
    
    // If couple exists but profile doesn't, create profile from couple
    if (isset($presetArray['couple']) && !isset($presetArray['profile'])) {
        $presetArray['profile'] = [
            'name' => [
                'male' => $presetArray['couple']['groom']['full_name'] ?? $presetArray['couple']['groom']['nickname'] ?? '',
                'female' => $presetArray['couple']['bride']['full_name'] ?? $presetArray['couple']['bride']['nickname'] ?? ''
            ],
            'instagram' => [
                'male' => $presetArray['couple']['groom']['instagram'] ?? '',
                'female' => $presetArray['couple']['bride']['instagram'] ?? '',
                'show' => true
            ],
            'parent' => [
                'male' => [
                    'father' => $presetArray['couple']['groom']['father_name'] ?? '',
                    'mother' => $presetArray['couple']['groom']['mother_name'] ?? '',
                    'childhood' => '1'
                ],
                'female' => [
                    'father' => $presetArray['couple']['bride']['father_name'] ?? '',
                    'mother' => $presetArray['couple']['bride']['mother_name'] ?? '',
                    'childhood' => '1'
                ],
                'show' => true
            ],
            'photo' => [
                'male' => [
                    'method' => 'avatar',
                    'frame' => null,
                    'image' => $presetArray['couple']['groom']['photo'] ?? '9d348c30-9331-11ec-b089-ad70ef6b2563.png'
                ],
                'female' => [
                    'method' => 'avatar',
                    'frame' => null,
                    'image' => $presetArray['couple']['bride']['photo'] ?? '4a1f7960-9331-11ec-8fa8-a3a23f6da840.png'
                ]
            ]
        ];
    }
    
    return json_decode(json_encode($presetArray));
}
