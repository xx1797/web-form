<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\{RegisterRequest, LoginRequest, ContactRequest};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('last_name', 'like', "%{$request->name}%")
                  ->orWhere('first_name', 'like', "%{$request->name}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->orderBy('created_at', 'desc')->paginate(7);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function detail($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.index')->with('status', '削除しました');
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('last_name', 'like', "%{$request->name}%")
                  ->orWhere('first_name', 'like', "%{$request->name}%");
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->get();

        $csvData = "お名前,メールアドレス,性別,お問い合わせ種類,お問い合わせ内容,登録日\n";
        foreach ($contacts as $contact) {
            $csvData .= sprintf(
                "%s %s,%s,%s,%s,%s,%s\n",
                $contact->last_name,
                $contact->first_name,
                $contact->email,
                ['男性', '女性', 'その他'][$contact->gender],
                $contact->category->name ?? '',
                str_replace(["\r", "\n"], '', $contact->content),
                $contact->created_at->format('Y-m-d')
            );
        }

        $filename = 'contacts_' . Carbon::now()->format('Ymd_His') . '.csv';
        Storage::disk('local')->put("exports/{$filename}", $csvData);
        return Response::download(storage_path("app/exports/{$filename}"));
    }

    public function show(Contact $contact)
    {
        return view('admin.show', compact('contact'));
    }
}

