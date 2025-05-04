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

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h2>カテゴリ編集</h2>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>カテゴリ名</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
            </div>
            <div>
                <button type="submit">更新</button>
                <a href="{{ route('categories.index') }}">戻る</a>
            </div>
        </form>
    </div>
    @endsection
</body>

</html>