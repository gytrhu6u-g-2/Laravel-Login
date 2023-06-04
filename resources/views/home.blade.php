<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ホーム画面</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <h3>プロフィール</h3>
            @if (session('login_success')) {
                <div class="alert alert-success">
                    {{ session('login_success') }}
                </div>
            }
            @endif
            <ul>
                <li>名前：{{ Auth::user()->name}}</li>
                <li>メールアドレス：{{ Auth::user()->email}}</li>
            </ul>
        </div>
    </div>
</body>
</html>