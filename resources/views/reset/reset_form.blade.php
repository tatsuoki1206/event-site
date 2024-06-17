@section('title','イベント管理システム | パスワードリセット')
@extends('layouts/guest')
@section('content')

<form class="form-signin" method="POST" action="{{ route('resetMail') }}">
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

@endsection