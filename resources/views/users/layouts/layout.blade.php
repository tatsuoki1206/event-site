<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/checkout.js') }}" defer></script>
    <!-- css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
</head>
<body>
    <header>
      @include('users.layouts.header')
    </header>
    <br>
    <div class="container">
      <main >
            @yield('content')
      </main>
    </div>
    </main>
    <footer class="footer bg-dark  fixed-bottom">
      @include('users.layouts.footer')
    </footer>
</body>
</html>