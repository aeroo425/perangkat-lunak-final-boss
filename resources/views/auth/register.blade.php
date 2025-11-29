<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Lost & Found</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>

        body {
            margin: 0;
            padding: 0;
            background: #d9d9d9;
            font-family: Arial, sans-serif;
        }

        /* Layout full */
        .register-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* KIRI (FORM) */
        .left-side {
            flex: 1;
            padding: 60px 80px;
        }

        .title {
            font-size: 40px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 40px;
        }

        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
        }

        .btn-submit {
            background: #7da3bd;
            border: none;
            border-radius: 30px;
            padding: 12px;
            font-size: 20px;
            font-weight: bold;
        }

        /* KANAN (GAMBAR) */
        .right-side {
            flex: 1;
            background: #FFF5E3;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 200px;
            border-bottom-left-radius: 200px;
            box-shadow: -5px 0 30px rgba(0,0,0,0.1);
        }

        .right-side img {
            width: 80%;
            max-width: 500px;
        }

        @media (max-width: 900px) {
            .register-wrapper {
                flex-direction: column;
            }
            .right-side {
                display: none;
            }
        }

    </style>
</head>
<body>

<div class="register-wrapper">

    <!-- ============================
         KIRI - FORM REGISTER
    ============================ -->
    <div class="left-side">

        <div class="title">
            <img src="{{ asset('images/user-icon.png') }}" alt="" width="60">
            <br>
            Daftar Akun
        </div>

        {{-- Notif berhasil --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Notif error --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama --}}
            <label class="fw-bold mb-1">Nama Lengkap</label>
            <input type="text" name="name" class="form-control mb-3"
                placeholder="Masukkan nama lengkap" required>

            {{-- Email --}}
            <label class="fw-bold mb-1">Email</label>
            <input type="email" name="email" class="form-control mb-3"
                placeholder="Masukkan email" required>

            {{-- Password --}}
            <label class="fw-bold mb-1">Password</label>
            <input type="password" name="password"
                class="form-control mb-3"
                placeholder="Masukkan password" required>

            {{-- Konfirmasi --}}
            <label class="fw-bold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="form-control mb-4"
                placeholder="Ulangi password" required>

            <button type="submit" class="btn-submit w-100">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="fw-bold">Login</a>
        </div>
    </div>

    <!-- ============================
         KANAN - GAMBAR
    ============================ -->
    <div class="right-side">
        <img src="{{ asset('ChatGPT Image Nov 29, 2025, 10_07_06 AM 2.png') }}" alt="Register Image">
    </div>

</div>

</body>
</html>
