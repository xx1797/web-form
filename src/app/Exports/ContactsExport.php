<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Contact::with('category')->select('id', 'last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'category_id', 'contact', 'created_at');

        if ($this->request->filled('name')) {
            $query->where(function ($q) {
                $q->where('last_name', 'like', '%' . $this->request->name . '%')
                  ->orWhere('first_name', 'like', '%' . $this->request->name . '%');
            });
        }

        if ($this->request->filled('email')) {
            $query->where('email', 'like', '%' . $this->request->email . '%');
        }

        if ($this->request->filled('gender') && $this->request->gender != '0') {
            $query->where('gender', $this->request->gender);
        }

        if ($this->request->filled('category_id')) {
            $query->where('category_id', $this->request->category_id);
        }

        if ($this->request->filled('date')) {
            $query->whereDate('created_at', $this->request->date);
        }

        return $query->get()->map(function ($contact) {
            return [
                $contact->id,
                $contact->last_name,
                $contact->first_name,
                $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->category->name,
                $contact->contact,
                $contact->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            '姓',
            '名',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            'お問い合わせ種別',
            'お問い合わせ内容',
            '登録日',
        ];
    }
}
