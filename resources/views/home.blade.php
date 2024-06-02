<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h3>プロフィール</h3>
            <ul>
                <li>名前：{{ Auth::user()->name }}</li>
                <li>メールアドレス：{{ Auth::user()->email }}</li>
            </ul>

            <a class="btn btn-lg btn-primary btn-block" href="/edit">会員情報の修正</a>
            <a class="btn btn-lg btn-primary btn-block" href="/delete">会員を退会する</a>
            <a class="btn btn-lg btn-primary btn-block" href="/image">画像一覧</a>
            
        </div>
    </div>
</body>
</html>