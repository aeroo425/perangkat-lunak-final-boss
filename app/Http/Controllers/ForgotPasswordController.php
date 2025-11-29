<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // HALAMAN FORM LUPA PASSWORD
    public function form()
    {
        return view('auth.forgot-password');
    }

    // CEK EMAIL
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email belum terdaftar.']);
        }

        return redirect()->route('password.manual.reset', $request->email);
    }

    // HALAMAN RESET MANUAL
    public function showManualReset($email)
    {
        return view('auth.reset-password-manual', compact('email'));
    }

    // SUBMIT PASSWORD BARU
    public function manualReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('status', 'Password berhasil direset.');
    }
}
