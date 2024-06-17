@section('title','イベント管理システム | ユーザー登録フォーム')
@extends('layouts/guest')
@section('content')

<form class="form-signin" method="POST" action="{{ route('signupConfirm') }}">
    @csrf
  <h1 class="h3 mb-3 font-weight-normal">ユーザ登録フォーム</h1>

  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
        
  <x-alert type="danger" :session="session('danger')" />
  <label for="inputEmail">名前（姓・名）</label>
  <input type="text" id="inputName" name="name" class="form-control" value="{{ old('name') }}" placeholder="Last Name  First Name" required autofocus>
  <label for="inputEmail">メールアドレス</label>
  <input type="email" id="inputEmail" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required autofocus>
  <label for="inputPassword" ><br>パスワード<br>※パスワードは半角の英字と数字を含めた8〜16桁を設定して下さい。</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <label for="inputPassword" >パスワード（確認用）</label>
  <input type="password" id="inputPassword_confirm" name="password_confirm" class="form-control" placeholder="Password" required>
  <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">確認画面へ</button>
</form>

@endsection