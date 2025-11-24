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
use Illuminate\Support\Facades\Log; // <-- Tambahkan ini untuk logging error

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * Kita ganti redirect ke halaman verifikasi OTP
     *
     * @var string
     */
    protected $redirectTo = '/verify-otp';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // Validasi Email: Wajib, string, email, maks 255, dan TIDAK BOLEH DOBEL di tabel 'users'.
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // Validasi Password: Wajib, string, min 8, dan HARUS SAMA dengan field 'password_confirmation'.
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // 1. Buat pengguna dengan 'email_verified_at' NULL
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => null,
        ]);

        // 2. Hasilkan OTP acak (6 digit angka)
        $otp_code = Str::padLeft(random_int(1, 999999), 6, '0');

        // 3. Simpan OTP dan waktu kedaluwarsa (misalnya 10 menit)
        $user->update([
            'otp_code' => $otp_code,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // 4. Kirim Email OTP
        try {
            Mail::to($user->email)->send(new OTPMail($otp_code));
        } catch (\Exception $e) {
            // Log error jika pengiriman email gagal
            Log::error("Gagal mengirim OTP ke " . $user->email . ": " . $e->getMessage());
        }

        return $user;
    }

    /**
     * Timpa method registered untuk mengarahkan ke halaman verifikasi dan menyimpan user ID di session
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registered(Request $request, $user)
    {
        // Logout user agar mereka tidak otomatis login sebelum verifikasi
        $this->guard()->logout();

        // Simpan user ID di session untuk digunakan di halaman verifikasi
        $request->session()->put('otp_user_id', $user->id);

        return redirect($this->redirectPath())->with('success', 'Akun berhasil dibuat. Silakan cek email Anda untuk kode verifikasi.');
    }
}
