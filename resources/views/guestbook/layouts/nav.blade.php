@php
	$user = Auth::user();
	$avatarFile = $user?->acc?->file;
	$isRemoteAvatar = $user?->third_party === 'google' && !empty($avatarFile);
	$avatarSrc = $isRemoteAvatar
		? $avatarFile
		: (!empty($avatarFile) ? url('storage/xs/'.$avatarFile) : asset('modules/dropify/src/images/cover.jpg'));
	$avatarFallback = !empty($avatarFile) && !$isRemoteAvatar
		? url('storage/'.$avatarFile)
		: asset('modules/dropify/src/images/cover.jpg');

	$guestbookLinks = [
		['label' => 'Dashboard', 'icon' => 'bx bxs-widget', 'route' => 'member.main', 'active' => ['member.main']],
		['label' => 'Profil', 'icon' => 'bx bx-user-circle', 'route' => 'profile', 'active' => ['profile']],
		['label' => 'Transaksi', 'icon' => 'bx bx-receipt', 'route' => 'transaction', 'active' => ['transaction']],
	];
@endphp

<header class="member-aura-nav" id="memberAuraNav">
	<div class="member-aura-container">
		<div class="member-aura-inner">
			<a href="{{ route('member.main') }}" class="member-aura-brand" aria-label="Dashboard">
				<span class="member-aura-brand-mark"><i class="bx bx-book-open"></i></span>
				<span>Guestbook Digital</span>
			</a>

			<nav class="member-aura-links" aria-label="Menu guestbook">
				@foreach($guestbookLinks as $link)
				<a href="{{ route($link['route']) }}" @class(['active' => in_array(Route::currentRouteName(), $link['active'], true)])>
					<i class="{{ $link['icon'] }}"></i>
					<span>{{ $link['label'] }}</span>
				</a>
				@endforeach
			</nav>

			<div class="member-aura-actions">
				<a href="{{ route('profile') }}" @class(['member-aura-user', 'active' => Route::currentRouteName() === 'profile'])>
					<img src="{{ $avatarSrc }}" alt="avatar" loading="lazy" onerror="this.onerror=null;this.src='{{ $avatarFallback }}'">
					<span>{{ $user?->name }}</span>
				</a>
				<button type="button" class="member-aura-menu-btn" id="memberAuraMobileOpen" aria-label="Buka menu">
					<i class="bx bx-menu"></i>
				</button>
			</div>
		</div>
	</div>
</header>

<div class="member-aura-mobile" id="memberAuraMobile" aria-hidden="true">
	<div class="member-aura-panel" role="dialog" aria-modal="true" aria-label="Menu guestbook">
		<div class="member-aura-panel-head">
			<div class="member-aura-brand">
				<span class="member-aura-brand-mark"><i class="bx bx-book-open"></i></span>
				<span>Guestbook Digital</span>
			</div>
			<button type="button" class="member-aura-menu-btn" id="memberAuraMobileClose" aria-label="Tutup menu">
				<i class="bx bx-x"></i>
			</button>
		</div>

		<a href="{{ route('profile') }}" class="member-aura-profile" data-member-aura-close>
			<img src="{{ $avatarSrc }}" alt="avatar" loading="lazy" onerror="this.onerror=null;this.src='{{ $avatarFallback }}'">
			<div>
				<strong>{{ $user?->name }}</strong>
				<small>{{ $user?->email }}</small>
			</div>
		</a>

		<div class="member-aura-panel-section">
			<span>Menu Guestbook</span>
			<div class="member-aura-panel-links">
				@foreach($guestbookLinks as $link)
				<a href="{{ route($link['route']) }}" @class(['active' => in_array(Route::currentRouteName(), $link['active'], true)]) data-member-aura-close>
					<i class="{{ $link['icon'] }}"></i>
					<span>{{ $link['label'] }}</span>
				</a>
				@endforeach
			</div>
		</div>

		<form method="POST" action="{{ route('logout') }}" class="member-aura-logout">
			@csrf
			<button type="submit">
				<i class="bx bx-log-out"></i>
				<span>Keluar</span>
			</button>
		</form>
	</div>
</div>

@if ($user?->acc && $user->acc->actived=='0')
<div class="container">
	<div class="alert alert-danger alert-dismissible mt-3" role="alert">
		<h5 class="d-flex align-items-center mb-1"><i class="bx bx-error me-2"></i> <small class="fw-normal">Hai, <b>{{ $user->name }}</b></small></h5>
		<p class="mb-2">Akun kamu di non-aktifkan oleh Admin karena alasan tertentu. Hubungi Admin untuk meng-aktifkan akun kamu kembali.</p>
		<a href="" class="btn btn-sm btn-dark"><i class="bx bx-support"></i> Support Admin</a>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
</div>
@endif
