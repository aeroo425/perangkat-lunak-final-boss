<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-header text-center"><strong>Login</strong></div>
                <div class="card-body">

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email / Username</label>
                            <input type="text" name="login" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>

                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
