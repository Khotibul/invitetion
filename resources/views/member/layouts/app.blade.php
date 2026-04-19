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
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Great+Vibes&family=Kaushan+Script&family=Nova+Cut&family=Raleway&family=Righteous&display=swap" rel="stylesheet">
    {{-- jQuery harus dimuat SEBELUM Vite bundle agar $ tersedia --}}
    <script src="{{ asset('modules/jquery/jquery.min.js') }}"></script>
	@vite(['resources/css/member-style.css', 'resources/sass/member-style-s.scss', 'resources/js/member-script.js'])
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
    @stack('script')
    <script>
        $(".logout-form").on('click', function(e) {
            e.preventDefault();
            $("#logout-form").submit();
        });
    </script>
</body>
</html>