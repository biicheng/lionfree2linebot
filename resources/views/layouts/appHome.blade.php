<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('/img/lineBotIcon.ico')}}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LineBot管理系統</title>
    <script src="/js/app.js" defer></script>
    {{-- <script src="/js/1.8.2_jquery_min.js" defer></script> --}}
    <script src="/js/3.6.0.jquery.js" defer></script>
    <script src="/js/myjs.js" defer></script>
    <script src="/js/publicJs.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    @yield('content_css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar fixed-top navbar-light bg-light shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="dol" style="margin-left:1vh;font-size:4vh;">胡說八道的世界</div>
                </div>
            </div>
        </nav>
        <main class="py-4" style="margin-top:5vh;">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
@yield('content_js')
</html>
