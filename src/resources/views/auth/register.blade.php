<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

@extends('layouts.app')
<body>
    @section('content')
    <h1>ユーザー登録</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label>お名前 <span>※</span></label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>メールアドレス <span>※</span></label><br>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>パスワード <span>※</span></label><br>
            <input type="password" name="password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>パスワード（確認） <span>※</span></label><br>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">登録</button>
    </form>
    @endsection
</body>

</html>