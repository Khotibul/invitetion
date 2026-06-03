<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title'){{ Auth::user()->inv ? " - Wedding of ".implode(' & ', json_decode(Auth::user()->inv->title, true) ?? ['-', '-']) : "" }} | Risa Digital Invitation</title>
    <meta name="theme-color" content="">
    <meta name="keywords" content="">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Great+Vibes&family=Kaushan+Script&family=Nova+Cut&family=Raleway&family=Righteous&display=swap" rel="stylesheet">
    @vite(['resources/css/member-style.css', 'resources/sass/member-style-s.scss'])
    @php
        $__memberAuraCss = 'css/member-aura-nav.css';
        $__memberAuraJs  = 'js/member-aura-nav.js';
        $__memberAuraCssV = @filemtime(public_path($__memberAuraCss)) ?: time();
        $__memberAuraJsV  = @filemtime(public_path($__memberAuraJs)) ?: time();
    @endphp
    <link rel="stylesheet" href="{{ asset($__memberAuraCss).'?v='.$__memberAuraCssV }}">
    @stack('style')
</head>
<body>
    @include('guestbook.layouts.nav')
    <div class="container">
        @yield('content')
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		@csrf
	</form>
	<script src="{{ asset('modules/jquery/jquery.min.js') }}"></script>
    @vite(['resources/js/member-script.js'])
    <script src="{{ asset($__memberAuraJs).'?v='.$__memberAuraJsV }}" defer></script>
    @stack('script')
    <script>
        $(".logout-form").on('click', function(e) {
            e.preventDefault();
            $("#logout-form").submit();
        });
    </script>
</body>
</html>
