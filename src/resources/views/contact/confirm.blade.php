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
  <h1>お問い合わせ内容の確認</h1>

  <form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <table>
      <tr>
        <th>お名前</th>
        <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          @php
            $genders = ['1' => '男性', '2' => '女性', '3' => 'その他'];
          @endphp
          {{ $genders[$inputs['gender']] ?? '未設定' }}
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $inputs['tel'] }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>
          @php
            use App\Models\Category;
            $category = Category::find($inputs['category_id']);
          @endphp
          {{ $category->name ?? '未分類' }}
        </td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $inputs['content'] }}</td>
      </tr>
    </table>

    <!-- hiddenで値を保持 -->
    @foreach ($inputs as $name => $value)
      <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach

    <div style="margin-top: 20px;">
      <button type="submit">送信</button>
    </div>
  </form>

  <form action="{{ route('contact.back') }}" method="POST" style="margin-top: 10px;">
    @csrf
    @foreach ($inputs as $name => $value)
      <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
    <button type="submit">修正する</button>
  </form>
  @endsection
</body>

</html>
