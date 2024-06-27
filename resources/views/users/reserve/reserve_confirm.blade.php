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
      <label for="country" class="form-label">イベント名（event name）</label>
      <input type="hidden" name="event_name" value="{{ $inputs['event_name'] }}">
      <p>{{ $inputs['event_name'] }}</p>
    </div>

    <div class="col-md-5">
      <label for="country" class="form-label">チケット枚数（ticket num）</label>
      <input type="hidden" name="num" value="{{ $inputs['num'] }}">
      <p>{{ $inputs['num'] }}</p>
    </div>

    <div class="row g-3">
      <div class="col-sm-6">
            <label for="lastName" class="form-label">姓 (Last Name)</label>
            <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
            <p>{{ $inputs['last_name'] }}</p>
      </div>
      <div class="col-sm-6">
        <label for="firstName" class="form-label">名（First name）</label>
        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        <p>{{ $inputs['first_name'] }}</p>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-sm-6">
          <label for="lastName" class="form-label">セイ (Last Name Katakana)</label>
          <input type="hidden" name="last_name_kana" value="{{ $inputs['last_name_kana'] }}">
          <p>{{ $inputs['last_name_kana'] }}</p>
      </div>
      <div class="col-sm-6">
        <label for="firstName" class="form-label">メイ（First name Katakana）</label>
        <input type="hidden" name="first_name_kana" value="{{ $inputs['first_name_kana'] }}">
        <p>{{ $inputs['first_name_kana'] }}</p>
      </div>
    </div>

    <div class="col-12">
      <label for="tel" class="form-label">電話番号（Tel）</label>
      <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
      <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
      <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
      <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
      <p>{{ $inputs['tel'] }}</p>     
    </div>

    <div class="col-12">
      <label for="email" class="form-label">メールアドレス（email）</label>
      <input type="hidden" name="email" value="{{ $inputs['email'] }}">
      <p>{{ $inputs['email'] }}</p>         
    </div>

    <div class="col-12">
      <label for="message" class="form-label">その他メッセージ（message）</label>
      <input type="hidden" name="message" value="{{ $inputs['message'] }}">
      <p>{!! nl2br(htmlspecialchars($inputs['message'])) !!}</p>         
    </div>


    <button class="btn btn-lg btn-primary btn-block" name="back" value="back" type="submit">修正する</a>
    <button class="btn btn-lg btn-primary btn-block" type="submit">登録する</button>
</form>
</div>
</div>

@endsection