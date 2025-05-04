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
    <h2 class="text-2xl font-semibold mb-6">お問い合わせ管理画面</h2>

    {{-- 検索フォーム --}}
    <form action="{{ route('admin.index') }}" method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <input type="text" name="name" placeholder="お名前" value="{{ request('name') }}" class="border px-3 py-2 rounded">
        <input type="email" name="email" placeholder="メールアドレス" value="{{ request('email') }}" class="border px-3 py-2 rounded">

        <select name="gender" class="border px-3 py-2 rounded">
            <option value="">性別を選択</option>
            <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id" class="border px-3 py-2 rounded">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <div class="flex space-x-2">
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="border px-3 py-2 rounded">
            <span class="self-center">〜</span>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="border px-3 py-2 rounded">
        </div>

        <div class="flex items-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">検索</button>
            <a href="{{ route('admin.index') }}" class="ml-4 text-gray-600 hover:underline">リセット</a>
        </div>
    </form>

    {{-- CSVエクスポート --}}
    <div class="mb-4">
        <a href="{{ route('admin.export', request()->query()) }}" class="bg-green-500 text-white px-4 py-2 rounded">
            CSVエクスポート
        </a>
    </div>

    {{-- 一覧表示 --}}
    @if ($contacts->count())
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">名前</th>
                <th class="border p-2">性別</th>
                <th class="border p-2">メール</th>
                <th class="border p-2">お問い合わせ種類</th>
                <th class="border p-2">登録日</th>
                <th class="border p-2">詳細</th>
                <th class="border p-2">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr class="hover:bg-gray-50">
                <td class="border p-2">{{ $contact->id }}</td>
                <td class="border p-2">{{ $contact->fullname }}</td>
                <td class="border p-2">
                    @if ($contact->gender == 1) 男性
                    @elseif ($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>
                <td class="border p-2">{{ $contact->email }}</td>
                <td class="border p-2">{{ $contact->category->name ?? '-' }}</td>
                <td class="border p-2">{{ $contact->created_at->format('Y-m-d') }}</td>
                <td class="border p-2 text-center">
                    <a href="{{ route('admin.show', $contact->id) }}">詳細</a>
                </td>
                <td class="border p-2 text-center">
                    <form action="{{ route('admin.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
                @if (session('status'))
                <div class="alert alert-success" style="color: green; margin-bottom: 20px;">
                    {{ session('status') }}
                </div>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
    @else
    <p>該当するお問い合わせが見つかりませんでした。</p>
    @endif
    @endsection
</body>

</html>