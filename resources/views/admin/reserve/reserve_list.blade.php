@section('title','予約リスト')
@extends('admin/layouts/auth')
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


                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">ログアウト</button>
                </form>
            </div>
        </div>
@endsection