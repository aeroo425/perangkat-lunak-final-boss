<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Lost & Found</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #F9F1DD; /* cream soft */
            font-family: Arial, sans-serif;
        }

        /* Wrapper utama */
        .page-wrapper {
            display: flex;
            height: 100vh;
            padding: 40px;
            gap: 40px;
        }

        /* LEFT SIDE */
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

        /* RIGHT SIDE – LOGIN BOX */
        .right-side {
            flex: 0.45;
            background: #88A9C4;
            border-radius: 30px;
            padding: 30px 60px 60px 60px; /* dinaikkan dari 70 -> 30 */
            padding-top: 110px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* biar nempel atas */
        }

        /* LOGO + BRAND */
        .top-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: top;
            margin-bottom: 20px;
            margin-top: -20px; /* naikkan lagi */
        }

        .top-logo img {
            width: 70px;
        }

        .top-logo .brand {
            font-size: 20px;
            font-weight: 800;
            margin-top: 5px;
            color: black;
        }

        .title {
            font-size: 38px;
            font-weight: 800;
            text-align: center;
            color: #FFF7E6;
            margin-bottom: 35px;
            line-height: 1.2;
        }

        /* Input Style */
        .form-control {
            width: 100%;
            padding: 14px;
            border-radius: 30px;
            border: none;
            background: #DFDFDF;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .forgot {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .forgot a {
            text-decoration: none;
            color: black;
            font-weight: bold;
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

        /* Responsive */
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

    <!-- LEFT SIDE -->
    <div class="left-side">
        <img src="{{ asset('Frame 1.png') }}" alt="Lost and Found">
    </div>

    <!-- RIGHT SIDE -->
    <div class="right-side">

        <div class="top-logo">
            <img src="{{ asset('2.png') }}" alt="Logo">
            <div class="brand">LOST AND FOUND</div>
        </div>

        <div class="title">LOG IN<br>ACCOUNT</div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <input type="email" name="email" class="form-control" placeholder="Email Address" required>

            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <div class="forgot">
                <a href="{{ route('password.request') }}">Forget Password</a>
            </div>

            <button class="btn-login">Log In</button>

            <div class="register">
                Don’t have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>

        </form>

    </div>

</div>

</body>
</html>
