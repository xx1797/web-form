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
    <h2 class="text-2xl font-semibold mb-4">お問い合わせ詳細</h2>
    
    <table class="border w-full max-w-2xl">
        <tr><th class="border px-4 py-2 w-1/3">名前</th><td class="border px-4 py-2">{{ $contact->fullname }}</td></tr>
        <tr><th class="border px-4 py-2">性別</th><td class="border px-4 py-2">
            @if ($contact->gender == 1) 男性
            @elseif ($contact->gender == 2) 女性
            @else その他
            @endif
        </td></tr>
        <tr><th class="border px-4 py-2">メールアドレス</th><td class="border px-4 py-2">{{ $contact->email }}</td></tr>
        <tr><th class="border px-4 py-2">電話番号</th><td class="border px-4 py-2">{{ $contact->tel }}</td></tr>
        <tr><th class="border px-4 py-2">住所</th><td class="border px-4 py-2">{{ $contact->address }}</td></tr>
        <tr><th class="border px-4 py-2">お問い合わせの種類</th><td class="border px-4 py-2">{{ $contact->category->name ?? '-' }}</td></tr>
        <tr><th class="border px-4 py-2">お問い合わせ内容</th><td class="border px-4 py-2 whitespace-pre-wrap">{{ $contact->content }}</td></tr>
    </table>

    <div class="mt-4">
        <a href="{{ route('admin.index') }}" class="text-blue-500 hover:underline">← 一覧へ戻る</a>
    </div>
    @endsection
</body>

</html>