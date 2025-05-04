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
  <h1>お問い合わせフォーム</h1>
  
  @if ($errors->any())
    <div style="color: red;">
      入力内容に誤りがあります。
    </div>
  @endif

  <form action="{{ route('contact.confirm') }}" method="POST">
    @csrf

    <div>
      <label>お名前（姓）※</label><br>
      <input type="text" name="last_name" value="{{ old('last_name') }}">
      @error('last_name')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>お名前（名）※</label><br>
      <input type="text" name="first_name" value="{{ old('first_name') }}">
      @error('first_name')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>性別※</label><br>
      <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>男性
      <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性
      <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他
        @error('gender')
          <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
      <label>メールアドレス※</label><br>
      <input type="email" name="email" value="{{ old('email') }}">
      @error('email')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>電話番号※（ハイフンなし）</label><br>
      <input type="text" name="tel" value="{{ old('tel') }}">
      @error('tel')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>住所※</label><br>
      <input type="text" name="address" value="{{ old('address') }}">
      @error('address')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>お問い合わせの種類※</label><br>
      <select name="category_id">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      @error('category_id')
        <div style="color:red;">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <label>お問い合わせ内容※（120文字以内）</label><br>
      <textarea name="content" rows="5">{{ old('content') }}</textarea>
      @error('content')
        <div style="color:red;">{{ $message }}</div>        @enderror
    </div>

    <div>
      <button type="submit">確認画面</button>
    </div>
  </form>
@endsection
</body>

</html>