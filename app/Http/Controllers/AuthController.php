<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 👉 Tampilkan form register
    public function showRegisterForm() {
        return view('auth.register');
    }

    // 👉 Tampilkan form login
    public function showLoginForm() {
        return view('auth.login');
    }

    // 👉 Simpan data register ke database
    public function register(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',           // password == password_confirmation
                'regex:/[A-Z]/',       // huruf besar
                'regex:/[a-z]/',       // huruf kecil
                'regex:/[0-9]/',       // angka
                'regex:/[@$!%*#?&]/',  // simbol
            ],
        ], [
            'password.confirmed' => 'Password dan konfirmasi harus sama.',
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        try {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')
                ->with('success', 'Akun berhasil dibuat. Silakan login.');

        } catch (\Exception $e) {
            return back()->with('error', 'Registrasi gagal, silakan coba lagi.');
        }
    }

    // 👉 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/home'); // ubah sesuai halaman setelah login
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // 👉 Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
