<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセット</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>

<form class="form-signin" method="POST" action="{{ route('reset') }}">
  @csrf
  <h1 class="h3 mb-3 font-weight-normal">パスワードリセット</h1>

  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{ $error }}</li>
    </ul>
  @endforeach

  <x-alert type="danger" :session="session('danger')" />
  
  <label for="inputEmail">メールアドレス（ログインID）</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">送信</button>
</form>

</body>
</html>