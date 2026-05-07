<?php

namespace App\Http\Controllers;

use App\Models\Strbox;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TemplateAssets;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
    
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
		$data = [
			'title'	=> 'template',
			'list'	=> route('template.list'),
			'create'=> ['action' => route('template.create')],
			'delete'=> ['action' => route('template.destroy', 0), 'message' => 'Hapus template?']
		];

		return response()->view('panel.template.index', compact('data'));
    }

    public function list(Request $request): JsonResponse
	{
		$totalFilteredRecord = $totalDataRecord = $draw_val = "";
		$column = [0 => 'id', 1 => 'title', 2 => 'info', 3 => 'log'];
		$totalDataRecord = Template::count();
		$totalFilteredRecord = $totalDataRecord;
		$limit_val	= $request->input('length');
		$start_val	= $request->input('start');
		if (empty($request->input('search.value'))) :
			$datatable = Template::offset($start_val)->orderBy('publish', 'DESC')->latest()->limit($limit_val)->get();
		else :
			$search_text = $request->input('search.value');
			$datatable =  Template::where('id', 'LIKE', "%{$search_text}%")->orWhere('title', 'LIKE', "%{$search_text}%")->offset($start_val)->limit($limit_val)->get();
			$totalFilteredRecord = Template::where('id', 'LIKE', "%{$search_text}%")->orWhere('title', 'LIKE', "%{$search_text}%")->count();
		endif;
		$data_val = [];
		if (!empty($datatable)) :
			foreach ($datatable as $key => $item) :
				$grade = ['title' => Str::title($item->grade), 'basic' => 'bg-gray', 'premium' => 'bg-info', 'exclusive' => 'bg-primary'];
				$publish = ['title' => Str::title($item->publish), 'publish' => 'd-none', 'draft' => 'bg-warning'];
				$data_val[$key]['id'] = null;
				$data_val[$key]['title'] = anchor(text:$item->title, href:route('template.edit', $item->id));
				$priceBadge = "<span class=\"badge bg-success me-2\">".strip_tags(idr((string) ($item->price ?? 0)))."</span>";
				$data_val[$key]['info'] = "<div class=\"d-flex\">{$priceBadge}<span class=\"badge me-2 {$grade[$item->grade]}\">{$grade['title']}</span><span class=\"badge {$publish[$item->publish]}\">{$publish['title']}</span></div>";
				$data_val[$key]['log'] = date_info($item->created_at);
			endforeach;
		endif;
		$draw_val = $request->input('draw');
		$get_json_data = ["draw" => intval($draw_val), "recordsTotal" => intval($totalDataRecord), "recordsFiltered" => intval($totalFilteredRecord), "data" => $data_val];

		return response()->json($get_json_data);
	}

	/**
	 * Halaman pengaturan harga template per grade.
	 */
	public function pricing(): Response
	{
		$templates = Template::select('id', 'title', 'slug', 'grade', 'price', 'publish', 'file', 'file_type')
			->orderBy('grade')
			->orderBy('title')
			->get()
			->groupBy('grade');

		$gradeMeta = [
			'basic'     => ['label' => 'Basic',     'color' => 'secondary', 'icon' => 'bx-star-o',    'desc' => 'Template gratis atau harga terjangkau'],
			'premium'   => ['label' => 'Premium',   'color' => 'info',      'icon' => 'bx-star-half', 'desc' => 'Template dengan fitur lengkap'],
			'exclusive' => ['label' => 'Exclusive', 'color' => 'warning',   'icon' => 'bxs-star',     'desc' => 'Template eksklusif premium'],
		];

		$data = ['title' => 'Harga Template'];

		return response()->view('panel.template.pricing', compact('data', 'templates', 'gradeMeta'));
	}

	/**
	 * Simpan harga per template (satu per satu atau massal via JSON).
	 */
	public function pricing_update(Request $request): JsonResponse
	{
		$request->validate([
			'updates'         => 'required|array',
			'updates.*.id'    => 'required|integer|exists:templates,id',
			'updates.*.price' => 'required|integer|min:0',
			'updates.*.grade' => 'required|in:basic,premium,exclusive',
		]);

		$updated = 0;
		foreach ($request->updates as $item) {
			Template::where('id', $item['id'])->update([
				'price' => (int) $item['price'],
				'grade' => $item['grade'],
			]);
			$updated++;
		}

		return response()->json([
			'toast'    => ['icon' => 'success', 'title' => 'Tersimpan', 'html' => "<b>{$updated}</b> template berhasil diperbarui"],
			'redirect' => ['type' => 'none'],
		]);
	}

	/**
	 * Terapkan harga seragam ke semua template dalam satu grade.
	 */
	public function pricing_bulk(Request $request): JsonResponse
	{
		$request->validate([
			'grade' => 'required|in:basic,premium,exclusive',
			'price' => 'required|integer|min:0',
		]);

		$count = Template::where('grade', $request->grade)->update(['price' => (int) $request->price]);

		return response()->json([
			'toast'    => ['icon' => 'success', 'title' => 'Tersimpan', 'html' => "<b>{$count}</b> template grade <b>" . ucfirst($request->grade) . "</b> diperbarui"],
			'redirect' => ['type' => 'reload'],
		]);
	}

	public function component(string $slug = 'avatar'): Response
	{
		$data = [
			'title'	=> $slug,
			'create'=> ['action' => route('template.component.store', $slug)],
			'delete'=> ['action' => route('template.component.destroy', $slug), 'message' => 'Hapus komponen?']
		];
		if ($slug=='avatar') :
			$component = TemplateAssets::select('id', 'type', 'title', 'content')->whereIn('type', ['avatar', 'avatar male', 'avatar female'])->get();
		elseif ($slug=='decoration') :
			$component = TemplateAssets::select('id', 'title', 'content')->whereIn('type', ['decoration'])->get();
		elseif ($slug=='frame') :
			$component = TemplateAssets::select('id', 'title', 'content')->whereIn('type', ['frame'])->get();
		elseif ($slug=='music') :
			$component = TemplateAssets::select('id', 'title', 'content', 'user_id')->with('user')->whereIn('type', ['music'])->get();
		elseif ($slug=='quote') :
			$component = TemplateAssets::select('id', 'title', 'content')->whereIn('type', ['quote'])->get();
		endif;

		return response()->view('panel.template.component', compact('data', 'component'));
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $data = [
			'title'	=> 'tambah template',
			'form' => ['action' => route('template.store'), 'class' => 'form-insert'],
		];

		return response()->view('panel.template.form', compact('data'));
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
			'title'		=> 'required|max:110',
			'file_type'	=> 'required',
			'grade'	    => 'required',
			'price'		=> 'nullable|integer|min:0',
		],
		[
			'required'	=> '<code>:attribute</code> harus diisi.',
			'max'		=> '<code>:attribute</code> tidak boleh lebih dari <b>:max</b> huruf.'
		]);
        $column = [
			'title'		=> $request->title,
			'slug'		=> clean_str($request->title),
			'preset'	=> json_encode([]),
			'url'		=> 'no-file',
            'grade'     => $request->grade,
			'price'		=> $request->price ?? 0,
			'publish'	=> 'draft',
			'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
			'user_id'	=> Auth::user()->id
		];
        if ($request->file_type == 'upload-file') :
			$this->validate($request, ['upload_file' => 'required|mimes:jpg,jpeg,png'], ['mimes' => 'hanya file <b>jpg, jpeg</b> atau <b>png</b> saja.']);
			if ($request->hasFile('upload_file')) :
				$image_name = $request->file('upload_file')->hashName();
				$imageData  = file_get_contents($request->file('upload_file')->getRealPath());
				Storage::disk('public')->put($image_name, $imageData);
				try { image_reducer($imageData, $image_name); } catch (\Throwable $e) {}
				$column['file']	= $image_name;
				$column['file_type'] = 'image';
				Strbox::create(['title' => $request->title, 'file' => $image_name, 'file_type' => 'image', 'user_id' => Auth::user()->id, 'ip_addr' => $_SERVER['REMOTE_ADDR']]);
			endif;
		elseif ($request->file_type == 'image') :
			$this->validate($request, ['file' => 'required'], ['required' => '<code>:attribute</code> harus diisi.']);
			$column['file']	= $request->file;
			$column['file_type'] = 'image';
		endif;
		Template::create($column);

        return response()->json([
			'toast'		=> ['icon' => 'success', 'title' => ucfirst('disimpan'), 'html' => "\"<b>{$request->title}</b>\" telah ditambahkan"],
			'redirect'	=> ['type' => 'assign', 'value' => route('template.index')]
		]);
    }

	public function component_store(Request $request, string $slug = 'avatar'): JsonResponse
	{
		$this->validate($request, [
			'title'	=> 'required|max:110'
		],
		[
			'required'	=> '<code>:attribute</code> harus diisi.',
			'max'		=> '<code>:attribute</code> tidak boleh lebih dari <b>:max</b> huruf.'
		]);
		$column = [
			'title'		=> $request->title,
			'publish'	=> 'publish',
			'user_id'	=> Auth::user()->id,
			'ip_addr'	=> $_SERVER['REMOTE_ADDR']
		];
		if ($slug=='avatar') :
			$this->validate($request, ['file' => 'required|image|mimes:jpg,jpeg,png'], ['mimes' => 'hanya file <b>jpg, jpeg</b> atau <b>png</b> saja.']);
			$file_name = $request->file('file')->hashName();
			Storage::disk('public')->put('avatar/'.$file_name, file_get_contents($request->file('file')));
			$column['type'] = $request->which_gender;
			$column['content'] = $file_name;
		elseif ($slug=='decoration') :
			$this->validate($request, ['file' => 'required|image|mimes:jpg,jpeg,png'], ['mimes' => 'hanya file <b>jpg, jpeg</b> atau <b>png</b> saja.']);
			$file_name = $request->file('file')->hashName();
			Storage::disk('public')->put('decoration/'.$file_name, file_get_contents($request->file('file')));
			$column['type'] = 'decoration';
			$column['content'] = $file_name;
		elseif ($slug=='frame') :
			$this->validate($request, ['file' => 'required|image|mimes:jpg,jpeg,png'], ['mimes' => 'hanya file <b>jpg, jpeg</b> atau <b>png</b> saja.']);
			$file_name = $request->file('file')->hashName();
			Storage::disk('public')->put('frame/'.$file_name, file_get_contents($request->file('file')));
			$column['type'] = 'frame';
			$column['content'] = $file_name;
		elseif ($slug=='music') :
			// $this->validate($request, ['file' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav']);
			$this->validate($request, ['file' => 'required']);
			$file_name = $request->file('file')->hashName();
			Storage::disk('public')->put('audio/'.$file_name, file_get_contents($request->file('file')));
			$column['type'] = 'music';
			$column['content'] = $file_name;
		elseif ($slug=='quote') :
			$column['type'] = 'quote';
			$column['content'] = $request->content;
		endif;
		TemplateAssets::create($column);

		return response()->json([
			'toast'		=> ['icon' => 'success', 'title' => ucfirst('disimpan'), 'html' => "\"<b>{$request->title}</b>\" telah ditambahkan"],
			'redirect'	=> ['type' => 'reload']
		]);
	}

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
		$font = TemplateAssets::select('title', 'content')->whereType('font')->publish()->get();
		$male = TemplateAssets::select('title', 'content')->publish()->whereType('avatar male')->get();
		$female = TemplateAssets::select('title', 'content')->publish()->whereType('avatar female')->get();
		$data = [
			'title'	=> 'edit template',
			'form'	=> ['action' => route('template.update', $template), 'class' => 'form-update'],
			'font'	=> $font,
			'avatar-male' => $male,
			'avatar-female' => $female,
		];
		// Decode preset untuk view — simpan string asli di $template->preset_raw
		// agar update() bisa membaca string JSON yang benar
		$template->preset_raw = $template->preset; // string JSON asli
		$template->preset = json_decode($template->preset); // object untuk view

		return response()->view('panel.template.form', compact('data', 'template'));
    }

    /**
     * Upload foto sampul template via AJAX — endpoint terpisah dari form utama.
     * Dipanggil dari JS saat admin memilih foto sampul.
     */
    public function cover_upload(Request $request): JsonResponse
    {
        $this->validate($request, [
            'cover_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'required' => 'File foto sampul harus dipilih.',
            'image'    => 'File harus berupa gambar.',
            'mimes'    => 'Hanya file JPG atau PNG yang diizinkan.',
            'max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $file     = $request->file('cover_file');
        $fileName = $file->hashName();
        $fileData = file_get_contents($file->getRealPath());

        // Simpan file asli ke root storage (tanpa subfolder)
        Storage::disk('public')->put($fileName, $fileData);

        // image_reducer membuat xs/, sm/, md/ secara otomatis dari $fileName
        try {
            image_reducer($fileData, $fileName);
        } catch (\Throwable $e) {
            // Jika image_reducer gagal, file asli tetap tersimpan
        }

        // Catat di Strbox agar muncul di storage admin
        Strbox::create([
            'title'     => 'Cover: '.pathinfo($fileName, PATHINFO_FILENAME),
            'file'      => $fileName,
            'file_type' => 'image',
            'user_id'   => Auth::user()->id,
            'ip_addr'   => $_SERVER['REMOTE_ADDR'],
        ]);

        return response()->json([
            'success' => true,
            'file'    => $fileName,
            'url'     => url('storage/sm/'.$fileName),
            'message' => 'Foto sampul berhasil diunggah.',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template): JsonResponse
    {
        $this->validate($request, [
			'title'		=> 'required|max:110',
			'file_type'	=> 'required',
			'grade'	    => 'required',
			'price'		=> 'nullable|integer|min:0',
		],
		[
			'required'	=> '<code>:attribute</code> harus diisi.',
			'max'		=> '<code>:attribute</code> tidak boleh lebih dari <b>:max</b> huruf.'
		]);

        $column = [
			'title'		=> $request->title,
			'slug'		=> clean_str($request->title),
            'grade'     => $request->grade,
			'price'		=> $request->price ?? 0,
			'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
			'user_id'	=> Auth::user()->id,
		];

		// ── Preset: baca ulang dari DB sebagai string JSON murni
		// (menghindari masalah jika $template->preset sudah di-decode menjadi object di edit())
		$freshPresetJson = Template::where('id', $template->id)->value('preset');
		$preset = json_decode($freshPresetJson ?: '{}', true) ?: [];

		$preset['design']['title']['color']       = $request->title_color;
		$preset['design']['title']['font']        = $request->title_font;
		$preset['design']['content']['color']     = $request->content_color;
		$preset['design']['content']['font']      = $request->content_font;
		$preset['design']['button']['color']      = $request->button_color;
		$preset['design']['button']['background'] = $request->button_background;
		$preset['design']['background']           = $request->background;
		// Foto pasangan: simpan image dan pastikan method = 'avatar' (dropdown avatar)
		$preset['profile']['photo']['male']['image']    = $request->photo_male;
		$preset['profile']['photo']['male']['method']   = 'avatar';
		$preset['profile']['photo']['female']['image']  = $request->photo_female;
		$preset['profile']['photo']['female']['method'] = 'avatar';

		// ── Foto sampul default — sudah diupload via AJAX, tinggal simpan method+file
		$coverMethod = $request->input('cover_image_method', '');
		$coverFile   = $request->input('cover_image_file', '');

		if ($coverMethod === 'storage' && !empty($coverFile)) {
			// File sudah ada di storage/sm/ (diupload via cover_upload endpoint)
			$preset['cover']['description']['image'] = [
				'method' => 'storage',
				'image'  => $coverFile,
			];
		} elseif ($coverMethod === 'none') {
			$preset['cover']['description']['image'] = [
				'method' => 'none',
				'image'  => '',
			];
		}
		// Jika cover_image_method kosong/tidak diisi → biarkan preset cover tidak berubah

		$column['preset'] = json_encode($preset);

		// ── Publish
		if ($template->url !== 'no-file') {
			$column['publish'] = ($request->publish === 'publish') ? 'publish' : 'draft';
		}

		// ── Thumbnail kartu template (file utama)
        if ($request->file_type === 'upload-file') {
			$this->validate($request, [
				'upload_file' => 'required|mimes:jpg,jpeg,png',
			], ['mimes' => 'hanya file <b>jpg, jpeg</b> atau <b>png</b> saja.']);
			if ($request->hasFile('upload_file')) {
				$image_name = $request->file('upload_file')->hashName();
				$imageData  = file_get_contents($request->file('upload_file')->getRealPath());
				Storage::disk('public')->put($image_name, $imageData);
				try { image_reducer($imageData, $image_name); } catch (\Throwable $e) {}
				$column['file']      = $image_name;
				$column['file_type'] = 'image';
				Strbox::create([
					'title'     => $request->title,
					'file'      => $image_name,
					'file_type' => 'image',
					'user_id'   => Auth::user()->id,
					'ip_addr'   => $_SERVER['REMOTE_ADDR'],
				]);
			}
		} elseif ($request->file_type === 'image') {
			$this->validate($request, ['file' => 'required'], ['required' => '<code>:attribute</code> harus diisi.']);
			$column['file']      = $request->file;
			$column['file_type'] = 'image';
		}

		$template->update($column);

        return response()->json([
			'toast'		=> ['icon' => 'success', 'title' => ucfirst('disimpan'), 'html' => "\"<b>{$request->title}</b>\" telah disimpan"],
			'redirect'	=> ['type' => 'assign', 'value' => route('template.index')],
		]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        //
    }

	public function component_destroy(Request $request, string $slug = 'avatar'): JsonResponse
    {
        $ids = explode(',', $request->id);
		$ids_count = count($ids);
		foreach (TemplateAssets::whereIn('id', $ids)->get() as $item) :
			if (in_array($item->type, ['avatar', 'avatar male', 'avatar female'])) :
				if (Storage::disk('public')->exists('avatar/'.$item->content)) :
					Storage::disk('public')->delete('avatar/'.$item->content);
				endif;
			elseif (in_array($item->type, ['decoration'])) :
				if (Storage::disk('public')->exists('decoration/'.$item->content)) :
					Storage::disk('public')->delete('decoration/'.$item->content);
				endif;
			elseif (in_array($item->type, ['frame'])) :
				if (Storage::disk('public')->exists('frame/'.$item->content)) :
					Storage::disk('public')->delete('frame/'.$item->content);
				endif;
			elseif (in_array($item->type, ['music'])) :
				if (Storage::disk('public')->exists('audio/'.$item->content)) :
					Storage::disk('public')->delete('audio/'.$item->content);
				endif;
			endif;
			TemplateAssets::whereId($item->id)->delete();
		endforeach;

		return response()->json([
			'toast'		=> ['icon' => 'success', 'title' => ucfirst('dihapus'), 'html' => "<b>{$ids_count}</b> data telah buang"],
			'redirect'	=> ['type' => 'reload']
		]);
	}
}
