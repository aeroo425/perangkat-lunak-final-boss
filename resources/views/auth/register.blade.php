<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Lost & Found</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #F9F1DD;
            font-family: Arial, sans-serif;
        }

        .page-wrapper {
            display: flex;
            height: 100vh;
            padding: 40px;
            gap: 40px;
        }

        /* LEFT */
        .left-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .left-side img {
            width: 120%;
            max-width: 500px;
        }

        /* RIGHT */
        .right-side {
            flex: 0.45;
            background: #88A9C4;
            border-radius: 30px;
            padding: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .top-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 40px; /* jarak dari REGISTER title */
        }

        .top-logo .brand {
            font-size: 20px;
            font-weight: 800;
            margin-top: 5px;
            color: black;
        }

        .logo-mini {
            width: 60px;
            display: block;
        }

        .title {
            font-size: 34px;
            font-weight: 800;
            text-align: center;
            color: #FFF7E6;
            margin-bottom: 35px;
            line-height: 1.3;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            border-radius: 30px;
            border: none;
            background: #DFDFDF;
            font-size: 16px;
            margin-bottom: 18px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #F39B53;
            border: none;
            border-radius: 30px;
            font-size: 20px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        .register {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .register a {
            font-weight: bold;
            color: black;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .page-wrapper {
                flex-direction: column;
                padding: 20px;
            }
            .left-side {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <!-- LEFT -->
    <div class="left-side">
        <img src="{{ asset('Frame 1.png') }}" alt="">
    </div>

    <!-- RIGHT -->
    <div class="right-side">

        <div class="top-logo">
            <img src="2.png" class="logo-mini">
            <h3 class="brand">LOST AND FOUND</h3>
        </div>

        <div class="title">CREATE<br>ACCOUNT</div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <input type="text" name="name" class="form-control" placeholder="Full Name" required>

            <input type="email" name="email" class="form-control" placeholder="Email Address" required>

            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

            <button class="btn-login">Register</button>

            <div class="register">
                Already have an account?
                <a href="{{ route('login') }}">Log In</a>
            </div>
            @if ($errors->any())
    <div style="background:#ffcccc; padding:15px; border-radius:10px; margin-bottom:20px;">
        <ul style="margin:0; padding-left:15px; color:#b30000; font-weight:bold;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        </form>

    </div>
</div>

</body>
</html>
