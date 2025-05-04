<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

@extends('layouts.app')
<body>
    @section('content')
    <h2>お問い合わせ詳細</h2>
    
    <table>
        <tr><th>名前</th><td>{{ $contact->last_name }} {{ $contact->first_name }}</td></tr>
        <tr><th>性別</th><td>{{ $contact->gender }}</td></tr>
        <tr><th>メール</th><td>{{ $contact->email }}</td></tr>
        <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
        <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
        <tr><th>カテゴリ</th><td>{{ $contact->category->name ?? '未設定' }}</td></tr>
        <tr><th>内容</th><td>{{ $contact->content }}</td></tr>
    </table>

    <a href="{{ route('admin.index') }}">戻る</a>
    @endsection
</body>

</html>