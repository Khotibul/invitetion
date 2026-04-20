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

		$invitation = Invitation::select('id', 'title', 'file', 'preset', 'publish', 'user_id', 'template_id')
			->where('slug', $slug)
			->first();

		if (!$invitation) {
			return abort(404, 'Undangan tidak ditemukan');
		}

		// Cek aktivasi — status CONFIRMED (case-insensitive)
		$invitation_activation = AccountInvoice::select('date', 'package_id')
			->with('pack')
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

		// Cek expired — jika expired tampilkan halaman expired, bukan 404
		if (isexpired($activation_date, $invitation_active) === true) {
			return response()->view('errors.invitation-expired', compact('invitation'), 402);
		}

		// Undangan draft hanya bisa dilihat oleh pemiliknya (member yang login)
		if ($invitation->publish !== 'publish') {
			$isOwner = auth()->check() && auth()->id() === (int) $invitation->user_id;
			if (!$isOwner) {
				return abort(404, 'Undangan belum dipublikasikan');
			}
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

		$other = [
			'video'    => InvitationGallery::where('type', 'video')->where('invitation_id', $invitation->id)->first(),
			'photo'    => InvitationGallery::where('type', 'photo')->where('invitation_id', $invitation->id)->first(),
			'protocol' => $protocol,
			'event'    => ($packContent && !empty($packContent->event))
				? InvitationEvent::where('invitation_id', $invitation->id)->get()
				: InvitationEvent::where('invitation_id', $invitation->id)->get(),
			'story'    => ($packContent && !empty($packContent->story))
				? InvitationStory::where('invitation_id', $invitation->id)->get()
				: InvitationStory::where('invitation_id', $invitation->id)->get(),
			'guest'    => null,
		];

		if ($other['photo']) {
			$other['photo']->prop = json_decode($other['photo']->content);
		}
		if ($other['video']) {
			$other['video']->prop = json_decode($other['video']->content);
		}

		// Guest personalization
		$guestSlug = request()->get('to');
		if (!empty($guestSlug)) {
			$guest = InvitationGuest::select('type', 'name')
				->where('slug', $guestSlug)
				->where('invitation_id', $invitation->id)
				->first();
			$other['guest'] = $guest ? json_decode($guest->name, true) : null;
		}

		$templateUrl = $invitation->temp?->url ?? 'default';

		// Fallback jika view template tidak ada
		if (!\Illuminate\Support\Facades\View::exists('template.'.$templateUrl)) {
			$templateUrl = 'default';
		}

		return response()->view('template.'.$templateUrl, compact('invitation', 'data', 'other'));
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

		$data  = json_decode($template->preset);
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
			'file'  => null,
			'temp'  => $template,
		];

		return response()->view('template.'.$template->url, compact('data', 'invitation', 'other'));
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

		return response()->view('template.'.$templateUrl, compact('invitation', 'data', 'other'));
	}

	private function fillPresetDefaults(object $data, $inv): object
	{
		$raw    = json_decode($inv->title, true) ?? ['-', '-'];
		$male   = $raw[0] ?? '-';
		$female = $raw[1] ?? $male;

		// cover
		if (!isset($data->cover))                       $data->cover = (object)[];
		if (!isset($data->cover->name))                 $data->cover->name = (object)['male'=>$male,'female'=>$female,'size'=>'48','style'=>'default'];
		if (!isset($data->cover->content))              $data->cover->content = 'Undangan Pernikahan';
		if (!isset($data->cover->button))               $data->cover->button  = 'Buka Undangan';
		if (!isset($data->cover->description))          $data->cover->description = (object)['top'=>'','bottom'=>'','image'=>(object)['method'=>'none','image'=>'']];
		if (!isset($data->cover->description->image))   $data->cover->description->image = (object)['method'=>'none','image'=>''];

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
}
