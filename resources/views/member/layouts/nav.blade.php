<nav class="cread-navbar navbar navbar-expand-lg fixed-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ route('member.main') }}">Risa Digital Invitation</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbar">
			<ul class="navbar-nav mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						@php
							$avatarFile = Auth::user()->acc?->file ?? null;
							$isUrl = !empty($avatarFile) && filter_var($avatarFile, FILTER_VALIDATE_URL);
							// Prefer thumbnail (xs) untuk file lokal, fallback ke file asli jika xs tidak ada.
							if ($isUrl) {
								$avatarSrc = $avatarFile;
							} elseif (!empty($avatarFile)) {
								$avatarSrc = \Illuminate\Support\Facades\Storage::disk('public')->exists('xs/'.$avatarFile)
									? url('storage/xs/'.$avatarFile)
									: url('storage/'.$avatarFile);
							} else {
								$avatarSrc = 'https://via.placeholder.com/40';
							}
						@endphp
						<img src="{{ $avatarSrc }}" class="me-2" alt="avatar" @style('height:40px;width:40px;object-fit:cover')>
						<span>{{ Auth::user()->name }}</span>
					</a>
					<ul class="dropdown-menu rounded animate slideIn" aria-labelledby="navbarDropdown">
						<li>
							<a class="dropdown-item" href="{{ route('member.main') }}">
								<i class="bx bxs-widget"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('profile') }}">
								<i class="bx bx-user-circle"></i>
								<span>Profil</span>
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('packages') }}">
								<i class="bx bx-cart-alt"></i>
								<span>Pesan Undangan</span>
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('transaction') }}">
								<i class="bx bx-receipt"></i>
								<span>Transaksi</span>
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li>
							<form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
								@csrf
								<button type="submit" class="dropdown-item">
									<i class="bx bx-log-out"></i>
									<span>Keluar</span>
								</button>
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="nav-holder"></div>
@if (Auth::user()->acc && Auth::user()->acc->actived=='0')
<div class="container">
	<div class="alert alert-danger alert-dismissible mt-3" role="alert">
		<h5 class="d-flex align-items-center mb-1"><i class="bx bx-error me-2"></i> <small class="fw-normal">Hai, <b>{{ Auth::user()->name }}</b></small></h5>
		<p class="mb-2">Akun kamu di non-aktifkan oleh Admin karena alasan tertentu. Hubungi Admin untuk meng-aktifkan akun kamu kembali.</p>
		<a href="" class="btn btn-sm btn-dark"><i class="bx bx-support"></i> Support Admin</a>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
</div>
@endif
