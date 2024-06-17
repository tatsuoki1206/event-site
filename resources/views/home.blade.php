@section('title','ホーム')
@extends('layouts/auth')
@section('content')
        <div class="container">
            <div class="mt-5">
                @csrf
                <x-alert type="success" :session="session('success')" />
                <h3>プロフィール</h3>
                <ul>
                    <li>名前：{{ Auth::user()->name }}</li>
                    <li>メールアドレス：{{ Auth::user()->email }}</li>
                </ul>

                <a class="btn btn-lg btn-primary btn-block" href="edit/{{ Auth::user()->id }}">会員情報の修正</a>
                <a class="btn btn-lg btn-primary btn-block" href="{{ route('delete_confirm.show') }}">会員を退会する</a>
                <a class="btn btn-lg btn-primary btn-block" href="{{ route('image') }}">画像一覧</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">ログアウト</button>
                </form>
            </div>
        </div>
@endsection