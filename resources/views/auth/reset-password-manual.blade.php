<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset Password Baru</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            background:#F9F1DD;
        }

        /* LEFT SIDE */
        .left-side{
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            padding:10px;
        }

        .left-img{
            width:300px;
            height:300px;
            background-size:contain;
            background-repeat:no-repeat;
            background-position:center;
        }

        .left-title{
            margin-top:25px;
            font-size:32px;
            font-weight:900;
            color:#000;
        }

        /* RIGHT SIDE */
        .right-side{
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px;
        }

        .box{
            width:100%;
            max-width:420px;
            background:#84A6C1;
            padding:50px 35px;
            border-radius:26px;
            color:white;
            box-shadow:0 5px 10px rgba(0,0,0,0.15);
        }

        /* LOGO */
        .logo{
            text-align:center;
            margin-bottom:10px;
        }

        .logo img{
            width:70px;
            height:70px;
            object-fit:contain;
        }

        .logo h3{
            margin-top:5px;
            font-size:18px;
            letter-spacing:1px;
            font-weight:800;
        }

        .title{
            font-size:32px;
            font-weight:800;
            margin:20px 0 6px;
            text-align:center;
        }

        .subtitle{
            text-align:center;
            font-size:15px;
            opacity:0.95;
            margin-bottom:28px;
        }

        .alert{
            padding:12px;
            background:#ffffffd0;
            border-radius:10px;
            font-size:15px;
            color:#222;
            margin-bottom:12px;
        }

        input{
            width:100%;
            padding:14px;
            margin-top:6px;
            margin-bottom:20px;
            border-radius:28px;
            border:none;
            background:#DFDFDF;
            font-size:15px;
        }

        button{
            width:100%;
            padding:14px;
            background:#F39B53;
            border:none;
            border-radius:30px;
            font-size:18px;
            color:white;
            cursor:pointer;
            font-weight:700;
            transition:0.2s;
        }

        button:hover{
            background:#d67f3b;
        }

        .back-link{
            text-align:center;
            margin-top:16px;
        }

        .back-link a{
            color:#000;
            font-weight:700;
            text-decoration:none;
        }

        .back-link a:hover{
            text-decoration:underline;
        }

        /* Responsive */
        @media(max-width:850px){
            body{
                flex-direction:column;
                height:auto;
            }
            .left-img{
                width:220px;
                height:220px;
            }
        }
    </style>
</head>

<body>

    <!-- LEFT -->
    <div class="left-side">
        <!-- Gambar kiri -->
        <div class="left-img" style="background-image:url('{{ asset('3 (1).png') }}')"></div>
        <div class="left-title">RESET PASSWORD</div>
    </div>

    <!-- RIGHT FORM -->
    <div class="right-side">
        <div class="box">

            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('2.png') }}" alt="Lost and Found">
                <h3>LOST AND FOUND</h3>
            </div>

            <h1 class="title">Reset Password Baru</h1>
            <p class="subtitle">Silakan masukkan password baru Anda.</p>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <div style="color:#b00020;">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.manual.update') }}">
                @csrf

                <input type="hidden" name="email" value="{{ $email }}">

                <label>Password Baru</label>
                <input type="password" name="password" required>

                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>

                <button type="submit">Ubah Password</button>
            </form>

            <div class="back-link">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>

        </div>
    </div>

</body>
</html>
