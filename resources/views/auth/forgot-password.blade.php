<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lupa Password</title>
    <style>
        body{font-family:system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;margin:40px;}
        .container{max-width:420px;margin:0 auto;}
        .alert{padding:10px;border:1px solid #ccc;background:#f8f8f8;margin-bottom:12px;}
        .error{color:#a00;margin-top:6px;}
        input[type="email"]{width:100%;padding:8px;margin-top:6px;margin-bottom:8px;border:1px solid #ccc;border-radius:4px;}
        button{padding:8px 12px;border:none;background:#2563eb;color:#fff;border-radius:4px;cursor:pointer;}
        a{color:#2563eb;text-decoration:none;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Lupa Password</h1>

        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert">
                <strong>Terdapat kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('lupa.password.cek') }}">
            @csrf

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            <button type="submit">Kirim tautan reset password</button>
        </form>

        <p style="margin-top:12px;">
            <a href="{{ route('login') }}">Kembali ke halaman login</a>
        </p>
    </div>
</body>
</html>
