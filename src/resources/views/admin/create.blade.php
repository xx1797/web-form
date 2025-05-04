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
    @section('title', 'カテゴリー登録')

    @section('content')
        <h1>カテゴリー登録</h1>

          <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">カテゴリー名</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name') <div>{{ $message }}</div> @enderror
            </div>
            <button type="submit">登録</button>
        </form>
    @endsection
</body>

</html>