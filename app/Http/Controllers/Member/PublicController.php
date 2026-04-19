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

		if ($invitation->publish !== 'publish') {
			return abort(404, 'Undangan belum dipublikasikan');
		}

		$invitation->title = implode(' & ', json_decode($invitation->title, true) ?? ['-', '-']);

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

		if (isexpired($activation_date, $invitation_active) === false) {
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
					: [],
				'story'    => ($packContent && !empty($packContent->story))
					? InvitationStory::where('invitation_id', $invitation->id)->get()
					: [],
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

			return response()->view('template.'.$templateUrl, compact('invitation', 'data', 'other'));
		}

		return abort(402, 'Undangan sudah tidak aktif');
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

	// Preview Template
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

		// Objek invitation dummy untuk template preview
		$invitation = (object)[
			'title' => 'Preview Template',
			'file'  => null,
			'temp'  => $template,
		];

		return response()->view('template.'.$template->url, compact('data', 'invitation', 'other'));
	}
}
