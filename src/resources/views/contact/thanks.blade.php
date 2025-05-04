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
  <h1>送信完了</h1>
  
  <p>お問い合わせありがとうございました。</p>
  
  <a href="{{ route('contact.form') }}">
    <button>HOME</button>
  </a>
  @endsection
</body>

</html>
