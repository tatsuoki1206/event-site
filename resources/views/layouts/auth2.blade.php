<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>
    <header>
      @include('layouts.header')
    </header>
    <br>
    @include('layouts.sidebar')
    <div class="container">
        @yield('content')
    </div>
    <footer class="footer bg-dark  fixed-bottom">
      @include('layouts.footer')
    </footer>
</body>
</html>