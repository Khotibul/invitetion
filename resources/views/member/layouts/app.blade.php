<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title'){{ (Auth::user()->inv) ? " - Wedding of ".implode(' & ', json_decode(Auth::user()->inv->title, true) ?? ['-', '-']) : "" }} | Risa Digital Invitation</title>
    <meta name="theme-color" content="{{ isset($global['setting'][3]) ? $global['setting'][3]->content : '#ffffff' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Great+Vibes&family=Kaushan+Script&family=Nova+Cut&family=Raleway&family=Righteous&display=swap" rel="stylesheet">
    {{-- CSS only — no JS in head --}}
    @vite(['resources/css/member-style.css', 'resources/sass/member-style-s.scss'])
    @stack('style')
</head>
<body>
    @include('member.layouts.nav')
    <div class="container">
        @yield('content')
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		@csrf
	</form>
    {{-- jQuery + member-script dimuat di akhir body agar DOM sudah siap --}}
    <script src="{{ asset('modules/jquery/jquery.min.js') }}"></script>
    @vite(['resources/js/member-script.js'])
    @stack('script')
</body>
</html>