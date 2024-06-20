@section('title','Sound Space Fukuoka | チケット予約申込フォーム')
@extends('users/layouts/layout')
@section('content')

<div class="py-5 text-center">
    <h2>チケット予約申込フォーム</h2>
</div>

<div class="row g-5">
<div class="col-md-7 col-lg-8">
<form class="" method="POST" action="{{ route('reserveConfirm') }}">
  @csrf
  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
        
    <x-alert type="danger" :session="session('danger')" />

    <div class="col-md-5">
      <label for="country" class="form-label">イベント名</label>
        <select class="form-select" name="event" required>
          <option value="1">AAA</option>
          <option value="2">BBB</option>
        </select>
    </div>

    <div class="col-md-5">
      <label for="country" class="form-label">チケット枚数</label>
        <select class="form-select" name="num" required>
          <option value="1">1</option>
          <option value="2">2</option>
        </select>
    </div>

    <div class="row g-3">
      <div class="col-sm-6">
            <label for="firstName" class="form-label">姓 (Last Name)</label>
            <input type="text" class="form-control" name="last_name" placeholder="山田" value="" required>
      </div>
      <div class="col-sm-6">
        <label for="lastName" class="form-label">名（First name）</label>
        <input type="text" class="form-control" name="first_name" placeholder="太郎" value="" required>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-sm-6">
            <label for="firstName" class="form-label">セイ (Last Name Katakana)</label>
            <input type="text" class="form-control" name="last_name_kana" placeholder="山田" value="" required>
      </div>
      <div class="col-sm-6">
        <label for="lastName" class="form-label">メイ（First name Katakana）</label>
        <input type="text" class="form-control" name="first_name_kana" placeholder="太郎" value="" required>
      </div>
    </div>

    <div class="col-12">
      <label for="tel" class="form-label">電話番号</label>
      <input type="tel" class="form-control" name="tel1" placeholder="080"　required>
      <input type="tel" class="form-control" name="tel2" placeholder="1234"　required>
      <input type="tel" class="form-control" name="tel3" placeholder="5678"　required>
    </div>

    <div class="col-12">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" name="email" placeholder="eventsite@example.com"　required>        
    </div>


  <a class="btn btn-lg btn-primary btn-block" href="/">イベント詳細画面に戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">確認画面へ</button>
</form>
</div>
</div>

@endsection