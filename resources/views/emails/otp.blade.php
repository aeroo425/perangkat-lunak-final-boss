<x-mail::message>
# Verifikasi Email Anda

Berikut adalah Kode OTP (One-Time Password) Anda untuk verifikasi akun.

Kode ini akan kedaluwarsa dalam 10 menit.

<x-mail::panel>
# {{ $otpCode }}
</x-mail::panel>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
