<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.form');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        // メール送信処理（実装例）
        // Mail::to('admin@example.com')->send(new ContactMail($validated));

        return redirect()->route('contact.form')->with('success', 'お問い合わせを送信しました。');
    }
}
