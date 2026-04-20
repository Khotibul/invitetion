<?php

namespace App\Http\Controllers\Member;

use App\Models\Strbox;
use App\Models\Package;
use App\Models\Feedback;
use App\Models\Template;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AccountInvoice;
use App\Models\TemplateAssets;
use App\Models\InvitationEvent;
use App\Models\InvitationGuest;
use App\Models\InvitationStory;
use App\Models\InvitationGallery;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class InvitationController extends Controller
{
	private $menu = [
		'design' => [
			'id'	=> 'design',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'ubah desain',
			'notif'	=> 0,
			'url'	=> 'menu.design'
		],
		'cover' => [
			'id'	=> 'cover',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'sampul undangan',
			'notif'	=> 0,
			'url'	=> 'menu.cover',
		],
		'profile' => [
			'id'	=> 'profile',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'profil pasangan',
			'notif'	=> 0,
			'url'	=> 'menu.profile',
		],
		'detail' => [
			'id'	=> 'detail',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'detail undangan',
			'notif'	=> 0,
			'url'	=> 'menu.detail',
		],
		'quote' => [
			'id'	=> 'quote',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'quote',
			'notif'	=> 0,
			'url'	=> 'menu.quote',
		],
		'event' => [
			'id'	=> 'event',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'sesi acara',
			'notif'	=> 0,
			'url'	=> 'menu.event',
		],
		'story' => [
			'id'	=> 'story',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'kisah cinta',
			'notif'	=> 0,
			'url'	=> 'menu.story',
		],
		'gallery' => [
			'id'	=> 'gallery',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'galeri',
			'notif'	=> 0,
			'url'	=> 'menu.gallery',
		],
		'music' => [
			'id'	=> 'music',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'musik',
			'notif'	=> 0,
			'url'	=> 'menu.music',
		],
		'rsvp' => [
			'id'	=> 'rsvp',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'rsvp',
			'notif'	=> 0,
			'url'	=> 'menu.rsvp',
		],
		'additional-info' => [
			'id'	=> 'additional-info',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'info tambahan',
			'notif'	=> 0,
			'url'	=> 'menu.additional',
		],
		'gift' => [
			'id'	=> 'gift',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'Amlop Digital',
			'notif'	=> 0,
			'url'	=> 'menu.gift',
		],
		'wishes' => [
			'id'	=> 'wishes',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'Ucapan',
			'notif'	=> 0,
			'url'	=> 'menu.wishes',
		],
		'presenting' => [
			'id'	=> 'presenting',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'Konfirmasi Kehadiran',
			'notif'	=> 0,
			'url'	=> 'menu.presenting',
		],
		'share' => [
			'id'	=> 'share',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'Bagikan',
			'notif'	=> 0,
			'url'	=> 'menu.share',
		],
		'reservation' => [
			'id'	=> 'reservation',
			'icon'	=> 'receptionist-icon.png',
			'title'	=> 'penerima tamu',
			'notif'	=> 0,
			'url'	=> 'menu.reservation',
		],
		'table-management' => [
			'id'	=> 'table-management',
			'icon'	=> 'table-icon.svg',
			'title'	=> 'kelola meja',
			'notif'	=> 0,
			'url'	=> 'menu.management',
		],
		'souvenir' => [
			'id'	=> 'souvenir',
			'icon'	=> 'souvenir-icon.png',
			'title'	=> 'souvenir',
			'notif'	=> 0,
			'url'	=> 'menu.souvenir',
		],
		'e-invitation' => [
			'id'	=> 'e-invitation',
			'icon'	=> 'social-media_2065064.png',
			'title'	=> 'e-invitation',
			'notif'	=> 0,
			'url'	=> 'menu.einvitation',
		]
	];

	public function __construct(private $activation = null, private $active = null)
	{
		$this->middleware(function ($request, $next) {
			$this->activation = AccountInvoice::select('date', 'package_id')->with('pack')->current()->first();
			if ($this->activation!=null) :
                if ($this->activation->pack) {
				    $this->active = json_decode($this->activation->pack->content)->active ?? 0;
                } else {
                    $this->active = 0;
                }
				if (isexpired($this->activation->date, $this->active)===false) :
					return $next($request);
				elseif (isexpired($this->activation->date, $this->active)===true) :
					Redirect::to('dashboard/upgrade')->send();
				endif;
			else :
				Redirect::to('dashboard/account-transaction')->send();
			endif;
        });
	}

	public function main(): Response|RedirectResponse
	{
		$menu = $this->menu;
		$pack_content    = $this->activation->pack ? json_decode($this->activation->pack->content, true) : [];
		$conditional_menu = $pack_content;

		$templateLimit = $pack_content['template'] ?? ['basic'];
		if (!is_array($templateLimit) || empty($templateLimit)) {
			$templateLimit = ['basic'];
		}

		$bagpack = [
			'name'      => Auth::user()->inv ? Auth::user()->inv->title : json_encode(['-', '-']),
			'date'      => (Auth::user()->inv && Auth::user()->inv->preset)
				? json_decode(Auth::user()->inv->preset)->detail->calendar ?? null
				: null,
			'subdomain' => Auth::user()->inv ? Auth::user()->inv->slug : '',
			'template'  => (Auth::user()->inv && Auth::user()->inv->temp) ? Auth::user()->inv->temp->grade : 'basic',
			// Tampilkan SEMUA template — grade lock ditangani di view
			'templates' => [
				'basic'     => Template::select('id','title','slug','file','grade')->where('grade','basic')->publish()->latest()->get(),
				'premium'   => Template::select('id','title','slug','file','grade')->where('grade','premium')->publish()->latest()->get(),
				'exclusive' => Template::select('id','title','slug','file','grade')->where('grade','exclusive')->publish()->latest()->get(),
			],
			'templateLimit' => $templateLimit, // kirim limit ke view untuk badge
		];

		$rawTitle   = json_decode($bagpack['name'], true) ?? ['-', '-'];
		$namePria   = $rawTitle[0] ?? '-';
		$nameWanita = $rawTitle[1] ?? '-';
		$bagpack['name'] = ($namePria === $nameWanita) ? $namePria : $namePria.' & '.$nameWanita;

		$data = json_decode(json_encode($bagpack));
		$conditional = [
			'e-invitation' => $conditional_menu['e-invitation'] ?? false,
			'story'        => $conditional_menu['story']        ?? false,
			'event'        => $conditional_menu['event']        ?? false,
		];

		return response()->view('member.dashboard', compact('menu', 'data', 'conditional'));
	}

	/**
	 * Preview undangan member dengan data nyata — bypass cek publish & expired.
	 * Diakses via iframe di dashboard.
	 */
	public function preview_invitation(): Response
	{
		$inv = Auth::user()->inv;

		// Placeholder HTML jika belum ada undangan
		$placeholder = fn(string $msg, string $icon = 'bx-file-blank') =>
			response('<!DOCTYPE html><html><head><meta charset="UTF-8">
			<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
			<style>body{margin:0;display:flex;align-items:center;justify-content:center;min-height:100vh;
			font-family:sans-serif;background:#f8faf9;color:#aaa;flex-direction:column;gap:12px;text-align:center;padding:2rem}
			i{font-size:3rem;color:#2d7a4f}.msg{font-size:.9rem;max-width:260px;line-height:1.5}
			.btn{margin-top:.5rem;padding:.5rem 1.2rem;background:#2d7a4f;color:#fff;border:none;border-radius:4px;font-size:.8rem;cursor:pointer;text-decoration:none;display:inline-block}
			</style></head><body>
			<i class="bx '.$icon.'"></i><p class="msg">'.$msg.'</p>
			</body></html>', 200, ['Content-Type' => 'text/html']);

		if (!$inv) {
			return $placeholder('Undangan belum dibuat.<br>Silakan buat undangan terlebih dahulu.');
		}

		if (!$inv->preset) {
			return $placeholder('Data undangan belum lengkap.<br>Silakan isi profil undangan.', 'bx-edit');
		}

		// Decode preset dengan aman
		$data = json_decode($inv->preset);
		if (!$data) {
			return $placeholder('Format data undangan tidak valid.', 'bx-error');
		}

		// Pastikan semua key preset ada (fallback jika belum diisi)
		$data = $this->ensurePresetDefaults($data, $inv);

		// Tentukan template URL
		$templateUrl = $inv->temp?->url ?? 'default';
		if (!\Illuminate\Support\Facades\View::exists('template.'.$templateUrl)) {
			$templateUrl = 'default';
		}

		// Nama pasangan
		$rawTitle = json_decode($inv->title, true) ?? ['-', '-'];
		$titleStr = ($rawTitle[0] === ($rawTitle[1] ?? ''))
			? $rawTitle[0]
			: implode(' & ', $rawTitle);

		// Ambil data relasi
		$photo = InvitationGallery::where('type', 'photo')->where('invitation_id', $inv->id)->first();
		$video = InvitationGallery::where('type', 'video')->where('invitation_id', $inv->id)->first();

		if ($photo) $photo->prop = json_decode($photo->content);
		if ($video) $video->prop = json_decode($video->content);

		$other = [
			'video'    => $video,
			'photo'    => $photo,
			'protocol' => null,
			'event'    => InvitationEvent::where('invitation_id', $inv->id)->get(),
			'story'    => InvitationStory::where('invitation_id', $inv->id)->get(),
			'guest'    => null,
		];

		$invitation = (object)[
			'id'    => $inv->id,
			'title' => $titleStr,
			'file'  => $inv->file,
			'temp'  => $inv->temp,
			'slug'  => $inv->slug,
		];

		return response()->view('template.'.$templateUrl, compact('invitation', 'data', 'other'));
	}

	/**
	 * Pastikan semua key preset ada dengan nilai default yang aman.
	 */
	private function ensurePresetDefaults(object $data, $inv): object
	{
		$rawTitle = json_decode($inv->title, true) ?? ['-', '-'];
		$maleName   = $rawTitle[0] ?? '-';
		$femaleName = $rawTitle[1] ?? $maleName;

		// cover
		if (!isset($data->cover)) {
			$data->cover = (object)[];
		}
		if (!isset($data->cover->name)) {
			$data->cover->name = (object)['male' => $maleName, 'female' => $femaleName, 'size' => '48', 'style' => 'default'];
		}
		if (!isset($data->cover->content))     $data->cover->content = 'Undangan Pernikahan';
		if (!isset($data->cover->button))      $data->cover->button  = 'Buka Undangan';
		if (!isset($data->cover->description)) {
			$data->cover->description = (object)[
				'top'    => '',
				'bottom' => '',
				'image'  => (object)['method' => 'none', 'image' => ''],
			];
		}

		// profile
		if (!isset($data->profile)) {
			$data->profile = (object)[];
		}
		if (!isset($data->profile->name)) {
			$data->profile->name = (object)['male' => $maleName, 'female' => $femaleName];
		}
		if (!isset($data->profile->photo)) {
			$data->profile->photo = (object)[
				'male'   => (object)['method' => 'none', 'image' => '', 'frame' => ''],
				'female' => (object)['method' => 'none', 'image' => '', 'frame' => ''],
			];
		}
		if (!isset($data->profile->instagram)) {
			$data->profile->instagram = (object)['male' => '', 'female' => '', 'show' => false];
		}
		if (!isset($data->profile->parent)) {
			$data->profile->parent = (object)[
				'show'   => false,
				'male'   => (object)['father' => '', 'mother' => '', 'childhood' => '1'],
				'female' => (object)['father' => '', 'mother' => '', 'childhood' => '1'],
			];
		}

		// detail
		if (!isset($data->detail)) {
			$data->detail = (object)[];
		}
		if (!isset($data->detail->calendar)) {
			$data->detail->calendar = (object)[
				'date'     => now()->addMonths(3)->format('Y-m-d'),
				'time'     => '09:00',
				'timezone' => 'wib',
				'save'     => (object)['show' => false, 'content' => 'Simpan Tanggal'],
			];
		}
		if (!isset($data->detail->countdown)) {
			$data->detail->countdown = (object)['show' => true, 'style' => 'default'];
		}
		if (!isset($data->detail->location)) {
			$data->detail->location = (object)['address' => '', 'map' => ''];
		}
		if (!isset($data->detail->additional)) {
			$data->detail->additional = (object)['show' => false, 'closing' => '', 'special' => []];
		}

		// quote
		if (!isset($data->quote)) {
			$data->quote = (object)['content' => '', 'decoration' => ''];
		}

		// music
		if (!isset($data->music)) {
			$data->music = (object)['show' => false, 'title' => '', 'url' => ''];
		}

		// rsvp
		if (!isset($data->rsvp)) {
			$data->rsvp = (object)[
				'title'   => 'Konfirmasi Kehadiran',
				'content' => 'Mohon konfirmasi kehadiran Anda',
				'date'    => '',
				'yes'     => (object)['option' => 'Hadir', 'content' => 'Terima kasih'],
				'no'      => (object)['option' => 'Tidak Hadir', 'content' => 'Terima kasih'],
			];
		}

		// gift
		if (!isset($data->gift)) {
			$data->gift = (object)[
				'show'    => false,
				'title'   => 'Amplop Digital',
				'content' => '',
				'bank'    => (object)['name' => '', 'code' => '', 'option' => 'bca'],
			];
		}

		// wishes
		if (!isset($data->wishes)) {
			$data->wishes = (object)['title' => 'Ucapan & Doa', 'content' => '', 'public' => true];
		}

		// additional
		if (!isset($data->additional)) {
			$data->additional = (object)[
				'live'     => (object)['show' => false, 'app' => '', 'link' => '', 'content' => ''],
				'protocol' => (object)['show' => false, 'code' => [], 'title' => '', 'content' => ''],
			];
		}

		return $data;
	}

	/**
	 * Ambil preset sebagai ARRAY dengan semua key default — dipakai di save_setting.
	 */
	private function safePresetArray(array $raw): array
	{
		$inv   = Auth::user()->inv;
		$title = json_decode($inv->title ?? '["",""]', true) ?? ['', ''];
		$male  = $title[0] ?? '';
		$female = $title[1] ?? $male;

		$defaults = [
			'design' => [
				'template'   => $inv->template_id ?? null,
				'title'      => ['color' => '#000000', 'font' => 'Arial'],
				'content'    => ['color' => '#333333', 'font' => 'Arial'],
				'background' => '#ffffff',
				'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
			],
			'cover' => [
				'name'        => ['male' => $male, 'female' => $female, 'size' => '48', 'style' => 'default'],
				'content'     => 'Undangan Pernikahan',
				'button'      => 'Buka Undangan',
				'description' => [
					'top'    => '',
					'bottom' => '',
					'image'  => ['method' => 'none', 'image' => ''],
				],
			],
			'profile' => [
				'name'      => ['male' => $male, 'female' => $female],
				'photo'     => [
					'male'   => ['method' => 'none', 'image' => '', 'frame' => ''],
					'female' => ['method' => 'none', 'image' => '', 'frame' => ''],
				],
				'instagram' => ['male' => '', 'female' => '', 'show' => false],
				'parent'    => [
					'show'   => false,
					'male'   => ['father' => '', 'mother' => '', 'childhood' => '1'],
					'female' => ['father' => '', 'mother' => '', 'childhood' => '1'],
				],
			],
			'detail' => [
				'calendar'   => [
					'date'     => '',
					'time'     => '09:00',
					'timezone' => 'wib',
					'save'     => ['show' => false, 'content' => 'Simpan Tanggal'],
				],
				'countdown'  => ['show' => true, 'style' => 'deafult'],
				'location'   => ['address' => '', 'map' => ''],
				'additional' => ['show' => false, 'closing' => '', 'special' => []],
			],
			'quote'      => ['content' => '', 'decoration' => ''],
			'music'      => ['show' => false, 'title' => '', 'url' => ''],
			'rsvp'       => [
				'title'   => 'Konfirmasi Kehadiran',
				'content' => '',
				'date'    => '',
				'yes'     => ['option' => 'Hadir', 'content' => 'Terima kasih'],
				'no'      => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih'],
			],
			'additional' => [
				'live'     => ['show' => false, 'app' => '', 'link' => '', 'content' => ''],
				'protocol' => ['show' => false, 'code' => [], 'title' => '', 'content' => ''],
			],
			'gift' => [
				'show'    => false,
				'title'   => 'Amplop Digital',
				'content' => '',
				'bank'    => ['name' => '', 'code' => '', 'option' => 'bca'],
			],
			'wishes' => ['title' => 'Ucapan & Doa', 'content' => '', 'public' => true],
		];

		return array_replace_recursive($defaults, $raw);
	}

	/**
	 * Ambil preset undangan dengan nilai default yang aman untuk semua key.
	 */
	private function safePreset(): object
	{
		$inv  = Auth::user()->inv;
		$raw  = json_decode($inv->preset ?? '{}') ?? (object)[];
		$title = json_decode($inv->title ?? '["",""]', true) ?? ['', ''];
		$male   = $title[0] ?? '';
		$female = $title[1] ?? $male;

		// design
		if (!isset($raw->design)) $raw->design = (object)[];
		$d = $raw->design;
		if (!isset($d->template))   $d->template   = $inv->template_id ?? null;
		if (!isset($d->title))      $d->title       = (object)['color'=>'#000000','font'=>'Arial'];
		if (!isset($d->content))    $d->content     = (object)['color'=>'#333333','font'=>'Arial'];
		if (!isset($d->background)) $d->background  = '#ffffff';
		if (!isset($d->button))     $d->button      = (object)['color'=>'#ffffff','background'=>'#2d7a4f'];

		// cover
		if (!isset($raw->cover)) $raw->cover = (object)[];
		$c = $raw->cover;
		if (!isset($c->name))        $c->name        = (object)['male'=>$male,'female'=>$female,'size'=>'48','style'=>'default'];
		if (!isset($c->content))     $c->content     = 'Undangan Pernikahan';
		if (!isset($c->button))      $c->button      = 'Buka Undangan';
		if (!isset($c->description)) $c->description = (object)['top'=>'','bottom'=>'','image'=>(object)['method'=>'none','image'=>'']];
		if (!isset($c->description->image)) $c->description->image = (object)['method'=>'none','image'=>''];
		if (!isset($c->description->top))   $c->description->top   = '';
		if (!isset($c->description->bottom)) $c->description->bottom = '';

		// profile
		if (!isset($raw->profile)) $raw->profile = (object)[];
		$p = $raw->profile;
		if (!isset($p->name))      $p->name      = (object)['male'=>$male,'female'=>$female];
		if (!isset($p->photo))     $p->photo     = (object)['male'=>(object)['method'=>'none','image'=>'','frame'=>''],'female'=>(object)['method'=>'none','image'=>'','frame'=>'']];
		if (!isset($p->photo->male))   $p->photo->male   = (object)['method'=>'none','image'=>'','frame'=>''];
		if (!isset($p->photo->female)) $p->photo->female = (object)['method'=>'none','image'=>'','frame'=>''];
		if (!isset($p->instagram)) $p->instagram = (object)['male'=>'','female'=>'','show'=>false];
		if (!isset($p->parent))    $p->parent    = (object)['show'=>false,'male'=>(object)['father'=>'','mother'=>'','childhood'=>'1'],'female'=>(object)['father'=>'','mother'=>'','childhood'=>'1']];

		// detail
		if (!isset($raw->detail)) $raw->detail = (object)[];
		$dt = $raw->detail;
		if (!isset($dt->calendar))  $dt->calendar  = (object)['date'=>'','time'=>'09:00','timezone'=>'wib','save'=>(object)['show'=>false,'content'=>'Simpan Tanggal']];
		if (!isset($dt->calendar->save)) $dt->calendar->save = (object)['show'=>false,'content'=>'Simpan Tanggal'];
		if (!isset($dt->calendar->date))     $dt->calendar->date     = '';
		if (!isset($dt->calendar->time))     $dt->calendar->time     = '09:00';
		if (!isset($dt->calendar->timezone)) $dt->calendar->timezone = 'wib';
		if (!isset($dt->countdown)) $dt->countdown = (object)['show'=>true,'style'=>'deafult'];
		if (!isset($dt->location))  $dt->location  = (object)['address'=>'','map'=>''];
		if (!isset($dt->additional)) $dt->additional = (object)['show'=>false,'closing'=>'','special'=>[]];
		if (!isset($dt->additional->special)) $dt->additional->special = [];

		// quote
		if (!isset($raw->quote)) $raw->quote = (object)['content'=>'','decoration'=>''];
		if (!isset($raw->quote->content))    $raw->quote->content    = '';
		if (!isset($raw->quote->decoration)) $raw->quote->decoration = '';

		// music
		if (!isset($raw->music)) $raw->music = (object)['show'=>false,'title'=>'','url'=>''];
		if (!isset($raw->music->show))  $raw->music->show  = false;
		if (!isset($raw->music->title)) $raw->music->title = '';
		if (!isset($raw->music->url))   $raw->music->url   = '';

		// rsvp
		if (!isset($raw->rsvp)) $raw->rsvp = (object)[];
		$r = $raw->rsvp;
		if (!isset($r->title))   $r->title   = 'Konfirmasi Kehadiran';
		if (!isset($r->content)) $r->content = 'Mohon konfirmasi kehadiran Anda';
		if (!isset($r->date))    $r->date    = '';
		if (!isset($r->yes))     $r->yes     = (object)['option'=>'Hadir','content'=>'Terima kasih'];
		if (!isset($r->no))      $r->no      = (object)['option'=>'Tidak Hadir','content'=>'Terima kasih'];

		// additional
		if (!isset($raw->additional)) $raw->additional = (object)[];
		$a = $raw->additional;
		if (!isset($a->live))     $a->live     = (object)['show'=>false,'app'=>'','link'=>'','content'=>''];
		if (!isset($a->protocol)) $a->protocol = (object)['show'=>false,'code'=>[],'title'=>'','content'=>''];

		// gift
		if (!isset($raw->gift)) $raw->gift = (object)[];
		$g = $raw->gift;
		if (!isset($g->show))    $g->show    = false;
		if (!isset($g->title))   $g->title   = 'Amplop Digital';
		if (!isset($g->content)) $g->content = '';
		if (!isset($g->bank))    $g->bank    = (object)['name'=>'','code'=>'','option'=>'bca'];

		// wishes
		if (!isset($raw->wishes)) $raw->wishes = (object)[];
		$w = $raw->wishes;
		if (!isset($w->title))   $w->title   = 'Ucapan & Doa';
		if (!isset($w->content)) $w->content = '';
		if (!isset($w->public))  $w->public  = true;

		return $raw;
	}

	public function m_design(): Response
	{
		$menu  = $this->menu['design'];
		$preset = $this->safePreset();
		$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$templateLimit = ['basic'];
		if ($access && $access->pack && $access->pack->content) {
			$content = json_decode($access->pack->content, true);
			$templateLimit = $content['template'] ?? ['basic'];
		}
		if (!is_array($templateLimit) || empty($templateLimit)) {
			$templateLimit = ['basic'];
		}
		$bagpack = [
			'template' => [
				'basic'     => in_array('basic', $templateLimit, true)     ? Template::select('id','title','slug','file')->where('grade','basic')->publish()->latest()->get()     : collect(),
				'premium'   => in_array('premium', $templateLimit, true)   ? Template::select('id','title','slug','file')->where('grade','premium')->publish()->latest()->get()   : collect(),
				'exclusive' => in_array('exclusive', $templateLimit, true) ? Template::select('id','title','slug','file')->where('grade','exclusive')->publish()->latest()->get() : collect(),
			],
			'limit'  => $templateLimit,
			'font'   => TemplateAssets::select('title','content')->where('type','font')->publish()->get(),
			'preset' => $preset->design,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-design', compact('menu', 'data'));
	}

	public function m_cover(): Response
	{
		$menu   = $this->menu['cover'];
		$preset = $this->safePreset();
		$bagpack = [
			'avatar' => ['none' => TemplateAssets::select('title','content')->where('type','avatar')->get()],
			'style'  => ['default' => 'Bawaan', 'stack' => 'Bertumpuk'],
			'preset' => $preset->cover,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-cover', compact('menu', 'data'));
	}

	public function m_profile(): Response
	{
		$menu   = $this->menu['profile'];
		$preset = $this->safePreset();
		$bagpack = [
			'avatar' => [
				'male'   => TemplateAssets::select('title','content')->where('type','avatar male')->get(),
				'female' => TemplateAssets::select('title','content')->where('type','avatar female')->get(),
			],
			'frame'  => TemplateAssets::select('title','content')->where('type','frame')->latest()->get(),
			'preset' => $preset->profile,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-profile', compact('menu', 'data'));
	}

	public function m_detail(): Response
	{
		$menu   = $this->menu['detail'];
		$preset = $this->safePreset();
		$bagpack = [
			'timezone' => ['wib'=>'WIB','wita'=>'WITA','wit'=>'WIT','none'=>'Kosongkan'],
			'style'    => ['deafult'=>'Bawaan','stack'=>'Bertumpuk'],
			'preset'   => $preset->detail,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-detail', compact('menu', 'data'));
	}

	public function m_quote(): Response
	{
		$menu   = $this->menu['quote'];
		$preset = $this->safePreset();
		$bagpack = [
			'quote'      => TemplateAssets::select('title','content')->where('type','quote')->latest()->get(),
			'decoration' => TemplateAssets::select('title','content')->where('type','decoration')->latest()->get(),
			'preset'     => $preset->quote,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-quote', compact('menu', 'data'));
	}

	public function m_event(): Response|RedirectResponse
	{
		if (json_decode($this->activation->pack->content, true)['event'] ?? false) :
			$menu = $this->menu['event'];
			$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
			$bagpack = [
				'style' => ['deafult' => 'Bawaan', 'none' => 'Sembunyikan'],
				'event' => InvitationEvent::select('id', 'title', 'content', 'publish')->where('invitation_id', Auth::user()->inv->id)->get(),
				'limitEvent' => (json_decode($access->pack->content)->{'event-count'}=='unlimited') ? "∞" : json_decode($access->pack->content)->{'event-count'},
			];
			$data = json_decode(json_encode($bagpack));

			return response()->view('member.m-event', compact('menu', 'data'));
		else :
			return redirect()->route('packages');
		endif;
	}

	public function m_event_add(Request $request): JsonResponse
	{
		$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$column = [
			'event_title' => 'required',
			'event_content' => 'required',
			'event_time_start' => 'required'
		];
		if ($request->event_time_done!='on') :
			$column['event_time_end'] = 'required';
		endif;
		if ($request->event_location_sync!='on') :
			$column['event_location_address'] = 'required';
			$column['event_location_map'] = 'required';
		endif;
		$this->validate($request, $column);
		$preset = [
			'title' => $request->event_title,
			'slug' => clean_str($request->event_title),
			'content' => json_encode([
				'primary' => ($request->event_primary=='on') ? true : false,
				'content' => $request->event_content,
				'time' => [
					'start' => $request->event_time_start,
					'end' => $request->event_time_end,
					'done' => ($request->event_time_done=='on') ? true : false
				],
				'location' => [
					'address' => $request->event_location_address,
					'map' => $request->event_location_map,
					'sync' => ($request->event_location_sync=='on') ? true : false
				]
			]),
			'publish' => 'publish',
			'invitation_id' => Auth::user()->inv->id,
			'ip_addr' => $_SERVER['REMOTE_ADDR'],
			'user_id' => Auth::user()->id
		];
		$check_event = InvitationEvent::where('invitation_id', Auth::user()->inv->id)->count();
		$limit_event = (json_decode($access->pack->content)->{'event-count'}=='unlimited') ? 500 : json_decode($access->pack->content)->{'event-count'};
		if ($check_event<$limit_event) :
			InvitationEvent::create($preset);
			$response = ['toast'=>['icon'=>'success', 'title'=>'Disimpan!', 'text'=>'Acara '.$request->event_title.' telah ditambahkan.'], 'page' => 'reload'];
		else :
			$response = ['toast'=>['icon'=>'warning', 'title'=>'Kuota penuh', 'text'=>'Acara '.$request->event_title.' tidak bisa ditambahkan.'], 'page' => 'idle'];
		endif;
		
		return response()->json($response);
	}

	public function m_event_edit(Request $request, int $id): JsonResponse
	{
		$column = [
			'event_title' => 'required',
			'event_content' => 'required',
			'event_time_start' => 'required'
		];
		if ($request->event_time_done!='on') :
			$column['event_time_end'] = 'required';
		endif;
		if ($request->event_location_sync!='on') :
			$column['event_location_address'] = 'required';
			$column['event_location_map'] = 'required';
		endif;
		$this->validate($request, $column);
		$preset = [
			'title' => $request->event_title,
			'slug' => clean_str($request->event_title),
			'content' => json_encode([
				'primary' => ($request->event_primary=='on') ? true : false,
				'content' => $request->event_content,
				'time' => [
					'start' => $request->event_time_start,
					'end' => $request->event_time_end,
					'done' => ($request->event_time_done=='on') ? true : false
				],
				'location' => [
					'address' => $request->event_location_address,
					'map' => $request->event_location_map,
					'sync' => ($request->event_location_sync=='on') ? true : false
				]
			]),
			'ip_addr' => $_SERVER['REMOTE_ADDR'],
			'user_id' => Auth::user()->id
		];
		InvitationEvent::whereId($id)->update($preset);
		$response = ['toast'=>['icon'=>'success', 'title'=>'Disimpan!', 'text'=>'Perubahan telah disimpan.'], 'page' => 'idle'];

		return response()->json($response);
	}

	public function m_event_delete(int $id): JsonResponse
	{
		InvitationEvent::whereId($id)->delete();

		return response()->json(['deleted']);
	}

	public function m_event_show(int $id): JsonResponse
	{
		$event = InvitationEvent::select('id', 'title', 'content')->whereId($id)->where('invitation_id', Auth::user()->inv->id)->first();
		$event->content = json_decode($event->content);
		$event->url = route('menu.event-delete', $event->id);

		return response()->json($event);
	}

	public function m_story(): Response|RedirectResponse
	{
		if (json_decode($this->activation->pack->content, true)['story'] ?? false) :
			$menu = $this->menu['story'];
			$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
			$bagpack = [
				'style'  => ['deafult' => 'Bawaan', 'none' => 'Sembunyikan'],
				'story' => InvitationStory::select('id', 'title', 'content', 'publish')->where('invitation_id', Auth::user()->inv->id)->get(),
				'limitStory' => (json_decode($access->pack->content)->{'story-count'}=='unlimited') ? "∞" : json_decode($access->pack->content)->{'story-count'},
			];
			$data = json_decode(json_encode($bagpack));

			return response()->view('member.m-story', compact('menu', 'data'));
		else :
			return redirect()->route('packages');
		endif;
	}

	public function m_story_add(Request $request): JsonResponse
	{
		$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$column = [
			'story_title' => 'required',
			'story_content' => 'required'
		];
		$this->validate($request, $column);
		$preset = [
			'title' => $request->story_title,
			'slug' => clean_str($request->story_title),
			'content' => $request->story_content,
			'file' => $request->story_file ?? NULL,
			'publish' => 'publish',
			'invitation_id' => Auth::user()->inv->id,
			'ip_addr' => $_SERVER['REMOTE_ADDR'],
			'user_id' => Auth::user()->id
		];
		
		$check_story = InvitationStory::where('invitation_id', Auth::user()->inv->id)->count();
		$limit_story = (json_decode($access->pack->content)->{'story-count'}=='unlimited') ? 500 : json_decode($access->pack->content)->{'story-count'};
		if ($check_story<$limit_story) :
			InvitationStory::create($preset);
			$response = ['toast'=>['icon'=>'success', 'title'=>'Disimpan!', 'text'=>'Cerita '.$request->story_title.' telah ditambahkan.'], 'page' => 'reload'];
		else :
			$response = ['toast'=>['icon'=>'warning', 'title'=>'Kuota penuh', 'text'=>'Cerita '.$request->story_title.' tidak bisa ditambahkan.'], 'page' => 'idle'];
		endif;
		
		return response()->json($response);
	}

	public function m_story_edit(Request $request, int $id): JsonResponse
	{
		$column = [
			'story_title' => 'required',
			'story_content' => 'required'
		];
		$this->validate($request, $column);
		$preset = [
			'title' => $request->story_title,
			'slug' => clean_str($request->story_title),
			'content' => $request->story_content,
			'file' => $request->story_file ?? NULL,
			'ip_addr' => $_SERVER['REMOTE_ADDR'],
			'user_id' => Auth::user()->id
		];
		InvitationStory::whereId($id)->update($preset);
		$response = ['toast'=>['icon'=>'success', 'title'=>'Disimpan!', 'text'=>'Perubahan telah disimpan.'], 'page' => 'idle'];

		return response()->json($response);
	}

	public function m_story_delete(int $id): JsonResponse
	{
		InvitationStory::whereId($id)->delete();

		return response()->json(['hapus']);
	}

	public function m_story_show(int $id): JsonResponse
	{
		$story = InvitationStory::select('id', 'title', 'content', 'file')->whereId($id)->where('invitation_id', Auth::user()->inv->id)->first();
		$story->image = url('storage/sm/', $story->file);
		$story->url = route('menu.story-delete', $story->id);

		return response()->json($story);
	}

	public function m_gallery(): Response
	{
		$menu = $this->menu['gallery'];
		$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$bagpack = [
			'style'  => ['default' => 'Bawaan', 'none' => 'Sembunyikan'],
			'limitPhoto' => (json_decode($access->pack->content)->{'gallery-photo'}=='unlimited') ? "∞" : json_decode($access->pack->content)->{'gallery-photo'},
			'limitVideo' => (json_decode($access->pack->content)->{'gallery-video'}=='unlimited') ? "∞" : json_decode($access->pack->content)->{'gallery-video'},
			'photo' => InvitationGallery::select('title', 'content')->where('type', 'photo')->where('invitation_id', Auth::user()->inv->id)->first(),
			'video' => InvitationGallery::select('title', 'content')->where('type', 'video')->where('invitation_id', Auth::user()->inv->id)->first(),
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('member.m-gallery', compact('menu', 'data'));
	}

	public function m_gallery_add(Request $request): JsonResponse
	{
		$this->validate($request, [
			'gallery_title' => 'required',
			'gallery_content' => 'required',
			'gallery_style' => 'required',
			'video_title' => 'required',
			'video_content' => 'required',
			'video_url' => 'required',
		]);
		$preset = [
			'photo' => [
				'title' => $request->input('gallery_title'),
				'content' => json_encode([
					'content' => $request->input('gallery_content'),
					'style' => $request->input('gallery_style'),
					'file' => $request->input('gallery_file'),
					'show' => ($request->input('gallery_show')=='on') ? false : true,
				]),
			],
			'video' => [
				'title' => $request->input('video_title'),
				'content' => json_encode([
					'content' => $request->input('video_content'),
					'url' => check_yt($request->input('video_url')),
				])
			]
		];
		$photo = InvitationGallery::where('type', 'photo')->where('invitation_id', Auth::user()->inv->id)->count();
		if ($photo>=1) :
			InvitationGallery::where('type', 'photo')->where('invitation_id', Auth::user()->inv->id)->update($preset['photo']);
		elseif ($photo==0) :
			$preset['photo']['type'] = 'photo';
			$preset['photo']['invitation_id'] = Auth::user()->inv->id;
			$preset['photo']['ip_addr'] = $_SERVER['REMOTE_ADDR'];
			$preset['photo']['user_id'] = Auth::user()->id;
			InvitationGallery::create($preset['photo']);
		endif;
		$video = InvitationGallery::where('type', 'video')->where('invitation_id', Auth::user()->inv->id)->count();
		if ($video>=1) :
			InvitationGallery::where('type', 'video')->where('invitation_id', Auth::user()->inv->id)->update($preset['video']);
		elseif ($video==0) :
			$preset['video']['type'] = 'video';
			$preset['video']['invitation_id'] = Auth::user()->inv->id;
			$preset['video']['ip_addr'] = $_SERVER['REMOTE_ADDR'];
			$preset['video']['user_id'] = Auth::user()->id;
			InvitationGallery::create($preset['video']);
		endif;
		$response = ['toast'=>['icon'=>'success', 'title'=>'Disimpan!', 'text'=>'Perubahan telah disimpan.'], 'page' => 'idle'];

		return response()->json($response);
	}
	
	public function m_music(): Response
	{
		$menu   = $this->menu['music'];
		$preset = $this->safePreset();
		$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$bagpack = [
			'music'    => TemplateAssets::select('title','content')->where('type','music')->whereHas('user', fn($q) => $q->where('role','admin'))->publish()->get(),
			'my_music' => TemplateAssets::select('title','content')->where('type','music')->where('user_id', Auth::user()->id)->publish()->first(),
			'custom'   => json_decode($access->pack->content)->{'music'} ?? 'template',
			'preset'   => $preset->music,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-music', compact('menu', 'data'));
	}

	public function m_music_add(Request $request): JsonResponse
	{
		$this->validate($request, [
			'music_title' => 'required',
			'music_file' => 'required|mimes:mpeg,mp3',
		]);
		$preset = [
			'title' => $request->input('music_title'),
			'publish' => 'publish',
			'user_id' => Auth::user()->id,
			'ip_addr' => $_SERVER['REMOTE_ADDR']
		];
		if (!empty($request->music_file)) :
			$music_name = $request->file('music_file')->hashName();
			Storage::disk('public')->put('audio/'.$music_name, file_get_contents($request->file('music_file')));
			$preset['content'] = $music_name;
			$music = TemplateAssets::where('type', 'music')->where('user_id', Auth::user()->id)->publish();
			$count = $music->count();
			if ($count>=1) :
				$music = $music->first();
				if (Storage::disk('public')->exists('audio/'.$music->content)) :
					Storage::disk('public')->delete('audio/'.$music->content);
				endif;
				TemplateAssets::whereId($music->id)->update($preset);
			elseif ($count==0) :
				$preset['type'] = 'music';
				TemplateAssets::create($preset);
			endif;
		endif;
		
		return response()->json([]);
	}
	
	public function m_rsvp(): Response
	{
		$menu   = $this->menu['rsvp'];
		$preset = $this->safePreset();
		$bagpack = ['preset' => $preset->rsvp];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-rsvp', compact('menu', 'data'));
	}

	public function m_additional(): Response
	{
		$menu   = $this->menu['additional-info'];
		$preset = $this->safePreset();
		$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$bagpack = [
			'protocol'   => TemplateAssets::select('id','title','content')->where('type','protocol')->publish()->get(),
			'liveAccess' => json_decode($access->pack->content)->{'live-stream'} ?? false,
			'preset'     => $preset->additional,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-additional', compact('menu', 'data'));
	}
	
	public function m_einvitation(): Response|RedirectResponse
	{
		$packContent = Auth::user()->invoice[0]->pack->content ?? null;
		if ($packContent && json_decode($packContent)->{'e-invitation'} === true) :
			$menu   = $this->menu['e-invitation'];
			$preset = $this->safePreset();
			$bagpack = [
				'preset' => $preset->design,
				'date'   => $preset->detail->calendar->date ?? '',
			];
			$data = json_decode(json_encode($bagpack));
			return response()->view('member.m-einvitation', compact('menu', 'data'));
		else :
			return redirect()->route('packages');
		endif;
	}

	public function m_einvitation_edit(Request $request): JsonResponse|RedirectResponse
	{
		$packContent = Auth::user()->invoice[0]->pack->content ?? null;
		if ($packContent && json_decode($packContent)->{'e-invitation'} === true) :
			list($type, $imgData) = explode(';', $request->base64data);
			list(, $imgData)      = explode(',', $imgData);
			$imgData = base64_decode($imgData);
			$image_name = 'meta_'.Auth::user()->id.clean_str(implode('-', json_decode(Auth::user()->inv->title, true))).'.webp';
			if (Storage::disk('public')->exists($image_name)) {
				Storage::disk('public')->delete($image_name);
			}
			Storage::disk('public')->put($image_name, $imgData);
			Invitation::find(Auth::user()->inv->id)->update(['file' => $image_name]);
			return response()->json(['toast'=>['icon'=>'success','title'=>'Gambar telah dibuat','text'=>'Gambar baru telah disimpan.']]);
		else :
			return redirect()->route('packages');
		endif;
	}
	
	public function m_gift(): Response
	{
		$menu   = $this->menu['gift'];
		$preset = $this->safePreset();
		$bagpack = [
			'gift'   => Feedback::select('content','created_at')->where('type','gift')->where('invitation_id', Auth::user()->inv->id)->get(),
			'preset' => $preset->gift,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-gift', compact('menu', 'data'));
	}

	public function m_wishes(): Response
	{
		$menu   = $this->menu['wishes'];
		$preset = $this->safePreset();
		$bagpack = [
			'wishes' => Feedback::select('content','created_at')->where('type','wishes')->where('invitation_id', Auth::user()->inv->id)->get(),
			'preset' => $preset->wishes,
		];
		$data = json_decode(json_encode($bagpack));
		return response()->view('member.m-wishes', compact('menu', 'data'));
	}
	
	public function m_presenting(): Response
	{
		$menu = $this->menu['presenting'];
		$bagpack = [
			'present' => Feedback::select('content', 'created_at')->where('type', 'present')->where('invitation_id', Auth::user()->inv->id)->get()
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('member.m-presenting', compact('menu', 'data'));
	}
	
	public function m_share(): Response
	{
		$menu = $this->menu['share'];
		$bagpack = [
			'guest' => InvitationGuest::select('id', 'name', 'slug', 'type')->where('invitation_id', Auth::user()->inv->id)->get(),
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('member.m-share', compact('menu', 'data'));
	}

	public function m_share_add(Request $request): JsonResponse
	{
		$this->validate($request, [
			'share_guest_type'     => 'required|in:personal,group,private',
			'share_guest_name'     => 'required|string|max:100',
			'share_guest_location' => 'required|string|max:100',
		]);

		$slug = clean_str($request->share_guest_name)
			. clean_str(substr($request->share_guest_location, 0, 3) . strlen($request->share_guest_name));

		// Pastikan slug unik
		$existing = InvitationGuest::where('slug', $slug)
			->where('invitation_id', Auth::user()->inv->id)
			->exists();
		if ($existing) {
			$slug .= rand(10, 99);
		}

		InvitationGuest::create([
			'type'          => $request->share_guest_type,
			'name'          => json_encode(['name' => $request->share_guest_name, 'location' => $request->share_guest_location]),
			'slug'          => $slug,
			'invitation_id' => Auth::user()->inv->id,
			'user_id'       => Auth::user()->id,
			'ip_addr'       => $_SERVER['REMOTE_ADDR'],
		]);

		return response()->json([
			'toast' => ['icon' => 'success', 'title' => 'Tamu ditambahkan!', 'text' => $request->share_guest_name.' berhasil ditambahkan.'],
			'page'  => 'reload',
		]);
	}

	public function m_share_delete(int $id): JsonResponse
	{
		InvitationGuest::where('id', $id)
			->where('invitation_id', Auth::user()->inv->id)
			->delete();

		return response()->json(['toast' => ['icon' => 'success', 'title' => 'Tamu dihapus'], 'page' => 'reload']);
	}

	public function save_setting(Request $request, string $menu): JsonResponse
	{
		$recent_inv = Invitation::select('id', 'preset')->whereId(Auth::user()->inv->id)->firstOrFail();
		$save_inv_column = [];
		$column = [];

		// Decode preset sebagai array, merge dengan default agar semua key ada
		$raw = json_decode($recent_inv->preset ?? '{}', true) ?? [];
		$preset = $this->safePresetArray($raw);

		if ($menu=='design') :
			// validation
			$column['design_template'] = 'required';
			$column['design_title_color'] = 'required';
			$column['design_content_color'] = 'required';
			$column['design_background'] = 'required';
			$column['design_button_background'] = 'required';
			$column['design_button_color'] = 'required';
			$column['design_title_font'] = 'required';
			$column['design_content_font'] = 'required';
			$allowed_template = Template::select('id', 'grade')->whereId($request->input('design_template'))->publish()->first();
			if (!$allowed_template) :
				return response()->json(['toast'=>['icon'=>'error','title'=>'>_<','text'=>'Template tidak tersedia.']]);
			endif;
			// new preset
			if (isitsame($request->input('design_template'), $preset['design']['template'])===false) :
				$access = AccountInvoice::select('package_id')->with('pack')->current()->first();
				$limit = [];
				if ($access && $access->pack && $access->pack->content) {
					$limit = json_decode($access->pack->content)->{'template'} ?? [];
				}
				if (!is_array($limit) || empty($limit)) {
					$limit = ['basic'];
				}
				if (in_array($allowed_template->grade, $limit, true)) :
					$preset['design']['template'] = $request->input('design_template');
					Invitation::whereId(Auth::user()->inv->id)->update(['template_id'=>$request->input('design_template')]);
				else :
					return response()->json(['toast'=>['icon'=>'error','title'=>'>_<','text'=>'Access denied!!']]);
				endif;
			endif;
			$preset['design']['title']['color'] = $request->input('design_title_color');
			$preset['design']['content']['color'] = $request->input('design_content_color');
			$preset['design']['background'] = $request->input('design_background');
			$preset['design']['button']['background'] = $request->input('design_button_background');
			$preset['design']['button']['color'] = $request->input('design_button_color');
			$preset['design']['title']['font'] = $request->input('design_title_font');
			$preset['design']['content']['font'] = $request->input('design_content_font');
		elseif ($menu=='cover') :
			$column['cover_name_female'] = 'required';
			$column['cover_name_male']   = 'required';
			$column['cover_name_size']   = 'required';
			$column['cover_name_style']  = 'required';
			$column['cover_content']     = 'required';
			$column['cover_button']      = 'required';
			$column['cover_description_top']    = 'required';
			$column['cover_description_bottom'] = 'required';

			// Validasi dulu sebelum proses file
			$this->validate($request, $column);

			$preset['cover']['name']['female'] = $request->input('cover_name_female');
			$preset['cover']['name']['male']   = $request->input('cover_name_male');
			$preset['cover']['name']['size']   = $request->input('cover_name_size');
			$preset['cover']['name']['style']  = $request->input('cover_name_style');
			$preset['cover']['content']        = $request->input('cover_content');
			$preset['cover']['button']         = $request->input('cover_button');
			$preset['cover']['description']['top']    = $request->input('cover_description_top');
			$preset['cover']['description']['bottom'] = $request->input('cover_description_bottom');

			$imgMethod = $request->input('cover_description_image__method', 'none');

			if ($imgMethod === 'upload') :
				// Validasi file terpisah
				$this->validate($request, ['cover_description_image' => 'required|file|mimes:jpg,jpeg,png|max:5120']);
				if ($request->hasFile('cover_description_image') && $request->file('cover_description_image')->isValid()) :
					$file       = $request->file('cover_description_image');
					$image_name = $file->hashName();
					Storage::disk('public')->put($image_name, file_get_contents($file));
					image_reducer(file_get_contents($file), $image_name);
					$preset['cover']['description']['image']['method'] = 'storage';
					$preset['cover']['description']['image']['image']  = $image_name;
					Strbox::create([
						'title'     => $request->input('cover_name_female', 'cover'),
						'file'      => $image_name,
						'file_type' => 'image',
						'user_id'   => Auth::user()->id,
						'ip_addr'   => $_SERVER['REMOTE_ADDR'],
					]);
				endif;
			elseif ($imgMethod === 'avatar' || $imgMethod === 'storage') :
				$filename = $request->input('cover_description_image__filename', '');
				if ($filename) :
					$preset['cover']['description']['image']['method'] = $imgMethod;
					$preset['cover']['description']['image']['image']  = $filename;
				endif;
			elseif ($imgMethod === 'none' || empty($imgMethod)) :
				$preset['cover']['description']['image']['method'] = 'none';
				$preset['cover']['description']['image']['image']  = '';
			endif;

			$save_inv_column['title'] = json_encode([
				$request->input('cover_name_male'),
				$request->input('cover_name_female'),
			]);

			// Simpan langsung — skip validate di bawah karena sudah divalidasi
			$save_inv_column['preset'] = json_encode($preset);
			$recent_inv->update($save_inv_column);
			return response()->json([
				'toast' => ['icon' => 'success', 'title' => 'Disimpan!', 'text' => 'Sampul undangan berhasil disimpan.'],
				'page'  => 'idle',
			]);
		elseif ($menu=='profile') :
			$column['profile_name_male'] = 'required';
			$column['profile_name_female'] = 'required';
			if ($request->profile_instagram_show!='on') :
				$column['profile_instagram_male'] = 'required';
				$column['profile_instagram_female'] = 'required';
				$preset['profile']['instagram']['male'] = $request->input('profile_instagram_male');
				$preset['profile']['instagram']['female'] = $request->input('profile_instagram_female');
			endif;
			if ($request->profile_parent_show!='on') :
				$column['profile_parent_male_father'] = 'required';
				$column['profile_parent_male_mother'] = 'required';
				$column['profile_parent_male_childhood'] = 'required';
				$column['profile_parent_female_father'] = 'required';
				$column['profile_parent_female_mother'] = 'required';
				$column['profile_parent_female_childhood'] = 'required';
				$preset['profile']['parent']['male']['father'] = $request->input('profile_parent_male_father');
				$preset['profile']['parent']['male']['mother'] = $request->input('profile_parent_male_mother');
				$preset['profile']['parent']['male']['childhood'] = $request->input('profile_parent_male_childhood');
				$preset['profile']['parent']['female']['father'] = $request->input('profile_parent_female_father');
				$preset['profile']['parent']['female']['mother'] = $request->input('profile_parent_female_mother');
				$preset['profile']['parent']['female']['childhood'] = $request->input('profile_parent_female_childhood');
			endif;
			// Foto pria
			$maleMethod = $request->input('profile_photo_male__method');
			if ($maleMethod === 'upload') :
				$column['profile_photo_male'] = 'required|mimes:jpg,jpeg,png';
				if ($request->hasFile('profile_photo_male')) :
					$image_name = $request->file('profile_photo_male')->hashName();
					Storage::disk('public')->put($image_name, file_get_contents($request->file('profile_photo_male')));
					image_reducer(file_get_contents($request->file('profile_photo_male')), $image_name);
					$preset['profile']['photo']['male']['method'] = 'storage';
					$preset['profile']['photo']['male']['image'] = $image_name;
					Strbox::create(['title' => $request->profile_name_male, 'file' => $image_name, 'file_type' => 'image', 'user_id' => Auth::user()->id, 'ip_addr' => $_SERVER['REMOTE_ADDR']]);
				endif;
			elseif ($maleMethod === 'avatar' || $maleMethod === 'storage') :
				$column['profile_photo_male__filename'] = 'required';
				$preset['profile']['photo']['male']['method'] = $maleMethod;
				$preset['profile']['photo']['male']['image'] = $request->input('profile_photo_male__filename');
			elseif ($maleMethod === 'none' || empty($maleMethod)) :
				// Foto dihapus
				$preset['profile']['photo']['male']['method'] = 'none';
				$preset['profile']['photo']['male']['image'] = '';
			endif;
			// Foto wanita
			$femaleMethod = $request->input('profile_photo_female__method');
			if ($femaleMethod === 'upload') :
				$column['profile_photo_female'] = 'required|mimes:jpg,jpeg,png';
				if ($request->hasFile('profile_photo_female')) :
					$image_name = $request->file('profile_photo_female')->hashName();
					Storage::disk('public')->put($image_name, file_get_contents($request->file('profile_photo_female')));
					image_reducer(file_get_contents($request->file('profile_photo_female')), $image_name);
					$preset['profile']['photo']['female']['method'] = 'storage';
					$preset['profile']['photo']['female']['image'] = $image_name;
					Strbox::create(['title' => $request->profile_name_female, 'file' => $image_name, 'file_type' => 'image', 'user_id' => Auth::user()->id, 'ip_addr' => $_SERVER['REMOTE_ADDR']]);
				endif;
			elseif ($femaleMethod === 'avatar' || $femaleMethod === 'storage') :
				$column['profile_photo_female__filename'] = 'required';
				$preset['profile']['photo']['female']['method'] = $femaleMethod;
				$preset['profile']['photo']['female']['image'] = $request->input('profile_photo_female__filename');
			elseif ($femaleMethod === 'none' || empty($femaleMethod)) :
				$preset['profile']['photo']['female']['method'] = 'none';
				$preset['profile']['photo']['female']['image'] = '';
			endif;
			// Nama, bingkai, toggle
			$preset['profile']['name']['male'] = $request->input('profile_name_male');
			$preset['profile']['name']['female'] = $request->input('profile_name_female');
			$preset['profile']['photo']['male']['frame'] = $request->input('profile_photo_male_frame') ?? '';
			$preset['profile']['photo']['female']['frame'] = $request->input('profile_photo_female_frame') ?? '';
			$preset['profile']['instagram']['show'] = ($request->input('profile_instagram_show') === 'on') ? false : true;
			$preset['profile']['parent']['show'] = ($request->input('profile_parent_show') === 'on') ? false : true;
		elseif ($menu=='detail') :
			$column['detail_calendar_date'] = 'required';
			$column['detail_calendar_time'] = 'required';
			$column['detail_calendar_timezone'] = 'required';
			$column['detail_location_address'] = 'required';
			$column['detail_location_map'] = 'required';
			if ($request->detail_countdown_show!='on') :
				$column['detail_countdown_style'] = 'required';
				$preset['detail']['countdown']['style'] = $request->input('detail_countdown_style');
			endif;
			if ($request->detail_calendar_save_show!='on') :
				$column['detail_calendar_save_content'] = 'required';
				$preset['detail']['calendar']['save']['content'] = $request->input('detail_calendar_save_content');
			endif;
			// new preset
			$preset['detail']['calendar']['date'] = $request->input('detail_calendar_date');
			$preset['detail']['calendar']['time'] = $request->input('detail_calendar_time');
			$preset['detail']['calendar']['timezone'] = $request->input('detail_calendar_timezone');
			$preset['detail']['calendar']['save']['show'] = ($request->input('detail_calendar_save_show')=='on') ? false : true;
			$preset['detail']['countdown']['show'] = ($request->input('detail_countdown_show')=='on') ? false : true;
			$preset['detail']['location']['address'] = $request->input('detail_location_address');
			$preset['detail']['location']['map'] = $request->input('detail_location_map');
			$preset['detail']['additional']['show'] = ($request->input('detail_additional_show')=='on') ? false : true;
			$preset['detail']['additional']['closing'] = $request->input('detail_additional_closing') ?? null;
			if ($request->detail_additional_special!='') :
				$preset['detail']['additional']['special'] = $request->input('detail_additional_special') ?? [];
			endif;
		elseif ($menu=='quote') :
			$column['quote_content'] = 'required';
			// new preset
			$preset['quote']['content'] = $request->input('quote_content');
			$preset['quote']['decoration'] = $request->input('quote_decoration');
		elseif ($menu=='event') :
			// gallery redirected to menu.event-add
		elseif ($menu=='story') :
			// gallery redirected to menu.story-add
		elseif ($menu=='gallery') :
			// gallery redirected to menu.gallery-add
		elseif ($menu=='music') :
			if ($request->music_show=='on') :
				$column['music_url'] = 'required';
				$preset['music']['title'] = $request->input('music_title');
				$preset['music']['url'] = $request->input('music_url');
			endif;
			$preset['music']['show'] = ($request->input('music_show')=='on') ? true : false;
		elseif ($menu=='rsvp') :
			$column['rsvp_title'] = 'required';
			$column['rsvp_content'] = 'required';
			$column['rsvp_yes_option'] = 'required';
			$column['rsvp_yes_content'] = 'required';
			$column['rsvp_no_option'] = 'required';
			$column['rsvp_no_content'] = 'required';
			$column['rsvp_date'] = 'required';
			// new preset
			$preset['rsvp']['title'] = $request->input('rsvp_title');
			$preset['rsvp']['content'] = $request->input('rsvp_content');
			$preset['rsvp']['date'] = $request->input('rsvp_date');
			$preset['rsvp']['yes']['option'] = $request->input('rsvp_yes_option');
			$preset['rsvp']['yes']['content'] = $request->input('rsvp_yes_content');
			$preset['rsvp']['no']['option'] = $request->input('rsvp_no_option');
			$preset['rsvp']['no']['content'] = $request->input('rsvp_no_content');
		elseif ($menu=='additional') :
			$column['slug'] = 'required';
			if ($request->additional_live_show=='on') :
				$column['additional_live_app'] = 'required';
				$column['additional_live_link'] = 'required';
				$column['additional_live_content'] = 'required';
				$preset['additional']['live']['app'] = $request->input('additional_live_app');
				$preset['additional']['live']['link'] = $request->input('additional_live_link');
				$preset['additional']['live']['content'] = $request->input('additional_live_content');
			endif;
			if ($request->additional_protocol_show=='on') :
				$column['additional_protocol_code'] = 'required';
				$column['additional_protocol_title'] = 'required';
				$column['additional_protocol_content'] = 'required';
				$preset['additional']['protocol']['code'] = $request->input('additional_protocol_code');
				$preset['additional']['protocol']['title'] = $request->input('additional_protocol_title');
				$preset['additional']['protocol']['content'] = $request->input('additional_protocol_content');
			endif;
			$preset['additional']['live']['show'] = ($request->input('additional_live_show')=='on') ? true : false;
			$preset['additional']['protocol']['show'] = ($request->input('additional_protocol_show')=='on') ? true : false;
		elseif ($menu=='gift') :
			if ($request->gift_show=='on') :
				$column['gift_title'] = 'required';
				$column['gift_content'] = 'required';
				$column['gift_bank_name'] = 'required';
				$column['gift_bank_code'] = 'required';
				$column['gift_bank_option'] = 'required';
				// new preset
				$preset['gift']['title'] = $request->input('gift_title');
				$preset['gift']['content'] = $request->input('gift_content');
				$preset['gift']['bank']['name'] = $request->input('gift_bank_name');
				$preset['gift']['bank']['code'] = $request->input('gift_bank_code');
				$preset['gift']['bank']['option'] = $request->input('gift_bank_option');
			endif;
			$preset['gift']['show'] = ($request->input('gift_show')=='on') ? true : false;
		elseif ($menu=='wishes') :
			$column['wishes_title'] = 'required';
			$column['wishes_content'] = 'required';
			// new preset
			$preset['wishes']['title'] = $request->input('wishes_title');
			$preset['wishes']['content'] = $request->input('wishes_content');
			$preset['wishes']['public'] = ($request->input('wishes_public')=='on') ? true : false;
		endif;
		$this->validate($request, $column);

		// Update slug jika menu additional
		if ($menu === 'additional' && $request->filled('slug')) {
			$newSlug = clean_str($request->input('slug'));
			$slugExists = Invitation::where('slug', $newSlug)
				->where('id', '!=', Auth::user()->inv->id)
				->exists();
			if (!$slugExists) {
				$save_inv_column['slug'] = $newSlug;
			}
		}

		$save_inv_column['preset'] = json_encode($preset);
		$recent_inv->update($save_inv_column);
		$response = ['toast'=>['icon'=>'success','title'=>'Disimpan!','text'=>'Perubahan telah disimpan.'],'page'=>'idle'];

		return response()->json($response);
	}
}
