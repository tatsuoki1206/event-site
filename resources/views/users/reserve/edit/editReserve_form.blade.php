@section('title','Sound Space Fukuoka | チケット予約申込編集フォーム')
@extends('users/layouts/layout')
@section('content')

<div class="py-5 text-center">
    <h2>チケット予約申込編集フォーム</h2>
</div>

<div class="row g-5">
<div class="col-md-7 col-lg-8">
<form class="" method="POST" action="{{ route('editReserveConfirm') }}">
  @csrf
  @foreach ($errors->all() as $error)
    <ul class="alert alert-danger">
      <li>{{$error}}</li>
    </ul>
  @endforeach
        
    <x-alert type="danger" :session="session('danger')" />
    <input type="hidden" name="id" value="{{ $inputs->id }}">
    <div class="col-md-5">
      <label for="country" class="form-label">イベント名（event name）</label>
        <select class="form-select" name="event_name" required>
          <option value="Broad feat. AAA" @if( old('event_name') ?? $inputs->event_name === 'Broad feat. AAA' ) selected @endif>Broad feat. AAA</option>
          <option value="ABC EVENT" @if( old('event_name') ?? $inputs->event_name === 'ABC EVENT' ) selected @endif>ABC EVENT</option>
        </select>
    </div>

    <div class="col-md-5">
      <label for="country" class="form-label">チケット枚数（ticket num）</label>
        <select class="form-select" name="num" required>
          <option value="1" @if( old('num') ?? $inputs->num === '1' ) selected @endif>1</option>
          <option value="2" @if( old('num') ?? $inputs->num === '2' ) selected @endif>2</option>
        </select>
    </div>

    <div class="row g-3">
      <div class="col-sm-6">
            <label for="firstName" class="form-label">姓 (Last Name)</label>
            <input type="text" class="form-control" name="last_name" placeholder="山田" value="{{ old('last_name') ?? $inputs->last_name }}" required>
      </div>
      <div class="col-sm-6">
        <label for="lastName" class="form-label">名（First name）</label>
        <input type="text" class="form-control" name="first_name" placeholder="太郎" value="{{ old('first_name') ?? $inputs->first_name }}" required>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-sm-6">
            <label for="firstName" class="form-label">セイ (Last Name Katakana)</label>
            <input type="text" class="form-control" name="last_name_kana" placeholder="ヤマダ" value="{{ old('last_name_kana') ?? $inputs->last_name_kana }}" required>
      </div>
      <div class="col-sm-6">
        <label for="lastName" class="form-label">メイ（First name Katakana）</label>
        <input type="text" class="form-control" name="first_name_kana" placeholder="タロウ" value="{{ old('first_name_kana') ?? $inputs->first_name_kana }}" required>
      </div>
    </div>

    <div class="col-12">
      <label for="tel" class="form-label">電話番号（Tel）</label>
      <input type="tel" class="form-control" name="tel1" placeholder="080" value="{{ old('tel1') ?? $inputs->tel1 }}" required>
      <input type="tel" class="form-control" name="tel2" placeholder="1234" value="{{ old('tel2') ?? $inputs->tel2 }}" required>
      <input type="tel" class="form-control" name="tel3" placeholder="5678" value="{{ old('tel3') ?? $inputs->tel3 }}" required>
    </div>

    <div class="col-12">
      <label for="email" class="form-label">メールアドレス（email）</label>
      <input type="hidden" class="form-control" name="email" value="{{ old('email') ?? $inputs->email }}" required>
      <p>{{ old('email') ?? $inputs->email }}</p>
    </div>

    <div class="col-12">
      <label for="message" class="form-label">その他メッセージ（message）</label>
      <textarea class="form-control" name="message">{{ old('message') ?? $inputs->message }}</textarea>  
    </div>


  <a class="btn btn-lg btn-primary btn-block" href="/">イベント詳細画面に戻る</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">確認画面へ</button>
</form>
</div>
</div>

@endsection