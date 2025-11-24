<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    /**
     * Tampilkan halaman verifikasi OTP
     */
    public function showVerificationForm(Request $request)
    {
        // Pastikan ada user ID yang disimpan di session setelah registrasi
        if (!$request->session()->has('otp_user_id')) {
             return redirect('/register');
        }

        $user = User::find($request->session()->get('otp_user_id'));
        if (!$user) {
             return redirect('/register');
        }

        return view('auth.verify_otp', compact('user'));
    }

    /**
     * Proses pengiriman form verifikasi OTP
     */
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $user_id = $request->session()->get('otp_user_id');

        if (!$user_id) {
            return redirect('/login')->withErrors(['email' => 'Sesi verifikasi telah kedaluwarsa. Silakan coba login/register lagi.']);
        }

        $user = User::find($user_id);

        if (!$user || $user->email_verified_at) {
            return redirect('/login')->withErrors(['email' => 'Akun sudah diverifikasi.']);
        }

        // Cek apakah OTP cocok dan belum kedaluwarsa
        if ($user->otp_code == $request->otp && now()->lessThan($user->otp_expires_at)) {
            // Verifikasi Sukses
            $user->update([
                'email_verified_at' => now(),
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            $request->session()->forget('otp_user_id'); // Hapus ID dari session

            // Opsional: Login otomatis setelah verifikasi
            Auth::login($user);

            return redirect('/home')->with('status', 'Akun Anda berhasil diverifikasi. Selamat datang!');
        } else {
            // OTP Salah atau Kedaluwarsa
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa (10 menit).']);
        }
    }
}
