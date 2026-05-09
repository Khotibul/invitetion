<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>@yield('title')</title>
	<link rel="shortcut icon" href="{{ url('sneat/img/favicon.png') }}" type="image/x-icon">
    {{-- CSS --}}
    @if(app()->environment('local') && file_exists(public_path('hot')))
        @vite(['resources/css/sneat.css', 'resources/js/sneat.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/sneat-D9iDqN5M.css') }}">
    @endif
	@stack('style')
</head>
<body>
	<div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
			</div>
		</div>
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
	{{-- <script src="{{ asset('sneat/js/menu.js') }}"></script> --}}
	{{-- <script src="{{ asset('sneat/js/main.js') }}"></script> --}}
	{{-- <script src="{{ asset('sneat/js/mine.js') }}"></script> --}}
</body>
</html>