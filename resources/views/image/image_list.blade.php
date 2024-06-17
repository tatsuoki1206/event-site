@section('title','イベント管理システム | 画像ファイル一覧')
@extends('layouts/auth')
@section('content')

<div class="container">
  <div class="mt-5">
  <x-alert type="success" :session="session('success')" />
    <a class="btn btn-lg btn-primary btn-block" href="{{ route('image_form.show') }}">画像アップロードへ</a>
    <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>

    <div class="row">
      <div class="col-md-10 col-md-offset-2">
        <h2>画像一覧</h2>

        <table class="table table-striped">
          <tr>
              <th>番号</th>
              <th>タイトル</th>
              <th>画像内容</th>
              <th></th>
              <th></th>
          </tr>
          @foreach($images as $image)
          <tr>
              <td>{{ $image->id }}</td>
              <td>{{ $image->description }}</td>
              <td><img src="{{ asset('storage/'.$image->file_path) }}" alt=""></td>
              <td>編集</td>
              <form method="POST" action="{{ route('deleteImage', $image->id) }}" onSubmit="return checkDelete()">
                @csrf
                <input type="hidden" name="id" value="{{ $image->id }}">
                <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
              </form>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    
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