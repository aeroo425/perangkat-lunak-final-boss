<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center"><strong>Login</strong></div>

                <div class="card-body">
                    @if($errors->has('error'))
                        <div class="alert alert-danger">{{ $errors->first('error') }}</div>
                    @endif

                    <form action="{{ route('login.check') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <p class="mt-3 text-center">
                        Belum punya akun?
                        <a href="/register" class="text-primary fw-bold">Register</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@vite(['resources/css/app.css', 'resources/js/app.js'])
