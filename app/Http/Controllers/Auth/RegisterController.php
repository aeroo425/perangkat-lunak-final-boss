<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login'; // setelah sukses daftar

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * REGISTER OVERRIDE
     * Dipakai ketika kamu ingin custom redirect & notif
     */
    public function register(Request $request)
    {
        // VALIDASI KUAT
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',      // minimal 1 huruf besar
                'regex:/[a-z]/',      // minimal 1 huruf kecil
                'regex:/[0-9]/',      // minimal 1 angka
                'regex:/[@$!%*#?&]/', // minimal 1 simbol
            ],
        ], [
            'password.confirmed' => 'Password dan konfirmasi harus sama.',
            'password.regex'     => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.',
        ]);

        try {

            // SIMPAN USER
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Redirect ke login + notif sukses
            return redirect()
                ->route('login')
                ->with('success', 'Akun berhasil dibuat. Silakan login.');

        } catch (\Exception $e) {
            return back()->with('error', 'Registrasi gagal, silakan coba lagi.');
        }
    }
}
