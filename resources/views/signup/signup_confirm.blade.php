@section('title','イベント管理システム | ユーザ登録内容確認')
@extends('layouts/guest')
@section('content')

<form class="form-signin" method="POST" action="{{ route('signupRegister') }}">
    @csrf
  <h1 class="h3 mb-3 font-weight-normal">ユーザ登録内容確認</h1>
  
  <label for="name">名前（姓・名）：</label>
  <input type="hidden" name="name" value="{{ $inputs['name'] }}">
  <p>{{ $inputs['name'] }}</p>
  <label for="email">メールアドレス：</label>
  <input type="hidden" name="email" value="{{ $inputs['email'] }}">
  <p>{{ $inputs['email'] }}</p>
  <label for="email">パスワード：</label>
  <input type="hidden" name="password" value="{{ $inputs['password'] }}">
  <p>{{ $inputs['str_password'] }}</p>
  <button class="btn btn-lg btn-primary btn-block" name="back" value="back" type="submit">修正する</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">登録する</button>
</form>

@endsection