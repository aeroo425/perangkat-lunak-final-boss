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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        // Simpan user baru
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan login.');
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
