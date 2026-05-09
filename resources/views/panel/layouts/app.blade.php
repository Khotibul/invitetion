<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>@yield('title')</title>
	<link rel="shortcut icon" href="{{ url('sneat/img/favicon.png') }}" type="image/x-icon">
    {{-- CSS — pakai asset() langsung agar kompatibel semua hosting --}}
    @if(app()->environment('local') && file_exists(public_path('hot')))
        @vite(['resources/css/sneat.css', 'resources/js/sneat.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/sneat-D9iDqN5M.css') }}">
    @endif
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
    @if(app()->environment('local') && file_exists(public_path('hot')))
        @vite(['resources/js/sneat.js'])
    @else
        <script src="{{ asset('build/assets/vendor-bootstrap-f4TNcP9e.js') }}" type="module"></script>
        <script src="{{ asset('build/assets/vendor-swal-YZDMVk0e.js') }}" type="module"></script>
        <script src="{{ asset('build/assets/sneat-iDp9ln3u.js') }}" type="module"></script>
    @endif
	@stack('script')
</body>
</html>
