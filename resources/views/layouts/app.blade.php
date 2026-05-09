<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ $global['setting'][0]->content }}</title>
    <meta name="keywords" content="{{ $global['setting'][5]->content }}">
    <link rel="shortcut icon" href="{{ url('storage/'.$global['setting'][1]->content) }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    @stack('meta')
    <script src="{{ asset('modules/jquery/jquery.min.js') }}"></script>
    @if(app()->environment('local') && file_exists(public_path('hot')))
        @vite(['resources/sass/landing-style-s.scss', 'resources/js/landing-script.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/landing-style-s-D1xW_aIH.css') }}">
        <script src="{{ asset('build/assets/vendor-bootstrap-f4TNcP9e.js') }}" type="module"></script>
        <script src="{{ asset('build/assets/vendor-swal-YZDMVk0e.js') }}" type="module"></script>
        <script src="{{ asset('build/assets/landing-script-CsUQPqtT.js') }}" type="module"></script>
    @endif
    @stack('style')
    <style>
        @font-face {
            font-family: "Grotesque";
            src: url('{{ asset('font/body-grotesque/Body Grotesque by Zetafonts/3.Body-Grotesque-Fit-Bold-trial.ttf') }}') format('texttype');
        }
    </style>
</head>
<body>
    @include('layouts.nav')
    @yield('content')
    @stack('script')
</body>
</html>
