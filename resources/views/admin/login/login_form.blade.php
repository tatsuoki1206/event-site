@section('title','イベント管理システム | ログイン')
@extends('admin/layouts/guest')
@section('content')

<form class="form-signin" method="POST" action="{{ route('login') }}">
  @csrf
  <h1 class="h3 mb-3 font-weight-normal">イベント管理システム</h1>

  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{ $error }}</li>
    </ul>
  @endforeach

  <x-alert type="success" :session="session('success')" />
  <x-alert type="danger" :session="session('danger')" />
  
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>    
  <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
  <a class="btn btn-lg btn-primary btn-block" href="/signup">新規登録</a><br>
  <a href="/reset">パスワードをお忘れの方（パスワードリセット）</a>
</form>

@endsection