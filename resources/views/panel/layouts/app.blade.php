<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>@yield('title')</title>
	<link rel="shortcut icon" href="{{ url('sneat/img/favicon.png') }}" type="image/x-icon">
    {{-- CSS — pakai asset() langsung agar kompatibel semua hosting --}}
	@php
		/**
		 * NOTE:
		 * Jika `public/hot` tertinggal, `@vite()` akan mencoba load Vite dev-server
		 * yang belum tentu running -> panel jadi "polosan" (CSS/JS tidak ter-load).
		 * Untuk panel admin, pakai `public/build/manifest.json` jika tersedia.
		 */
		$__manifestPath = public_path('build/manifest.json');
		$__manifest = (file_exists($__manifestPath))
			? json_decode((string) file_get_contents($__manifestPath), true)
			: null;
		$__sneatCss = $__manifest['resources/css/sneat.css']['file'] ?? null;
		$__sneatJs  = $__manifest['resources/js/sneat.js']['file']  ?? null;
		if (!$__sneatCss) {
			$__sneatCssFile = collect(glob(public_path('build/assets/sneat-*.css')) ?: [])->sortDesc()->first();
			$__sneatCss = $__sneatCssFile ? 'assets/'.basename($__sneatCssFile) : null;
		}
		if (!$__sneatJs) {
			$__sneatJsFile = collect(glob(public_path('build/assets/sneat-*.js')) ?: [])->sortDesc()->first();
			$__sneatJs = $__sneatJsFile ? 'assets/'.basename($__sneatJsFile) : null;
		}
	@endphp
	@if($__sneatCss)
		<link rel="stylesheet" href="{{ asset('build/'.$__sneatCss) }}">
	@endif
	@php
		$__adminUiCss = 'css/admin-ui.css';
		$__adminUiJs  = 'js/admin-ui.js';
		$__adminUiCssV = @filemtime(public_path($__adminUiCss)) ?: time();
		$__adminUiJsV  = @filemtime(public_path($__adminUiJs)) ?: time();
	@endphp
	<link rel="stylesheet" href="{{ asset($__adminUiCss).'?v='.$__adminUiCssV }}">
	@stack('style')
</head>
<body>
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			@include('panel.layouts.app-menu')
			<div class="layout-page">
				@include('panel.layouts.app-nav')
				@yield('content')
			</div>
		</div>
		<div class="layout-overlay layout-menu-toggle"></div>
	</div>
	{{-- Scripts --}}
	<script src="{{ asset('modules/jquery/jquery.min.js') }}"></script>
	@if($__sneatJs)
		<script src="{{ asset('build/'.$__sneatJs) }}" type="module"></script>
	@endif
	<script src="{{ asset($__adminUiJs).'?v='.$__adminUiJsV }}" defer></script>
	@stack('script')
</body>
</html>
