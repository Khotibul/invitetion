<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
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
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
	public function invitation(string $slug = null): Response|RedirectResponse
	{
		if (empty($slug)) {
			return abort(404);
		}

		$invitation = Invitation::select('id', 'title', 'slug', 'file', 'preset', 'publish', 'user_id', 'template_id')
			->with('temp:id,url,title')
			->where('slug', $slug)
			->first();

		if (!$invitation) {
			return abort(404, 'Undangan tidak ditemukan');
		}

		// Cek aktivasi — status CONFIRMED (case-insensitive)
		$invitation_activation = AccountInvoice::select('date', 'package_id')
			->with('pack:id,content,title')
			->whereRaw('UPPER(status) = ?', ['CONFIRMED'])
			->where('user_id', $invitation->user_id)
			->latest()
			->first();

		$invitation_active = 0;
		$activation_date   = date('Y-m-d');

		if ($invitation_activation) {
			$activation_date = $invitation_activation->date;
			if ($invitation_activation->pack) {
				$content = json_decode($invitation_activation->pack->content);
				$invitation_active = $content->active ?? 0;
			}
		}

		// Cek expired
		if (isexpired($activation_date, $invitation_active) === true) {
			return response()->view('errors.invitation-expired', compact('invitation'), 402);
		}

		// Undangan draft:
		// - Pemilik yang login: bisa akses (preview mode)
		// - Siapapun yang punya link langsung: bisa akses (share preview)
		// - Hanya blokir jika tidak ada slug sama sekali (sudah dicek di atas)
		$isPreview = false;
		if ($invitation->publish !== 'publish') {
			$isOwner = auth()->check() && auth()->id() === (int) $invitation->user_id;
			// Izinkan akses tapi tandai sebagai preview
			$isPreview = true;
			// Jika bukan pemilik dan bukan dari link langsung, tetap izinkan
			// (link share sudah cukup sebagai "token" akses)
		}

		$invitation->title = implode(' & ', json_decode($invitation->title, true) ?? ['-', '-']);

		$data = json_decode($invitation->preset);

		if (!$data) {
			return abort(500, 'Data undangan tidak valid');
		}

		// Protocol
		$protocol = null;
		if (isset($data->additional->protocol->code)) {
			$protocol = TemplateAssets::select('content')
				->where('type', 'protocol')
				->whereId($data->additional->protocol->code)
				->first();
		}

		$packContent = $invitation_activation?->pack
			? json_decode($invitation_activation->pack->content)
			: null;

		// Load semua relasi sekaligus — hindari N+1
		$invId = $invitation->id;
		$photo = InvitationGallery::select('id', 'type', 'title', 'content', 'invitation_id')
			->where('type', 'photo')->where('invitation_id', $invId)->first();
		$video = InvitationGallery::select('id', 'type', 'title', 'content', 'invitation_id')
			->where('type', 'video')->where('invitation_id', $invId)->first();

		if ($photo) $photo->prop = json_decode($photo->content);
		if ($video) $video->prop = json_decode($video->content);

		$other = [
			'video'    => $video,
			'photo'    => $photo,
			'protocol' => $protocol,
			'event'    => InvitationEvent::select('id', 'title', 'content', 'publish', 'invitation_id')
				->where('invitation_id', $invId)->get(),
			'story'    => InvitationStory::select('id', 'title', 'content', 'created_at', 'invitation_id')
				->where('invitation_id', $invId)->get(),
			'guest'    => null,
		];

		// Guest personalization — cari berdasarkan slug tamu
		$guestSlug = request()->get('to');
		if (!empty($guestSlug)) {
			$guest = InvitationGuest::select('id', 'type', 'name', 'slug')
				->where('slug', $guestSlug)
				->where('invitation_id', $invId)
				->first();
			$other['guest'] = $guest ? json_decode($guest->name, true) : null;
		}

		$templateUrl = $invitation->temp?->url ?? 'default';

		if (!\Illuminate\Support\Facades\View::exists('template.'.$templateUrl)) {
			$templateUrl = 'default';
		}

		$helpers = $this->resolveHelperVars($data, $invitation, $other);

		$response = response()->view(
			'template.'.$templateUrl,
			array_merge(compact('invitation', 'data', 'other'), $helpers, ['isPreview' => $isPreview ?? false])
		);

		// Cache-Control: undangan publish bisa di-cache browser 5 menit
		$response->header('Cache-Control', 'public, max-age=300, stale-while-revalidate=60');
		$response->header('Vary', 'Accept-Encoding');

		return $response;
	}

	public function invitation_present(Request $request, string $slug): JsonResponse
	{
		$this->validate($request, [
			'name'   => 'required|string|max:100',
			'option' => 'required',
			'amount' => 'nullable|numeric|min:1',
		], ['required' => 'Kolom harus diisi.']);

		$invitation = Invitation::select('id', 'preset')->where('slug', $slug)->first();
		if (!$invitation) {
			return response()->json(['message' => 'Undangan tidak ditemukan.'], 404);
		}

		$preset = json_decode($invitation->preset, true)['rsvp'] ?? [];

		$spam = Feedback::whereDate('created_at', Carbon::today())
			->where('type', 'present')
			->where('ip_addr', $_SERVER['REMOTE_ADDR'])
			->count();

		if ($spam > 5) {
			return response()->json(['message' => 'Batas pengiriman tercapai. Coba lagi besok.']);
		}

		Feedback::create([
			'type'          => 'present',
			'content'       => json_encode([
				'name'   => $request->name,
				'option' => $request->option,
				'amount' => $request->amount ?? 1,
			]),
			'invitation_id' => $invitation->id,
			'ip_addr'       => $_SERVER['REMOTE_ADDR'],
		]);

		$message = $preset[$request->option]['content'] ?? 'Terima kasih atas konfirmasi kehadiran Anda.';

		return response()->json(['message' => $message]);
	}

	public function invitation_wish(Request $request, string $slug): JsonResponse
	{
		$this->validate($request, [
			'name'    => 'required|string|max:100',
			'phone'   => 'required|string|max:20',
			'message' => 'required|string|max:500',
		], ['required' => ' - Kolom harus diisi.']);

		$invitation = Invitation::select('id')->where('slug', $slug)->first();
		if (!$invitation) {
			return response()->json(['message' => 'Undangan tidak ditemukan.'], 404);
		}

		$spam = Feedback::whereDate('created_at', Carbon::today())
			->where('type', 'wishes')
			->where('ip_addr', $_SERVER['REMOTE_ADDR'])
			->count();

		if ($spam > 5) {
			return response()->json(['message' => 'Batas pengiriman tercapai. Coba lagi besok.']);
		}

		Feedback::create([
			'type'          => 'wishes',
			'content'       => json_encode([
				'name'    => $request->name,
				'phone'   => $request->phone,
				'message' => $request->message,
			]),
			'invitation_id' => $invitation->id,
			'ip_addr'       => $_SERVER['REMOTE_ADDR'],
		]);

		return response()->json(['message' => 'Ucapan berhasil dikirim. Terima kasih!']);
	}

	// Preview Template (untuk admin/publik)
	public function template(string $slug): Response
	{
		$template = Template::select('title', 'slug', 'preset', 'url', 'file')
			->where('slug', $slug)
			->publish()
			->firstOrFail();

		$data = json_decode($template->preset);
		if (!is_object($data)) $data = (object)[];

		// Isi default untuk semua key yang mungkin kosong agar semua template aman saat preview (tanpa login).
		$male   = (string)($data->cover->name->male   ?? $data->profile->name->male   ?? 'Mempelai Pria');
		$female = (string)($data->cover->name->female ?? $data->profile->name->female ?? 'Mempelai Wanita');
		$data   = $this->fillPresetDefaultsWithNames($data, $male, $female);

		$other = [
			'event'    => [],
			'story'    => [],
			'photo'    => null,
			'video'    => null,
			'guest'    => null,
			'protocol' => null,
		];

		$invitation = (object)[
			'title' => 'Preview Template',
			'file'  => $template->file,
			'slug'  => $slug,
			'temp'  => $template,
		];

		$helpers = $this->resolveHelperVars($data, $invitation, $other);

		return response()->view('template.'.$template->url, array_merge(compact('data', 'invitation', 'other'), $helpers));
	}

	// Preview undangan member — bypass middleware InvitationController
	public function preview_member_invitation(): Response
	{
		$user = auth()->user();
		$inv  = $user?->inv;

		$html = fn(string $msg) => response(
			'<!DOCTYPE html><html><head><meta charset="UTF-8">
			<style>body{margin:0;display:flex;align-items:center;justify-content:center;
			min-height:100vh;font-family:sans-serif;background:#f8faf9;color:#888;
			flex-direction:column;gap:10px;text-align:center;padding:2rem}
			svg{color:#2d7a4f}.msg{font-size:.85rem;max-width:240px;line-height:1.6}</style>
			</head><body>
			<svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
			<p class="msg">'.$msg.'</p></body></html>',
			200,
			['Content-Type' => 'text/html']
		);

		if (!$inv)          return $html('Undangan belum dibuat.');
		if (!$inv->preset)  return $html('Data undangan belum lengkap.');

		$data = json_decode($inv->preset);
		if (!$data)         return $html('Format data tidak valid.');

		// Isi default untuk semua key yang mungkin kosong
		$data = $this->fillPresetDefaults($data, $inv);

		$templateUrl = $inv->temp?->url ?? 'default';
		if (!\Illuminate\Support\Facades\View::exists('template.'.$templateUrl)) {
			$templateUrl = 'default';
		}

		$rawTitle = json_decode($inv->title, true) ?? ['-', '-'];
		$titleStr = ($rawTitle[0] === ($rawTitle[1] ?? null))
			? $rawTitle[0]
			: implode(' & ', $rawTitle);

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

		$helpers = $this->resolveHelperVars($data, $invitation, $other);

		return response()->view('template.'.$templateUrl, array_merge(compact('invitation', 'data', 'other'), $helpers));
	}

	private function fillPresetDefaults(object $data, $inv): object
	{
		$raw    = json_decode($inv->title, true) ?? ['-', '-'];
		$male   = $raw[0] ?? '-';
		$female = $raw[1] ?? $male;

		return $this->fillPresetDefaultsWithNames($data, (string)$male, (string)$female);
	}

	private function fillPresetDefaultsWithNames(object $data, string $male, string $female): object
	{
		// design (beberapa template akses langsung tanpa null-coalescing)
		if (!isset($data->design)) $data->design = (object)[];
		$d = $data->design;
		if (!isset($d->title))      $d->title      = (object)['color'=>'#000000','font'=>'Arial','size'=>24];
		if (!isset($d->content))    $d->content    = (object)['color'=>'#333333','font'=>'Arial','size'=>14];
		if (!isset($d->background)) $d->background = '#ffffff';
		if (!isset($d->button))     $d->button     = (object)['color'=>'#ffffff','background'=>'#2d7a4f'];
		// Pastikan size ada (backward compat untuk preset lama)
		if (!isset($d->title->size))   $d->title->size   = 24;
		if (!isset($d->content->size)) $d->content->size = 14;

		// cover
		if (!isset($data->cover))                       $data->cover = (object)[];
		if (!isset($data->cover->name))                 $data->cover->name = (object)['male'=>$male,'female'=>$female,'size'=>'48','style'=>'default'];
		if (!isset($data->cover->content))              $data->cover->content = 'Undangan Pernikahan';
		if (!isset($data->cover->button))               $data->cover->button  = 'Buka Undangan';
		if (!isset($data->cover->description))          $data->cover->description = (object)['top'=>'','bottom'=>'','image'=>(object)['method'=>'none','image'=>'']];
		if (!isset($data->cover->description->image))   $data->cover->description->image = (object)['method'=>'none','image'=>''];
		if (!isset($data->cover->description->top))     $data->cover->description->top = '';
		if (!isset($data->cover->description->bottom))  $data->cover->description->bottom = '';

		// profile
		if (!isset($data->profile))                     $data->profile = (object)[];
		if (!isset($data->profile->name))               $data->profile->name = (object)['male'=>$male,'female'=>$female];
		if (!isset($data->profile->photo))              $data->profile->photo = (object)['male'=>(object)['method'=>'none','image'=>'','frame'=>''],'female'=>(object)['method'=>'none','image'=>'','frame'=>'']];
		if (!isset($data->profile->photo->male))        $data->profile->photo->male   = (object)['method'=>'none','image'=>'','frame'=>''];
		if (!isset($data->profile->photo->female))      $data->profile->photo->female = (object)['method'=>'none','image'=>'','frame'=>''];
		if (!isset($data->profile->instagram))          $data->profile->instagram = (object)['male'=>'','female'=>'','show'=>false];
		if (!isset($data->profile->parent))             $data->profile->parent = (object)['show'=>false,'male'=>(object)['father'=>'','mother'=>'','childhood'=>'1'],'female'=>(object)['father'=>'','mother'=>'','childhood'=>'1']];

		// detail
		if (!isset($data->detail))                      $data->detail = (object)[];
		if (!isset($data->detail->calendar))            $data->detail->calendar = (object)['date'=>now()->addMonths(3)->format('Y-m-d'),'time'=>'09:00','timezone'=>'wib','save'=>(object)['show'=>false,'content'=>'Simpan Tanggal']];
		if (!isset($data->detail->calendar->save))      $data->detail->calendar->save = (object)['show'=>false,'content'=>'Simpan Tanggal'];
		if (!isset($data->detail->calendar->date))      $data->detail->calendar->date = now()->addMonths(3)->format('Y-m-d');
		if (!isset($data->detail->calendar->time))      $data->detail->calendar->time = '09:00';
		if (!isset($data->detail->calendar->timezone))  $data->detail->calendar->timezone = 'wib';
		if (!isset($data->detail->countdown))           $data->detail->countdown = (object)['show'=>true,'style'=>'default'];
		if (!isset($data->detail->location))            $data->detail->location = (object)['address'=>'','map'=>''];
		if (!isset($data->detail->additional))          $data->detail->additional = (object)['show'=>false,'closing'=>'','special'=>[]];

		// lainnya
		if (!isset($data->quote))   $data->quote   = (object)['content'=>'','decoration'=>''];
		if (!isset($data->music))   $data->music   = (object)['show'=>false,'title'=>'','url'=>''];
		if (!isset($data->rsvp))    $data->rsvp    = (object)['title'=>'Konfirmasi Kehadiran','content'=>'','date'=>'','yes'=>(object)['option'=>'Hadir','content'=>'Terima kasih'],'no'=>(object)['option'=>'Tidak Hadir','content'=>'Terima kasih']];
		if (!isset($data->gift))    $data->gift    = (object)['show'=>false,'title'=>'Amplop Digital','content'=>'','bank'=>(object)['name'=>'','code'=>'','option'=>'bca']];
		if (!isset($data->wishes))  $data->wishes  = (object)['title'=>'Ucapan & Doa','content'=>'','public'=>true];
		if (!isset($data->additional)) $data->additional = (object)['live'=>(object)['show'=>false,'app'=>'','link'=>'','content'=>''],'protocol'=>(object)['show'=>false,'code'=>[],'title'=>'','content'=>'']];

		return $data;
	}

	/**
	 * Compute all helper variables that helpers.blade.php provides.
	 * Passing them directly from the controller guarantees they are
	 * available in the view regardless of Blade @php scope quirks.
	 */
	private function resolveHelperVars(object $data, object $invitation, array $other): array
	{
		// Nama lengkap (profil) — untuk section couple/profil
		$maleName   = (string)($data->profile->name->male   ?? $data->cover->name->male   ?? 'Mempelai Pria');
		$femaleName = (string)($data->profile->name->female ?? $data->cover->name->female ?? 'Mempelai Wanita');

		// Nama panggilan (cover) — untuk cover overlay, hero, judul, footer
		$maleNickname   = (string)($data->cover->name->male   ?? $maleName);
		$femaleNickname = (string)($data->cover->name->female ?? $femaleName);

		$maleInitial   = strtoupper(substr(trim($maleName),   0, 1)) ?: 'M';
		$femaleInitial = strtoupper(substr(trim($femaleName), 0, 1)) ?: 'W';

		// ── Tanggal & waktu
		$weddingDate          = $data->detail->calendar->date     ?? now()->addMonths(3)->format('Y-m-d');
		$weddingTime          = $data->detail->calendar->time     ?? '09:00';
		$weddingTz            = strtoupper($data->detail->calendar->timezone ?? 'WIB');
		$weddingDateFormatted = Carbon::parse($weddingDate)->locale('id')->translatedFormat('l, d F Y');
		$weddingDateShort     = Carbon::parse($weddingDate)->locale('id')->translatedFormat('d F Y');

		// ── Foto pasangan
		$maleMethod   = $data->profile->photo->male->method   ?? 'none';
		$maleImg      = $data->profile->photo->male->image     ?? '';
		$maleFrame    = $data->profile->photo->male->frame     ?? '';
		$femaleMethod = $data->profile->photo->female->method  ?? 'none';
		$femaleImg    = $data->profile->photo->female->image   ?? '';
		$femaleFrame  = $data->profile->photo->female->frame   ?? '';

		$maleSrc   = (!empty($maleImg)   && $maleMethod   !== 'none')
			? ($maleMethod   === 'storage' ? storage_url('sm/'.$maleImg)   : storage_url('avatar/'.$maleImg))
			: null;
		$femaleSrc = (!empty($femaleImg) && $femaleMethod !== 'none')
			? ($femaleMethod === 'storage' ? storage_url('sm/'.$femaleImg) : storage_url('avatar/'.$femaleImg))
			: null;

		// ── Foto sampul
		$coverObj = $data->cover->description->image ?? null;
		$coverSrc = null;
		if ($coverObj && !empty($coverObj->image ?? '')) {
			$method = $coverObj->method ?? '';
			if ($method === 'asset')        $coverSrc = asset($coverObj->image);
			elseif ($method === 'storage')  $coverSrc = storage_url('sm/'.$coverObj->image);
			elseif ($method === 'avatar')   $coverSrc = storage_url('avatar/'.$coverObj->image);
			else                            $coverSrc = storage_url($coverObj->image);
		}

		// ── OG image
		$invFile = \Illuminate\Support\Str::startsWith($invitation->file ?? '', 'template/')
			? asset($invitation->file)
			: storage_url($invitation->file ?? '');
		$ogImage = $coverSrc ?? $invFile;

		// ── Lokasi
		$locationAddress = $data->detail->location->address ?? '';
		$locationMap     = $data->detail->location->map     ?? '';

		// ── Quote
		$quoteContent = $data->quote->content ?? '';

		// ── Teks cover
		$coverContent = $data->cover->content ?? 'Undangan Pernikahan';
		$coverButton  = $data->cover->button  ?? 'Buka Undangan';
		$coverTop     = $data->cover->description->top    ?? '';
		$coverBottom  = $data->cover->description->bottom ?? '';

		// ── Orang tua
		$showParent      = ($data->profile->parent->show ?? false) === true;
		$maleFather      = $data->profile->parent->male->father      ?? '';
		$maleMother      = $data->profile->parent->male->mother      ?? '';
		$maleChildhood   = $data->profile->parent->male->childhood   ?? '1';
		$femaleFather    = $data->profile->parent->female->father    ?? '';
		$femaleMother    = $data->profile->parent->female->mother    ?? '';
		$femaleChildhood = $data->profile->parent->female->childhood ?? '1';

		// ── Instagram
		$showIg   = ($data->profile->instagram->show ?? false) === true;
		$maleIg   = $data->profile->instagram->male   ?? '';
		$femaleIg = $data->profile->instagram->female ?? '';

		// ── RSVP
		$rsvpTitle   = $data->rsvp->title        ?? 'Konfirmasi Kehadiran';
		$rsvpContent = $data->rsvp->content       ?? '';
		$rsvpYes     = $data->rsvp->yes->option   ?? 'Hadir';
		$rsvpNo      = $data->rsvp->no->option    ?? 'Tidak Hadir';
		$rsvpYesMsg  = $data->rsvp->yes->content  ?? 'Terima kasih';
		$rsvpNoMsg   = $data->rsvp->no->content   ?? 'Terima kasih';

		// ── Wishes
		$showWishes    = ($data->wishes->public ?? false) === true;
		$wishesTitle   = $data->wishes->title   ?? 'Ucapan & Doa';
		$wishesContent = $data->wishes->content ?? '';

		// ── Gift
		$showGift    = ($data->gift->show ?? false) === true;
		$giftTitle   = $data->gift->title        ?? 'Amplop Digital';
		$giftContent = $data->gift->content      ?? '';
		$giftBank    = $data->gift->bank->option ?? '';
		$giftCode    = $data->gift->bank->code   ?? '';
		$giftName    = $data->gift->bank->name   ?? '';

		// ── Countdown & penutup
		$showCountdown = ($data->detail->countdown->show ?? true) === true;
		$showClosing   = ($data->detail->additional->show ?? false) === true;
		$closingText   = $data->detail->additional->closing ?? '';

		// ── Musik
		$showMusic = ($data->music->show ?? false) === true;
		$_rawMusicUrl = $data->music->url ?? '';
		// Konversi "url" ke full URL:
		// - format baru: filename saja (e.g. "abc123.mp3") -> storage_url('audio/...')
		// - format lama: full URL -> pakai apa adanya
		if (!empty($_rawMusicUrl) && filter_var($_rawMusicUrl, FILTER_VALIDATE_URL)) {
			$musicUrl = $_rawMusicUrl;
		} else {
			$musicUrl = (!empty($_rawMusicUrl)) ? storage_url('audio/'.$_rawMusicUrl) : '';
		}

		// ── Galeri
		$galleryFiles = (!empty($other['photo']) && !empty($other['photo']->prop->file ?? []))
			? $other['photo']->prop->file
			: [];
		$galleryTitle = $other['photo']->title ?? 'Galeri Foto';

		// ── Slug untuk route
		$invSlug = $invitation->slug ?? request()->route('slug') ?? '';

		return compact(
			'maleName', 'femaleName', 'maleNickname', 'femaleNickname',
			'maleInitial', 'femaleInitial',
			'weddingDate', 'weddingTime', 'weddingTz', 'weddingDateFormatted', 'weddingDateShort',
			'maleMethod', 'maleImg', 'maleFrame', 'femaleMethod', 'femaleImg', 'femaleFrame',
			'maleSrc', 'femaleSrc', 'coverSrc', 'ogImage',
			'locationAddress', 'locationMap',
			'quoteContent', 'coverContent', 'coverButton', 'coverTop', 'coverBottom',
			'showParent', 'maleFather', 'maleMother', 'maleChildhood',
			'femaleFather', 'femaleMother', 'femaleChildhood',
			'showIg', 'maleIg', 'femaleIg',
			'rsvpTitle', 'rsvpContent', 'rsvpYes', 'rsvpNo', 'rsvpYesMsg', 'rsvpNoMsg',
			'showWishes', 'wishesTitle', 'wishesContent',
			'showGift', 'giftTitle', 'giftContent', 'giftBank', 'giftCode', 'giftName',
			'showCountdown', 'showClosing', 'closingText',
			'showMusic', 'musicUrl',
			'galleryFiles', 'galleryTitle',
			'invSlug'
		);
	}
}
