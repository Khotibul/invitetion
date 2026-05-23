@extends('panel.layouts.app')
@section('title', Str::title($data['title']))
@section('content')
@php
	$quickActions = [
		['icon' => 'bx bx-layer',           'title' => 'Kelola Template', 'desc' => 'Tambah/ubah template, harga, komponen.', 'url' => route('template.index')],
		['icon' => 'bx bx-credit-card',     'title' => 'Transaksi',       'desc' => 'Pantau pembayaran & konfirmasi.',       'url' => route('invoice-transaction.index')],
		['icon' => 'bx bx-user-circle',     'title' => 'Akun Undangan',   'desc' => 'Kelola akun/member undangan.',         'url' => route('member.index')],
		['icon' => 'bx bx-cog',             'title' => 'Pengaturan',      'desc' => 'Site meta, maintenance, dan lainnya.',  'url' => route('setting.site', 'site')],
	];
@endphp

<div class="container-xxl py-3 py-md-4 admin-dashboard">
	{{-- HERO --}}
	<section class="admin-hero admin-reveal">
		<div class="row align-items-center g-4">
			<div class="col-12 col-lg-6">
				<div class="admin-hero-badge mb-3">REDEFINING ADMIN EXPERIENCE</div>
				<div class="admin-hero-title mb-2">{!! $greating !!}</div>
				<p class="admin-hero-subtitle mb-4">
					Kelola undangan, template, paket, pengguna, dan transaksi dengan tampilan yang modern, responsif, dan cepat.
				</p>
				<div class="d-flex flex-wrap gap-2">
					<a href="{{ route('template.index') }}" class="btn btn-primary admin-btn-pill">
						<i class="bx bx-layer me-1"></i> Kelola Template
					</a>
					<a href="{{ route('invoice-transaction.index') }}" class="btn btn-outline-secondary admin-btn-pill">
						<i class="bx bx-receipt me-1"></i> Lihat Transaksi
					</a>
					<a href="{{ route('template.pricing') }}" class="btn btn-outline-primary admin-btn-pill">
						<i class="bx bx-purchase-tag-alt me-1"></i> Harga Template
					</a>
				</div>
				<div class="admin-hero-shortcuts mt-4">
					<span class="text-muted small">Shortcut:</span>
					<span class="admin-kbd">Ctrl</span><span class="admin-kbd">K</span>
					<span class="text-muted small">untuk cari menu</span>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="admin-hero-preview admin-reveal" style="--delay: 0.08s">
					<div class="admin-preview-card">
						<div class="d-flex align-items-center justify-content-between mb-2">
							<div class="admin-preview-title">Realtime Overview</div>
							<div class="admin-preview-chip"><i class="bx bx-bolt-circle me-1"></i>Live</div>
						</div>
						<div class="row g-2">
							@foreach($transaction as $item)
							<div class="col-6">
								<a href="{{ $item['url'] }}" class="admin-kpi-card">
									<div class="admin-kpi-icon"><i class="{{ $item['icon'] }}"></i></div>
									<div class="admin-kpi-label">{{ Str::title($item['title']) }}</div>
									<div class="admin-kpi-value admin-count" data-count="{{ (int)($item['data'] ?? 0) }}">0</div>
								</a>
							</div>
							@endforeach
						</div>
						<div class="admin-preview-divider"></div>
						<div class="admin-preview-mini row g-2">
							@foreach($dashboard as $item)
							<div class="col-6 col-md-3">
								<a href="{{ $item['url'] }}" class="admin-mini-stat">
									<i class="{{ $item['icon'] }}"></i>
									<span class="admin-count" data-count="{{ (int)($item['data'] ?? 0) }}">0</span>
									<small>{{ Str::upper($item['title']) }}</small>
								</a>
							</div>
							@endforeach
						</div>
					</div>
					<div class="admin-preview-glow"></div>
				</div>
			</div>
		</div>
	</section>

	{{-- EXPERIENCE / QUICK ACTIONS --}}
	<section class="mt-4 mt-md-5">
		<div class="admin-section-head admin-reveal">
			<h2 class="admin-section-title">Experience Excellence</h2>
			<p class="admin-section-subtitle">Semua yang dibutuhkan admin untuk mengelola sistem dengan efisien.</p>
		</div>
		<div class="row g-3 g-md-4 mt-1">
			@foreach($quickActions as $i => $qa)
			<div class="col-12 col-md-6 col-xl-3 admin-reveal" style="--delay: {{ 0.05 + ($i*0.06) }}s">
				<a href="{{ $qa['url'] }}" class="admin-feature-card">
					<div class="admin-feature-icon"><i class="{{ $qa['icon'] }}"></i></div>
					<div class="admin-feature-title">{{ $qa['title'] }}</div>
					<div class="admin-feature-desc">{{ $qa['desc'] }}</div>
					<div class="admin-feature-cta">Open <span class="ms-1">→</span></div>
				</a>
			</div>
			@endforeach
		</div>
	</section>

	{{-- CURATED THEMES (RECENT TEMPLATES) --}}
	<section class="mt-4 mt-md-5">
		<div class="d-flex align-items-end justify-content-between gap-2 flex-wrap admin-reveal">
			<div>
				<h2 class="admin-section-title mb-1">Curated Themes</h2>
				<p class="admin-section-subtitle mb-0">Template terbaru yang baru ditambahkan/diubah.</p>
			</div>
			<a href="{{ route('template.index') }}" class="btn btn-sm btn-outline-secondary admin-btn-pill">
				Explore All <span class="ms-1">→</span>
			</a>
		</div>

		<div class="row g-3 g-md-4 mt-1">
			@forelse($recentTemplates ?? [] as $idx => $tpl)
			@php
				$thumb = '';
				if (!empty($tpl->file ?? '')) {
					$thumb = \Illuminate\Support\Str::startsWith($tpl->file, 'template/')
						? asset($tpl->file)
						: url('storage/'.$tpl->file);
				}
				$badge = $tpl->grade ?? 'basic';
			@endphp
			<div class="col-12 col-md-6 col-xl-4 admin-reveal" style="--delay: {{ 0.06 + ($idx*0.05) }}s">
				<div class="admin-theme-card">
					<div class="admin-theme-thumb">
						@if($thumb)
							<img src="{{ $thumb }}" alt="{{ $tpl->title }}" loading="lazy">
						@else
							<div class="admin-theme-thumb-placeholder">
								<i class="bx bx-image-alt"></i>
							</div>
						@endif
						<span class="admin-theme-badge">{{ Str::upper($badge) }}</span>
					</div>
					<div class="admin-theme-body">
						<div class="admin-theme-title">{{ $tpl->title }}</div>
						<div class="admin-theme-meta">
							<span><i class="bx bx-time-five"></i> {{ date_info($tpl->created_at) }}</span>
							<span class="ms-auto"><i class="bx bx-tag"></i> {!! idr((string)($tpl->price ?? 0)) !!}</span>
						</div>
						<div class="d-flex gap-2 mt-3">
							<a href="{{ route('template.edit', $tpl->id) }}" class="btn btn-sm btn-primary admin-btn-pill flex-grow-1">
								Edit
							</a>
							<a href="{{ route('preview-template.index', $tpl->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary admin-btn-pill flex-grow-1">
								Preview
							</a>
						</div>
					</div>
				</div>
			</div>
			@empty
			<div class="col-12">
				<div class="alert alert-info admin-reveal">
					Belum ada data template terbaru.
				</div>
			</div>
			@endforelse
		</div>
	</section>

	{{-- ACTIVITY --}}
	<section class="mt-4 mt-md-5 mb-2">
		<div class="admin-section-head admin-reveal">
			<h2 class="admin-section-title">Recent Activity</h2>
			<p class="admin-section-subtitle">Ringkasan aktivitas terbaru sistem.</p>
		</div>
		<div class="admin-activity card border-0 admin-reveal">
			<div class="card-body">
				<div class="d-flex align-items-center justify-content-between mb-2">
					<div class="fw-semibold">Aktivitas Terakhir</div>
					<a href="{{ route('setting.log_activity') }}" class="btn btn-sm btn-outline-secondary admin-btn-pill">Lihat Log</a>
				</div>
				<div class="admin-activity-list">
					@forelse($recentActivities ?? [] as $act)
						<div class="admin-activity-item">
							<div class="admin-activity-dot"></div>
							<div class="admin-activity-content">
								<div class="admin-activity-title">
									{{ $act->description ?? ($act->event ?? 'activity') }}
								</div>
								<div class="admin-activity-meta">
									<span>{{ class_basename((string)($act->subject_type ?? '')) }}</span>
									<span>•</span>
									<span>{{ date_info($act->created_at) }}</span>
								</div>
							</div>
						</div>
					@empty
						<div class="text-muted">Belum ada aktivitas.</div>
					@endforelse
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@push('style')
@endpush

@push('script')
@endpush
