<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lupa Password</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Segoe UI', sans-serif;
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
            padding:20px;
        }

        .left-img{
            width:300px;
            height:300px;
            background-size:contain;
            background-position:center;
            background-repeat:no-repeat;
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

        input[type="email"]{
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
        @media (max-width:850px){
            body{
                flex-direction:column;
                height:auto;
            }
            .left-side{
                padding:40px;
            }
            .left-img{
                width:220px;
                height:220px;
            }
        }
    </style>
</head>

<body>

    <!-- LEFT AREA -->
    <div class="left-side">

        <!-- ====================
             MASUKKAN GAMBAR KIRI
             ==================== -->
        <div class="left-img"
             style="background-image:url('{{ asset('3 (1).png') }}');">
        </div>

        <div class="left-title">FORGOT PASSWORD</div>
    </div>

    <!-- RIGHT FORM AREA -->
    <div class="right-side">
        <div class="box">

            <!-- =======================
                 MASUKKAN LOGO DI SINI
                 =======================-->
            <div class="logo">
                <img src="{{ asset('2.png') }}" alt="Lost and Found">
                <h3>LOST AND FOUND</h3>
            </div>

            <h1 class="title">FORGOT PASSWORD</h1>
            <p class="subtitle">Masukkan email Anda untuk mengatur ulang password.</p>

            {{-- SUCCESS --}}
            @if (session('status'))
                <div class="alert">{{ session('status') }}</div>
            @endif

            {{-- ERRORS --}}
            @if ($errors->any())
                <div class="alert">
                    <strong>Terdapat kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:#b00020; margin-top:4px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('password.check') }}">
                @csrf

                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" required autofocus>

                <button type="submit">Send</button>
            </form>

            <div class="back-link">
                <a href="{{ route('login') }}">Kembali ke halaman Login</a>
            </div>

        </div>
    </div>

</body>
</html>
