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
            background: #F9F1DD; /* cream */
            font-family: 'Arial', sans-serif;
        }

        /* Wrapper */
        .page-wrapper {
            display: flex;
            height: 100vh;
            padding: 40px;
            gap: 40px;
        }

        /* LEFT – LOGO BESAR */
        .left-box {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .left-box img {
            width: 100%;
            max-width: 600px;
        }

        .left-box h2 {
            margin-top: 20px;
            font-weight: 800;
            font-size: 32px;
        }

        /* RIGHT – FORM CARD */
        .right-box {
            flex: 1;
            background: #88A9C4;
            padding: 50px;
            border-radius: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            text-align: center;
            font-size: 36px;
            font-weight: 800;
            color: #FFF7E6;
        }

        .logo-mini {
            width: 60px;
            display: block;
            margin: 0 auto 10px;
        }

        /* Input style */
        .form-control {
            border-radius: 30px;
            padding: 14px 20px;
            font-size: 16px;
        }

        /* Button */
        .btn-create {
            background: #F39B53;
            border: none;
            color: black;
            font-weight: bold;
            padding: 14px;
            border-radius: 30px;
            font-size: 18px;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .page-wrapper {
                flex-direction: column;
                padding: 20px;
            }
            .left-box {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <!-- LEFT IMAGE + TITLE -->
    <div class="left-box">
        <img src="{{ asset('Frame 1.png') }}" alt="Lost & Found">

    </div>

    <!-- RIGHT – FORM -->
    <div class="right-box">

        <img class="logo-mini" src="{{ asset('images/lostfound-mini.png') }}" alt="">
        <h1 class="form-title mb-4">CREATE ACCOUNT</h1>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name"
                class="form-control mb-3"
                placeholder="Full Name" required>

            <input type="email" name="email"
                class="form-control mb-3"
                placeholder="Email Address" required>

            <input type="password" name="password"
                class="form-control mb-3"
                placeholder="Password" required>

            <input type="password" name="password_confirmation"
                class="form-control mb-4"
                placeholder="Confirm Password" required>

            <button class="btn-create w-100">Create Account</button>
        </form>

        <div class="text-center mt-3">
            Have an account?
            <a href="{{ route('login') }}" class="fw-bold text-dark">
                Log In
            </a>
        </div>

    </div>

</div>

</body>
</html>
