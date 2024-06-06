<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ編集フォーム</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>

<form class="form-signin" method="POST" action="{{ route('editConfirm') }}">
    @csrf
  <h1 class="h3 mb-3 font-weight-normal">ユーザ編集フォーム</h1>

  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
  
  <x-alert type="danger" :session="session('danger')" />
  <input type="hidden" name="id" value="{{ $inputs->id }}">
  <label for="inputEmail">名前（姓・名）</label>
  <input type="text" id="inputName" name="name" class="form-control" placeholder="Last Name  First Name" value="{{ old('name') ?? $inputs->name }}" required autofocus>
  <label for="inputEmail">メールアドレス</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="{{ old('email') ?? $inputs->email }}" required autofocus>
  <label for="inputPassword">パスワード</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <label for="inputPassword">パスワード（確認用）</label>
  <input type="password" id="inputPassword_confirm" name="password_confirm" class="form-control" placeholder="Password" required>
  <a class="btn btn-lg btn-primary btn-block" href="/">ホームに戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">確認画面へ</button>
</form>

</body>
</html>