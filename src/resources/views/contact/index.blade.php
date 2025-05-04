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
    @extends('layouts.admin')

    @section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">お問い合わせ一覧</h1>

        <!-- 検索フォーム -->
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="space-y-4 mb-6">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <input type="text" name="fullname" value="{{ request('fullname') }}" placeholder="名前" class="border p-2 w-full" />
                <input type="email" name="email" value="{{ request('email') }}" placeholder="メールアドレス" class="border p-2 w-full" />
                <select name="gender" class="border p-2 w-full">
                    <option value="all">性別</option>
                    <option value="1" @selected(request('gender') == '1')>男性</option>
                    <option value="2" @selected(request('gender') == '2')>女性</option>
                    <option value="3" @selected(request('gender') == '3')>その他</option>
                </select>
                <select name="category_id" class="border p-2 w-full">
                    <option value="">お問い合わせ種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <input type="date" name="created_at" value="{{ request('created_at') }}" class="border p-2 w-full" />
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">検索</button>
                <a href="{{ route('admin.contacts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">リセット</a>
                <a href="{{ route('admin.contacts.export', request()->query()) }}" class="bg-green-500 text-white px-4 py-2 rounded">エクスポート</a>
            </div>
        </form>

        <!-- 一覧表示 -->
        <table class="w-full border-collapse border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">名前</th>
                    <th class="border px-2 py-1">性別</th>
                    <th class="border px-2 py-1">メール</th>
                    <th class="border px-2 py-1">お問い合わせ種類</th>
                    <th class="border px-2 py-1">詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td class="border px-2 py-1">{{ $contact->id }}</td>
                        <td class="border px-2 py-1">{{ $contact->lastname }} {{ $contact->firstname }}</td>
                        <td class="border px-2 py-1">
                            @if ($contact->gender == 1) 男性
                            @elseif ($contact->gender == 2) 女性
                            @else その他
                            @endif
                        </td>
                        <td class="border px-2 py-1">{{ $contact->email }}</td>
                        <td class="border px-2 py-1">{{ $contact->category->name ?? '-' }}</td>
                        <td class="border px-2 py-1">
                            <button onclick="showDetail({{ $contact->id }})" class="text-blue-600 underline">詳細</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ページネーション -->
        <div class="mt-4">
            {{ $contacts->withQueryString()->links() }}
        </div>
    </div>

    <!-- モーダルウィンドウ -->
    <div id="detail-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded w-2/3 relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-xl">&times;</button>
            <div id="modal-content">
                <!-- JavaScriptで詳細表示 -->
            </div>
        </div>
    </div>

    <script>
    function showDetail(id) {
        fetch(`/admin/contacts/${id}`)
        .then(res => res.json())
        .then(data => {
            const content = `
                <p><strong>名前:</strong> ${data.lastname} ${data.firstname}</p>
                    <p><strong>性別:</strong> ${['', '男性', '女性', 'その他'][data.gender]}</p>
                <p><strong>メール:</strong> ${data.email}</p>
                <p><strong>電話番号:</strong> ${data.tel}</p>
                <p><strong>住所:</strong> ${data.address}</p>
                <p><strong>お問い合わせ:</strong> ${data.content}</p>
                <form method="POST" action="/admin/contacts/${data.id}" onsubmit="return confirm('本当に削除しますか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">削除</button>
                    </form>
            `;
            document.getElementById('modal-content').innerHTML = content;
            document.getElementById('detail-modal').classList.remove('hidden');
        });
    }

    function closeModal() {
        document.getElementById('detail-modal').classList.add('hidden');
    }
    </script>
    @endsection
</body>

</html>