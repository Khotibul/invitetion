<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AccountInvoice;
use App\Models\Feedback;
use App\Models\InvitationGuest;
use App\Models\InvitationGuestArrived;
use App\Models\InvitationGuestTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\InvitationGuestSouvenir;
use Illuminate\Support\Facades\Redirect;

class GuestController extends Controller
{
    private $menu = [
		'reservation' => [
			'id'    => 'reservation',
			'icon'  => 'receptionist-icon.png',
			'title' => 'penerima tamu',
			'notif' => 0,
			'url'   => 'menu.reservation',
		],
		'table-management' => [
			'id'    => 'table-management',
			'icon'  => 'table-icon.svg',
			'title' => 'kelola meja',
			'notif' => 0,
			'url'   => 'menu.management',
		],
		'souvenir' => [
			'id'    => 'souvenir',
			'icon'  => 'souvenir-icon.png',
			'title' => 'souvenir',
			'notif' => 0,
			'url'   => 'menu.souvenir',
		],
	];

	public function __construct(private $activation = null, private $active = null)
	{
		$this->middleware(function ($request, $next) {
			$this->activation = AccountInvoice::select('date', 'package_id')
				->with('pack')
				->current()
				->first();

			if ($this->activation !== null && $this->activation->pack) {
				$this->active = json_decode($this->activation->pack->content)->active ?? 0;
				if (isexpired($this->activation->date, $this->active) === false) {
					return $next($request);
				}
				Redirect::to('dashboard/upgrade')->send();
			} else {
				Redirect::to('dashboard/account-transaction')->send();
			}
        });
	}

    public function guestbook(): Response
	{
		$access  = AccountInvoice::select('package_id')->with('pack')->current()->first();
		$menu    = $this->menu;
		$invId   = Auth::user()->inv?->id;

		$packContent = $access?->pack ? json_decode($access->pack->content) : null;
		$limitGuest  = ($packContent && isset($packContent->guest) && $packContent->guest === 'unlimited')
			? '∞'
			: ($packContent->guest ?? 0);

		$totalGuest  = $invId ? InvitationGuest::where('invitation_id', $invId)->count() : 0;
		$totalHadir  = $invId ? Feedback::where('invitation_id', $invId)->where('type', 'present')
			->whereRaw(json_search_raw('content', '"option":"yes"') . ' OR ' . json_search_raw('content', '"option":"hadir"'))
			->count() : 0;
		$totalTidak  = $invId ? Feedback::where('invitation_id', $invId)->where('type', 'present')
			->whereRaw('NOT (' . json_search_raw('content', '"option":"yes"') . ' OR ' . json_search_raw('content', '"option":"hadir"') . ')')
			->count() : 0;

		$bagpack = [
			'guest'       => $totalGuest,
			'limitGuest'  => $limitGuest,
			'hadir'       => $totalHadir,
			'tidak_hadir' => $totalTidak,
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('guestbook.guestbook', compact('menu', 'data'));
	}

    public function m_reservation(): Response|RedirectResponse
	{
		if (!Auth::user()->acc || Auth::user()->acc->guestbook == 0) {
			return redirect()->route('packages');
		}

		$menu  = $this->menu['reservation'];
		$invId = Auth::user()->inv?->id;

		$guests = $invId
			? InvitationGuest::where('invitation_id', $invId)
				->orderBy('name')
				->get()
				->map(function ($g) {
					$g->name_data = json_decode($g->name, true);
					return $g;
				})
			: collect();

		$arrived = $invId
			? InvitationGuestArrived::where('invitation_id', $invId)->pluck('guest_id')->toArray()
			: [];

		$bagpack = [
			'guests'  => $guests,
			'arrived' => $arrived,
			'total'   => $guests->count(),
			'checked' => count($arrived),
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('guestbook.m-reservation', compact('menu', 'data'));
	}

	public function m_reservation_checkin(Request $request): JsonResponse
	{
		$this->validate($request, ['guest_id' => 'required|integer']);

		$invId = Auth::user()->inv?->id;
		$guest = InvitationGuest::where('id', $request->guest_id)
			->where('invitation_id', $invId)
			->first();

		if (!$guest) {
			return response()->json(['toast' => ['icon' => 'error', 'title' => 'Tamu tidak ditemukan']], 404);
		}

		$existing = InvitationGuestArrived::where('guest_id', $request->guest_id)
			->where('invitation_id', $invId)
			->first();

		if ($existing) {
			$existing->delete();
			return response()->json(['toast' => ['icon' => 'info', 'title' => 'Check-in dibatalkan'], 'status' => 'unchecked']);
		}

		InvitationGuestArrived::create([
			'guest_id'      => $request->guest_id,
			'invitation_id' => $invId,
			'ip_addr'       => $_SERVER['REMOTE_ADDR'],
		]);

		return response()->json(['toast' => ['icon' => 'success', 'title' => 'Tamu berhasil check-in!'], 'status' => 'checked']);
	}

	public function m_reservation_search(Request $request): JsonResponse
	{
		$invId = Auth::user()->inv?->id;
		$query = $request->get('q', '');

		$guests = InvitationGuest::where('invitation_id', $invId)
			->whereRaw(ilike_raw('name', $query))
			->limit(20)
			->get()
			->map(function ($g) use ($invId) {
				$nameData = json_decode($g->name, true);
				$arrived  = InvitationGuestArrived::where('guest_id', $g->id)
					->where('invitation_id', $invId)
					->exists();
				return [
					'id'       => $g->id,
					'name'     => $nameData['name'] ?? '-',
					'location' => $nameData['location'] ?? '-',
					'type'     => $g->type,
					'arrived'  => $arrived,
				];
			});

		return response()->json($guests);
	}

	public function m_management(): Response|RedirectResponse
	{
		if (!Auth::user()->acc || Auth::user()->acc->guestbook == 0) {
			return redirect()->route('packages');
		}

		$menu  = $this->menu['table-management'];
		$invId = Auth::user()->inv?->id;

		$tables = $invId
			? InvitationGuestTables::where('invitation_id', $invId)->orderBy('table_code')->get()
			: collect();

		$bagpack = [
			'tables' => $tables,
			'total'  => $tables->count(),
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('guestbook.m-management', compact('menu', 'data'));
	}

	public function m_management_add(Request $request): JsonResponse
	{
		$this->validate($request, [
			'table_code'  => 'required|string|max:50',
			'table_stock' => 'required|integer|min:1',
		]);

		InvitationGuestTables::create([
			'table_code'    => $request->table_code,
			'stock'         => $request->table_stock,
			'grade'         => $request->table_grade ?? 'basic',
			'invitation_id' => Auth::user()->inv->id,
			'ip_addr'       => $_SERVER['REMOTE_ADDR'],
			'user_id'       => Auth::user()->id,
		]);

		return response()->json(['toast' => ['icon' => 'success', 'title' => 'Meja ditambahkan!'], 'page' => 'reload']);
	}

	public function m_management_delete(int $id): JsonResponse
	{
		InvitationGuestTables::where('id', $id)
			->where('invitation_id', Auth::user()->inv->id)
			->delete();

		return response()->json(['deleted']);
	}

    public function m_souvenir(): Response|RedirectResponse
	{
		if (!Auth::user()->acc || Auth::user()->acc->guestbook == 0) {
			return redirect()->route('packages');
		}

		$menu     = $this->menu['souvenir'];
		$souvenir = InvitationGuestSouvenir::where('invitation_id', Auth::user()->inv->id)
			->latest()
			->paginate(10);

		$bagpack = [
			'total' => InvitationGuestSouvenir::where('invitation_id', Auth::user()->inv->id)->count(),
			'stock' => InvitationGuestSouvenir::where('invitation_id', Auth::user()->inv->id)->sum('stock'),
		];
		$data = json_decode(json_encode($bagpack));

		return response()->view('guestbook.m-souvenir', compact('menu', 'data', 'souvenir'));
	}

	public function m_souvenir_add(Request $request): JsonResponse
	{
		$this->validate($request, [
			'souvenir_title' => 'required|string|max:110',
			'souvenir_stock' => 'required|integer|min:0',
			'souvenir_grade' => 'required|in:basic,premium,exclusive',
		]);

		InvitationGuestSouvenir::create([
			'title'         => $request->souvenir_title,
			'stock'         => $request->souvenir_stock,
			'grade'         => $request->souvenir_grade,
			'file'          => $request->souvenir_file ?? null,
			'invitation_id' => Auth::user()->inv->id,
			'ip_addr'       => $_SERVER['REMOTE_ADDR'],
			'user_id'       => Auth::user()->id,
		]);

		return response()->json([
			'toast' => ['icon' => 'success', 'title' => 'Disimpan!', 'text' => 'Souvenir '.$request->souvenir_title.' ditambahkan.'],
			'page'  => 'reload',
		]);
	}

	public function m_souvenir_edit(Request $request, int $id): JsonResponse
	{
		$this->validate($request, [
			'souvenir_title' => 'required|string|max:110',
			'souvenir_stock' => 'required|integer|min:0',
			'souvenir_grade' => 'required|in:basic,premium,exclusive',
		]);

		InvitationGuestSouvenir::where('id', $id)
			->where('invitation_id', Auth::user()->inv->id)
			->update([
				'title'   => $request->souvenir_title,
				'stock'   => $request->souvenir_stock,
				'grade'   => $request->souvenir_grade,
				'file'    => $request->souvenir_file ?? null,
				'ip_addr' => $_SERVER['REMOTE_ADDR'],
				'user_id' => Auth::user()->id,
			]);

		return response()->json([
			'toast' => ['icon' => 'success', 'title' => 'Disimpan!', 'text' => 'Perubahan telah disimpan.'],
			'page'  => 'idle',
		]);
	}

	public function m_souvenir_delete(int $id): JsonResponse
	{
		InvitationGuestSouvenir::where('id', $id)
			->where('invitation_id', Auth::user()->inv->id)
			->delete();

		return response()->json(['deleted']);
	}

	public function m_souvenir_show(int $id): JsonResponse
	{
		$souvenir = InvitationGuestSouvenir::select('id', 'title', 'stock', 'grade', 'file')
			->where('id', $id)
			->where('invitation_id', Auth::user()->inv->id)
			->firstOrFail();

		$souvenir->image = $souvenir->file ? url('storage/sm/'.$souvenir->file) : null;
		$souvenir->url   = route('menu.souvenir-delete', $souvenir->id);

		return response()->json($souvenir);
	}
}
