<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function form()
    {
        return view('auth.forgot-password');
    }

    public function cekEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email belum terdaftar'])->withInput();
        }

        return back()->with('password', $user->password_plain ?? '(Tidak ada password plaintext)');
    }
}
