<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="theme-color" content="">
    <meta name="keywords" content="">
    @stack('style')
    @vite(['resources/css/member-style.css', 'resources/sass/member-style-s.scss'])
</head>
<body class="auth d-flex flex-column min-vh-100 justify-content-center py-5 bg-light">
    <div class="position-fixed top-0 start-0 p-4">
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>
    <div class="container">
        @yield('content')
    </div>
	<script src="{{ asset('modules/jquery/jquery.min.js') }}"></script>
    @vite(['resources/js/member-script.js'])
    @stack('script')
</body>
</html>
