<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録内容確認</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>

<form class="form-signin" method="POST" action="{{ route('signupRegister') }}">
    @csrf
  <h1 class="h3 mb-3 font-weight-normal">ユーザ登録内容確認</h1>
  
  <label for="name">名前（姓・名）：</label>
  <input type="hidden" name="name" value="{{ $inputs['name'] }}">
  <p>{{ $inputs['name'] }}</p>
  <label for="email">メールアドレス：</label>
  <input type="hidden" name="email" value="{{ $inputs['email'] }}">
  <p>{{ $inputs['email'] }}</p>
  <input type="hidden" name="password" value="{{ $inputs['password'] }}">
  <button class="btn btn-lg btn-primary btn-block" name="back" value="back" type="submit">修正する</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">登録する</button>
</form>

</body>
</html>