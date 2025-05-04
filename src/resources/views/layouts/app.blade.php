<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- スタイルはできる限り画像に合わせます -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header style="padding: 10px; background-color: #f5f5f5; display: flex; justify-content: flex-end; gap: 10px;">
        <a href="{{ route('login') }}">login</a>
        <a href="{{ route('register') }}">register</a>
    </header>

    <main style="padding: 20px;">
        @yield('content')
    </main>
</body>
</html>
