@section('title','Sound Space Fukuoka | チケット予約申込内容確認')
@extends('users/layouts/layout')
@section('content')

<div class="py-5 text-center">
    <h2>チケット予約申込内容確認</h2>
</div>

<div class="row g-5">
<div class="col-md-7 col-lg-8">
<form class="" method="POST" action="{{ route('reserveRegister') }}">
  @csrf
  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
        
    <x-alert type="danger" :session="session('danger')" />

    <div class="col-md-5">
      <label for="country" class="form-label">イベント名</label>
      <input type="hidden" name="event" value="{{ $inputs['event'] }}">
      <p>{{ $inputs['event'] }}</p>
    </div>

    <div class="col-md-5">
      <label for="country" class="form-label">チケット枚数</label>
      <input type="hidden" name="num" value="{{ $inputs['num'] }}">
      <p>{{ $inputs['num'] }}</p>
    </div>

    <div class="row g-3">
      <div class="col-sm-6">
            <label for="firstName" class="form-label">姓 (Last Name)</label>
            <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
            <p>{{ $inputs['last_name'] }}</p>
      </div>
      <div class="col-sm-6">
        <label for="lastName" class="form-label">名（First name）</label>
        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        <p>{{ $inputs['first_name'] }}</p>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-sm-6">
          <label for="firstName" class="form-label">セイ (Last Name Katakana)</label>
          <input type="hidden" name="last_name_kana" value="{{ $inputs['last_name_kana'] }}">
          <p>{{ $inputs['last_name_kana'] }}</p>
      </div>
      <div class="col-sm-6">
        <label for="lastName" class="form-label">メイ（First name Katakana）</label>
        <input type="hidden" name="first_name_kana" value="{{ $inputs['first_name_kana'] }}">
        <p>{{ $inputs['first_name_kana'] }}</p>
      </div>
    </div>

    <div class="col-12">
      <label for="tel" class="form-label">電話番号</label>
      <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
      <p>{{ $inputs['tel'] }}</p>     
    </div>

    <div class="col-12">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="hidden" name="email" value="{{ $inputs['email'] }}">
      <p>{{ $inputs['email'] }}</p>         
    </div>


  <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">確認画面へ</button>
</form>
</div>
</div>

@endsection