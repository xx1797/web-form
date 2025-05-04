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

class ContactController extends Controller
{
    public function form()
    {
        $categories = Category::all();
        return view('contact.form', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('contact.confirm', compact('inputs'));

        // カテゴリ名の取得
        $category = Category::find($input['category_id']);
        $category_name = $category ? $category->name : '未選択';

        return view('contact.confirm', [
            'input' => $input,
            'category_name' => $category_name,
        ]);
    }

    public function back(Request $request)
    {
        return redirect()->route('contact.form')->withInput();
    }

    public function send(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}