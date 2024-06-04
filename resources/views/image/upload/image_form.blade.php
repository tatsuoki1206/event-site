<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像アップロードフォーム</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>

<div class="container">
  <div class="mt-5">
    <x-alert type="success" :session="session('success')" />
    <form class="form-signin" method="POST" action="{{ route('image') }}" enctype= "multipart/form-data">
      @csrf

      @foreach ($errors->all() as $error)
        <ul class="alert alert-danger">
          <li>{{$error}}</li>
        </ul>
      @endforeach
        
      <x-alert type="danger" :session="session('danger')" />
      <h2>画像アップロードフォーム</h2>

      <label for="image" class="sr-only">画像アップロード</label>
      <input type="file" class="form-control" name="image">

      <label for="description" class="sr-only">名称</label>
      <input type="text" class="form-control" name="description" accept="image/*">

      <button class="btn btn-lg btn-primary btn-block" type="submit">画像をアップロード</button>
      <a class="btn btn-lg btn-primary btn-block" href="/">戻る</a>
    </form>
    
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
</body>
</html>