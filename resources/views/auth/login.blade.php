<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Akun</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh; /* full screen */
            width: 100%;
        }

        .left {
            flex: 1;
            background: #FAF0DE;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .left img {
            width: 90%;
            height: 90%;
            object-fit: contain; /* biar tidak ketarik */
        }

        .right {
            flex: 1;
            background: #e3e3e3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            border-radius: 0 50px 50px 0;
        }

        .header {
            background: #8aaac4;
            padding: 20px;
            border-radius: 20px;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-size: 16px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            border-radius: 20px;
            border: none;
            background: #ffffff;
            font-size: 16px;
        }

        .helper {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .helper a {
            text-decoration: none;
            color: #333;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: #8aaac4;
            font-size: 22px;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 10px;
        }

        .register {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register a {
            font-weight: bold;
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- LEFT PANEL -->
    <div class="left">
        <img src="{{ asset('ChatGPT Image Nov 27, 2025, 10_00_30 AM.png') }}" alt="Lost and Found Image">
    </div>

    <!-- RIGHT PANEL -->
    <div class="right">

        <div class="header">login akun</div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>Email address</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="helper">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>

            <button class="login-btn">Login</button>

            <div class="register">
                Belum punya akun? <a href="{{ route('register') }}">Register</a>
            </div>

        </form>

    </div>

</div>

</body>
</html>
