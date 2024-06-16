<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>退会ユーザの確認</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>

<form class="form-signin" method="POST" action="{{ route('deleteComplete') }}">
    @csrf
  <h1 class="h3 mb-3 font-weight-normal">退会ユーザーの確認</h1>
  <p>以下ユーザーの退会を希望する場合は退会ボタンを押してください。</p>

  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
        
  <x-alert type="danger" :session="session('danger')" />
  <input type="hidden" name="id" value="{{ Auth::user()->id }}">
  <label for="inputEmail" class="sr-only">名前（姓・名）</label>
  <input type="hidden" name="name" value="{{ Auth::user()->name }}">
  <p>{{ Auth::user()->name }}</p>
  <label for="inputEmail" class="sr-only">メールアドレス</label>
  <input type="hidden" name="email" value="{{ Auth::user()->email }}">
  <p>{{ Auth::user()->email }}</p>
  <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">退会</button>
</form>

</body>
</html>