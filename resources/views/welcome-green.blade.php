<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name', 'Aura Invitations') }} - Undangan Digital Elegant</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,600;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">

	@php
		$__appName = config('app.name', 'Aura Invitations');
		$__portalCss = 'css/portal-aura.css';
		$__portalJs  = 'js/portal-aura.js';
		$__portalCssV = @filemtime(public_path($__portalCss)) ?: time();
		$__portalJsV  = @filemtime(public_path($__portalJs)) ?: time();

		$__templates = $data['templates'] ?? collect();
		$__packages  = $data['packages'] ?? collect();

		$__heroTpl = $__templates->first();
		$__heroImg = '';
		if ($__heroTpl && !empty($__heroTpl->file ?? '')) {
			$__heroImg = \Illuminate\Support\Str::startsWith($__heroTpl->file, 'template/')
				? asset($__heroTpl->file)
				: url('storage/'.$__heroTpl->file);
		}

		$__featuredPkg = $__packages->firstWhere('slug', 'premium')
			?? $__packages->sortByDesc('grade')->values()->get(1)
			?? $__packages->get(0);
		$__loginUrl = route('login');
		$__registerUrl = route('register');
	@endphp

	<link rel="stylesheet" href="{{ asset($__portalCss).'?v='.$__portalCssV }}">
</head>
<body>

<header class="aura-nav" id="auraNav">
	<div class="container">
		<div class="aura-nav-inner">
			<a href="{{ url('/') }}" class="aura-brand" aria-label="Home">
				<span class="aura-brand-mark"><i class="bx bx-sparkles"></i></span>
				<span>{{ $__appName }}</span>
			</a>

			<nav class="aura-links" aria-label="Menu">
				<a href="#features">Features</a>
				<a href="#templates">Templates</a>
				<a href="#pricing">Pricing</a>
				<a href="#showcase">Showcase</a>
				@auth
					<a href="{{ url('/dashboard') }}" class="aura-btn primary">Dashboard</a>
				@else
					<a href="{{ $__loginUrl }}">Login</a>
					<a href="{{ $__registerUrl }}" class="aura-btn primary">Get Started</a>
				@endauth
			</nav>

			<button class="aura-hamburger" id="auraMobileOpen" aria-label="Buka menu">
				<i class="bx bx-menu"></i>
			</button>
		</div>
	</div>
</header>

<div class="aura-mobile" id="auraMobile" aria-hidden="true">
	<div class="aura-mobile-panel" role="dialog" aria-modal="true" aria-label="Menu">
		<div class="aura-mobile-head">
			<div class="aura-brand">
				<span class="aura-brand-mark"><i class="bx bx-sparkles"></i></span>
				<span>{{ $__appName }}</span>
			</div>
			<button class="aura-hamburger" id="auraMobileClose" aria-label="Tutup menu">
				<i class="bx bx-x"></i>
			</button>
		</div>
		<div class="aura-mobile-links">
			<a href="#features" data-aura-close>Features</a>
			<a href="#templates" data-aura-close>Templates</a>
			<a href="#pricing" data-aura-close>Pricing</a>
			<a href="#showcase" data-aura-close>Showcase</a>
		</div>
		<div class="aura-mobile-actions">
			@auth
				<a href="{{ url('/dashboard') }}" class="aura-btn primary" data-aura-close>Dashboard</a>
			@else
				<a href="{{ $__loginUrl }}" class="aura-btn" data-aura-close>Login</a>
				<a href="{{ $__registerUrl }}" class="aura-btn primary" data-aura-close>Get Started</a>
			@endauth
		</div>
	</div>
</div>

<main>
	<section class="aura-hero">
		<div class="container">
			<div class="aura-hero-grid">
				<div class="aura-reveal">
					<div class="aura-badge">REDEFINING ELEGANCE</div>
					<h1 class="aura-h1">
						Beautifully crafted <em>digital moments</em> for your special day.
					</h1>
					<p class="aura-lead">
						Effortless planning meets high-end design. Create, send, and track luxury invitations that leave a lasting impression.
					</p>
					<div class="aura-hero-actions">
						<a class="aura-btn primary" href="{{ auth()->check() ? url('/dashboard') : $__registerUrl }}">
							<i class="bx bx-plus-circle"></i> Buat Undangan Sekarang
						</a>
						<a class="aura-btn" href="#templates">
							<i class="bx bx-slideshow"></i> Lihat Demo
						</a>
					</div>
				</div>

				<div class="aura-showcase aura-reveal" style="--delay:.08s">
					<div class="aura-frame">
						<div class="aura-frame-inner">
							<div class="aura-phone">
								<div class="aura-phone-screen">
									@if($__heroImg)
										<img src="{{ $__heroImg }}" alt="Preview template" loading="lazy">
									@else
										<div class="aura-phone-placeholder">
											<div class="aura-phone-ph-title">Your Preview</div>
											<div class="aura-phone-ph-sub">Template elegan, mobile-first</div>
										</div>
									@endif
									<div class="aura-float">
										<i class="bx bx-check-circle"></i>
										<div>
											<b>RSVP</b>
											<small>Confirmed</small>
										</div>
									</div>
								</div>
							</div>
							<div class="aura-stat" aria-hidden="true">
								<i class="bx bx-user-voice"></i>
								<div>
									<b>5.000+</b>
									<small>Pasangan mempercayai kami</small>
								</div>
							</div>
							<div style="display:flex;gap:.6rem;flex-wrap:wrap;justify-content:center">
								<span class="aura-badge"><i class="bx bx-bolt-circle"></i> Fast Setup</span>
								<span class="aura-badge"><i class="bx bx-mobile"></i> Mobile-first</span>
								<span class="aura-badge"><i class="bx bx-lock"></i> Secure</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="features" class="aura-section">
		<div class="container aura-center">
			<h2 class="aura-h2 aura-reveal">Everything you need, <span class="alt">simplified.</span></h2>
			<p class="aura-sub aura-reveal" style="--delay:.05s">Fitur lengkap untuk membuat, membagikan, dan memantau undangan digital dengan elegan.</p>
			<div class="aura-divider aura-reveal" style="--delay:.08s"></div>

			<div class="aura-grid">
				<div class="aura-card aura-reveal" style="grid-column:span 7;--delay:.10s">
					<div class="aura-card-icon"><i class="bx bx-check-shield"></i></div>
					<h3>Real-time RSVP Tracker</h3>
					<p>Pantau konfirmasi hadir, jumlah tamu, dan respons secara instan untuk kebutuhan acara.</p>
					<div class="mini-table" aria-hidden="true">
						<div class="mini-row"><span>Sarah &amp; James</span><span class="chip ok">Attending</span></div>
						<div class="mini-row"><span>Michael Chen</span><span class="chip">Pending</span></div>
						<div class="mini-row"><span>Elena Rodriguez</span><span class="chip ok">Attending</span></div>
					</div>
				</div>
				<div class="aura-card aura-reveal" style="grid-column:span 5;--delay:.16s">
					<div class="aura-card-icon"><i class="bx bx-music"></i></div>
					<h3>Ambient Music</h3>
					<p>Tambah musik latar yang halus agar undangan terasa lebih hidup dan emosional.</p>
					<div class="mini-player" aria-hidden="true">
						<div class="mini-player-top">
							<span class="dot"></span><span class="dot"></span><span class="dot"></span>
							<span class="mini-track">Wedding Overture</span>
						</div>
						<div class="mini-bar"><span style="width:62%"></span></div>
						<div class="mini-player-meta"><small>1:12</small><small>2:04</small></div>
					</div>
				</div>
				<div class="aura-card aura-reveal" style="grid-column:span 4;--delay:.22s">
					<div class="aura-card-icon"><i class="bx bx-map"></i></div>
					<h3>Integrated Maps</h3>
					<p>Lokasi acara dengan tautan peta agar tamu mudah menuju tempat.</p>
				</div>
				<div class="aura-card aura-reveal" style="grid-column:span 4;--delay:.28s">
					<div class="aura-card-icon"><i class="bx bx-gift"></i></div>
					<h3>Digital Gift Registry</h3>
					<p>Amplop digital lengkap dengan tombol salin untuk kemudahan tamu.</p>
				</div>
				<div class="aura-card aura-reveal" style="grid-column:span 4;--delay:.34s">
					<div class="aura-card-icon"><i class="bx bx-images"></i></div>
					<h3>Gallery & Story</h3>
					<p>Tampilkan momen terbaik dan kisah cinta Anda dalam satu halaman.</p>
				</div>
				<div class="aura-card aura-reveal aura-rsvp-live" style="grid-column:span 12;--delay:.40s">
					<div class="aura-live-head">
						<div>
							<div class="aura-live-title">Real-time RSVP</div>
							<div class="aura-live-sub">Track every confirmation as it happens with instant notifications.</div>
						</div>
						<div class="aura-live-stat">
							<span class="aura-live-pill"><i class="bx bx-bell"></i> Live</span>
							<b>78%</b>
						</div>
					</div>
					<div class="aura-live-bar"><span data-aura-progress="78"></span></div>
				</div>
			</div>
		</div>
	</section>

	<section id="templates" class="aura-section">
		<div class="container">
			<div class="aura-center aura-reveal">
				<h2 class="aura-h2">Curated Themes</h2>
				<p class="aura-sub">Pilih dari koleksi template elegan yang siap dipakai untuk berbagai gaya acara.</p>
				<div class="aura-divider"></div>
			</div>

			<div class="aura-grid">
				@foreach($__templates as $idx => $item)
					@php
						$thumb = '';
						if ($item->file && \Illuminate\Support\Str::startsWith($item->file, 'template/')) $thumb = asset($item->file);
						elseif ($item->file) $thumb = url('storage/'.$item->file);
					@endphp
					<div class="aura-card tpl-card aura-reveal" style="grid-column:span 4;--delay:{{ 0.06 + ($idx*0.03) }}s">
						<div class="tpl-thumb">
							@if($thumb)
								<img src="{{ $thumb }}" alt="{{ $item->title }}" loading="lazy">
							@endif
							<span class="tpl-badge">{{ strtoupper($item->grade ?? 'BASIC') }}</span>
						</div>
						<div class="tpl-body">
							<div class="tpl-title">{{ $item->title }}</div>
							<div class="tpl-meta">
								<span><i class="bx bx-palette"></i> {{ ucfirst($item->grade ?? 'basic') }}</span>
								<span><i class="bx bx-mobile"></i> Responsive</span>
							</div>
							<div class="tpl-actions">
								<a href="{{ route('preview-template.index', $item->slug) }}" class="aura-btn secondary">
									<i class="bx bx-show"></i> Preview
								</a>
								<a href="{{ $__registerUrl }}" class="aura-btn primary">
									<i class="bx bx-plus-circle"></i> Use
								</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<section id="pricing" class="aura-section">
		<div class="container">
			<div class="aura-center aura-reveal">
				<h2 class="aura-h2">Simple, Transparent Pricing</h2>
				<p class="aura-sub">Pilih paket yang sesuai kebutuhan Anda dan upgrade kapan saja.</p>
				<div class="aura-divider"></div>
			</div>

			<div class="pricing-wrap aura-reveal" style="--delay:.06s">
				<div class="price-grid">
					@foreach($__packages as $i => $pkg)
						@php
							$isFeatured = $__featuredPkg && ($pkg->id === $__featuredPkg->id);
							$tplList = (array)($pkg->features['template'] ?? ['basic']);
							$guestLabel = ($pkg->features['guest'] === 'unlimited' || $pkg->features['guest'] == 0) ? 'Tamu Unlimited' : ($pkg->features['guest'].' Tamu');
							$photoLabel = ($pkg->features['gallery_photo'] === 'unlimited' || $pkg->features['gallery_photo'] == 0) ? 'Galeri Unlimited' : ($pkg->features['gallery_photo'].' Foto Galeri');
							$activeLabel = ($pkg->features['active'] == 0) ? 'Aktif Selamanya' : ($pkg->features['active'].' Hari Aktif');
						@endphp
						<div class="price-card aura-reveal {{ $isFeatured ? 'featured' : '' }}" style="--delay:{{ 0.06 + ($i*0.05) }}s">
							<div class="price-top">
								<h3 class="price-name">{{ $pkg->title }}</h3>
								@if($isFeatured)
									<span class="price-pill">MOST POPULAR</span>
								@endif
							</div>
							<div class="price">
								{{ $pkg->price_formatted }}
								@if(($pkg->price ?? 0) > 0)<small>/paket</small>@endif
							</div>
							<ul class="price-features">
								<li><i class="bx bx-layer"></i> Template: {{ implode(', ', array_map('ucfirst', $tplList)) }}</li>
								<li><i class="bx bx-user"></i> {{ $guestLabel }}</li>
								<li><i class="bx bx-images"></i> {{ $photoLabel }}</li>
								<li><i class="bx bx-time-five"></i> {{ $activeLabel }}</li>
								<li><i class="bx {{ ($pkg->features['gift'] ?? false) ? 'bx-check-circle' : 'bx-x-circle' }}"></i> Amplop Digital</li>
								<li><i class="bx {{ ($pkg->features['smart_wa'] ?? false) ? 'bx-check-circle' : 'bx-x-circle' }}"></i> Smart WhatsApp</li>
							</ul>
							<div class="price-cta">
								<a class="aura-btn {{ $isFeatured ? 'primary' : '' }}" href="{{ $__registerUrl }}">
									{{ ($pkg->price ?? 0) == 0 ? 'Coba Gratis' : 'Pilih Paket' }}
								</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>

	<section id="showcase" class="aura-section">
		<div class="container aura-center">
			<h2 class="aura-h2 aura-reveal">Loved by Couples</h2>
			<p class="aura-sub aura-reveal" style="--delay:.05s">Testimoni singkat dari pasangan yang menggunakan undangan digital.</p>
			<div class="aura-divider aura-reveal" style="--delay:.08s"></div>

			<div class="test-grid">
				<div class="aura-card test-card aura-reveal" style="--delay:.10s">
					<div class="test-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
					<p class="test-quote">"Undangannya elegan banget. RSVP & ucapan langsung rapi, kami jadi lebih tenang."</p>
					<div class="test-user">
						<div class="test-avatar">A</div>
						<div><b>Anindya &amp; Reyhan</b><small>Jakarta</small></div>
					</div>
				</div>
				<div class="aura-card test-card aura-reveal" style="--delay:.16s">
					<div class="test-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
					<p class="test-quote">"Template-nya premium dan mudah disesuaikan. Tamu juga bilang tampilannya mewah."</p>
					<div class="test-user">
						<div class="test-avatar">S</div>
						<div><b>Sarah &amp; Ahmad</b><small>Bandung</small></div>
					</div>
				</div>
				<div class="aura-card test-card aura-reveal" style="--delay:.22s">
					<div class="test-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
					<p class="test-quote">"Fitur peta & amplop digitalnya membantu banget. Prosesnya cepat dan support responsif."</p>
					<div class="test-user">
						<div class="test-avatar">M</div>
						<div><b>Maya &amp; Budi</b><small>Surabaya</small></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="aura-section">
		<div class="container">
			<div class="cta-dark aura-reveal">
				<h2>Start Your Digital Journey Today</h2>
				<p>Mulai buat undangan digital yang elegan, mudah dibagikan, dan siap dipantau dengan fitur lengkap.</p>
				<a href="{{ $__registerUrl }}" class="aura-btn primary">
					<i class="bx bx-right-arrow-alt"></i> Buat Undangan Sekarang
				</a>
			</div>

			<footer class="aura-footer">
				<div class="aura-footer-grid">
					<div>
						<div class="aura-brand" style="margin-bottom:.5rem">
							<span class="aura-brand-mark"><i class="bx bx-sparkles"></i></span>
							<span>{{ $__appName }}</span>
						</div>
						<div style="max-width:56ch;color:rgba(23,23,23,.62);line-height:1.75">
							Crafted digital invitations that feel as special as your big day.
						</div>
						<div class="aura-copy">&copy; {{ date('Y') }} Risa Digital Invitation.</div>
					</div>
					<div>
						<h4>Company</h4>
						<a href="#features">About</a>
						<a href="#templates">Templates</a>
						<a href="#pricing">Pricing</a>
					</div>
					<div>
						<h4>Support</h4>
						@auth
							<a href="{{ url('/dashboard') }}">Dashboard</a>
						@else
							<a href="{{ $__loginUrl }}">Login</a>
						@endauth
						<a href="{{ $__registerUrl }}">Get Started</a>
						<a href="#showcase">Testimonials</a>
					</div>
				</div>
			</footer>
		</div>
	</section>
</main>

<script src="{{ asset($__portalJs).'?v='.$__portalJsV }}" defer></script>
</body>
</html>
