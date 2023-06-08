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
            <x-alert type="danger" :session="'login_success'"/>
            <ul>
                <li>名前：{{ Auth::user()->name}}</li>
                <li>メールアドレス：{{ Auth::user()->email}}</li>
            </ul>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" >ログアウト</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
        </div>
    </div>
</body>
</html>