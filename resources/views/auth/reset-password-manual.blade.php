@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Reset Password Baru</h2>

    <form action="{{ route('password.manual.update') }}" method="POST">
        @csrf

        <input type="hidden" name="email" value="{{ $email }}">

        <label>Password Baru</label>
        <input type="password" name="password" class="form-control" required>

        <label class="mt-3">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>

        <button type="submit" class="btn btn-success mt-3">Ubah Password</button>
    </form>

    <div class="mt-2">
        <a href="/login">Kembali ke Login</a>
    </div>
</div>
@endsection
