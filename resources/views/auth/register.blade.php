<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Lost & Found</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Buat Akun</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Masukkan email">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                    </form>

                </div>
                <div class="card-footer text-center">
                    <small>Sudah punya akun? <a href="{{ route('login') }}">Login</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
