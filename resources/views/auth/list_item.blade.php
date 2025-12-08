<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lost Item</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #81A3BD;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: #F4EAD3;
            padding: 15px 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-left img {
            width: 35px;
        }

        .nav-title {
            font-size: 20px;
            font-weight: 700;
        }

        .nav-menu {
            display: flex;
            gap: 35px;
            font-weight: 500;
        }

        .nav-menu a {
            color: black;
            text-decoration: none;
        }

        .nav-profile {
            width: 38px;
            height: 38px;
            background: #F2C792;
            border-radius: 50%;
        }

        /* PAGE TITLE */
        .page-container {
            padding: 40px 70px;
        }

        .page-title {
            font-size: 34px;
            font-weight: 700;
            color: #0D1B2A;
            margin-bottom: 20px;
        }

        /* SEARCH BAR */
        .search-box {
            background: white;
            width: 260px;
            padding: 10px 15px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        .search-box input {
            border: none;
            width: 100%;
            outline: none;
            font-size: 14px;
        }

        /* LIST CARD */
        .item-card {
            background: #F4EAD3;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 25px;
        }

        .item-image {
            width: 120px;
            height: 120px;
            background: #D6D6D6;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
        }

        .item-info h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
        }

        .item-info p {
            font-size: 14px;
            margin: 3px 0;
        }

        .item-status {
            display: flex;
            align-items: center;
            gap: 7px;
            font-weight: 700;
            color: #D9534F;
            margin-bottom: 15px;
        }

        .status-icon {
            width: 22px;
            height: 22px;
            border: 3px solid #D9534F;
            border-radius: 50%;
        }

        .btn-detail {
            padding: 10px 25px;
            border: none;
            background: #E18A5C;
            color: white;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
        }

        .btn-detail:hover {
            opacity: .9;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <img src="/images/logo-lostfound.png" alt="">
        <div class="nav-title">LOST AND FOUND</div>
    </div>

    <div class="nav-menu">
        <a href="#">Home</a>
        <a href="#">Lost Item</a>
        <a href="#">Found Item</a>
        <a href="#">My Report</a>
    </div>

    <div class="nav-profile"></div>
</div>

<!-- PAGE CONTENT -->
<div class="page-container">

    <div class="page-title">LOST ITEM</div>

    <!-- SEARCH -->
    <div class="search-box">
        🔍 <input type="text" placeholder="Cari Barang...">
    </div>

    <!-- ITEM 1 -->
    <div class="item-card">
        <div class="item-image"></div>

        <div class="item-info">
            <div class="item-status">
                <div class="status-icon"></div>
                HILANG
            </div>

            <h3>STNK Vario 150</h3>
            <p>Kategori: Barang Berharga</p>
            <p>Lokasi Hilang: SWK Telkom</p>
            <p>Tanggal: 25 Nov 2025</p>
        </div>

        <button class="btn-detail">Lihat Detail</button>
    </div>

    <!-- COPY CARD INI UNTUK ITEM LAIN -->
    <div class="item-card">
        <div class="item-image"></div>

        <div class="item-info">
            <div class="item-status">
                <div class="status-icon"></div>
                HILANG
            </div>

            <h3>Tumbler Tuku</h3>
            <p>Kategori: Barang Berharga</p>
            <p>Lokasi Hilang: Gerbong Kereta</p>
            <p>Tanggal: 27 Nov 2025</p>
        </div>

        <button class="btn-detail">Lihat Detail</button>
    </div>

</div>

</body>
</html>
