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
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <table class="table table-striped">
                    <tr>
                        <th>イベント名</th>
                        <th>枚数</th>
                        <th>姓</th>
                        <th>名</th>
                        <th>セイ</th>
                        <th>メイ</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>メッセージ</th>
                        <th>登録日時</th>
                        <th>更新日時</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($reserves as $reserve)
                    <tr>
                        <td>{{ $reserve->event_name }}</td>
                        <td>{{ $reserve->num }}</td>
                        <td>{{ $reserve->last_name }}</td>
                        <td>{{ $reserve->first_name }}</td>
                        <td>{{ $reserve->last_name_kana }}</td>
                        <td>{{ $reserve->first_name_kana }}</td>
                        <td>{{ $reserve->tel }}</td>
                        <td>{{ $reserve->email }}</td>
                        <th>{{ $reserve->message }}</th>
                        <td>{{ $reserve->created_at }}</td>
                        <td>{{ $reserve->updated_at }}</td>
                    <form method="POST" action="{{ route('deleteReturn', $image->id) }}" onSubmit="return checkDelete()">
                        @csrf
                        <td>編集</td>
                        <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                    </form>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>    
            <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
    </div>
</div>

<script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
</script>
@endsection