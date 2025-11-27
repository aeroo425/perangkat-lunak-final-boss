@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h5>Lupa Password</h5>
        </div>

        <div class="card-body">

            @if (session('password'))
                <div class="alert alert-success">
                    Password Anda: <b>{{ session('password') }}</b>
                </div>
            @endif

            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <form action="{{ route('lupa.password.cek') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Email Terdaftar</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <button class="btn btn-primary w-100">Cek Password</button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
