<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <strong>Daftar Akun Baru</strong>
                </div>

                <div class="card-body">

                    {{-- NOTIFIKASI BERHASIL --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- NOTIFIKASI ERROR VALIDASI --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa kembali data anda:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM REGISTER --}}
                    <form action="{{ url('/register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Data</button>

                        <div class="text-center mt-3">
                            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                        </div>
                    </form>
                </div>

            </div>

            {{-- NOTIFIKASI KIRIM EMAIL --}}
            <div class="alert alert-info text-center mt-3">
                Setelah registrasi, silakan cek email kamu untuk <strong>konfirmasi email</strong>.
            </div>

        </div>
    </div>
</div>

</body>
</html>
