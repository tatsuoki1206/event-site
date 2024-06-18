@section('title','イベント管理システム | パスワード再設定')
@extends('admin/layouts/guest')
@section('content')

<form class="form-signin" method="POST" action="{{ route('resetPassword') }}">
    @csrf
  <h1 class="h3 mb-3 font-weight-normal">パスワード再設定</h1>

  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
        
  <x-alert type="danger" :session="session('danger')" />
  <label for="inputEmail">メールアドレス</label>
  <p>{{ $email }}</p>
  <input type="hidden" name="email" value="{{ $email }}">
  <input type="hidden" name="token" value="{{ $token }}">
  <label for="inputPassword" ><br>パスワード<br>※パスワードは半角の英字と数字を含めた8〜16桁を設定して下さい。</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <label for="inputPassword" >パスワード（確認用）</label>
  <input type="password" id="inputPassword_confirm" name="password_confirm" class="form-control" placeholder="Password" required>
  <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">登録</button>
</form>

@endsection