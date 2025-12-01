@extends('layouts.app')

@section('content')

{{-- BOOTSTRAP --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    /* NAVBAR */
    .navbar-custom {
        background: #F6EEDB;
        padding: 6px 25px; /* NAVBAR SUDAH DIPERKECIL */
    }

    .navbar-custom h4 {
        font-size: 20px;
        font-weight: 700;
    }

    .logo-img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .menu-link {
        font-weight: 600;
        margin-right: 20px;
        font-size: 15px;
        text-decoration: none;
        color: black;
    }

    .menu-link:hover {
        color: #DE8651;
    }

    .profile-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #DE8651;
    }

    /* BANNER */
    .banner-box {
        background: #FFF2DB;
        height: 150px;
        border: 3px solid #DE8651;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 10px;
    }

    .banner-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* ITEM LIST */
    .item-card {
        background: white;
        border-radius: 12px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .item-img {
        width: 90px;
        height: 90px;
        border-radius: 10px;
        object-fit: cover;
        background: #ddd;
    }

    .status-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }

    .detail-btn {
        background: #DE8651;
        border: none;
        padding: 7px 18px;
        color: white;
        border-radius: 12px;
        font-weight: bold;
        font-size: 14px;
    }

    .filter-btn {
        background: #DE8651;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
        color: white;
    }
</style>

<div class="min-vh-100 pb-5">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
        <div class="container-fluid">

            {{-- LOGO LOST & FOUND --}}
            <div class="d-flex align-items-center gap-3">
                <img src="/Frame 1.png" class="logo-img">
                <h4 class="fw-bold m-0">LOST AND FOUND</h4>
            </div>

            {{-- MENU --}}
            <div class="d-flex align-items-center ms-auto me-4">
                <a href="#" class="menu-link">Home</a>
                <a href="#" class="menu-link">Lost Item</a>
                <a href="#" class="menu-link">Found Item</a>
                <a href="#" class="menu-link">My Report</a>
            </div>

            {{-- FOTO PROFIL --}}
            <img src="cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.webp" class="profile-img">
        </div>
    </nav>

    {{-- 3 Banner Box --}}
    <div class="container mt-4">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="banner-box">
                    <img src="{{ asset('STNK.webp') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="banner-box">
                    <img src="{{ asset('tumblrTuku.jpeg') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="banner-box">
                    <img src="{{ asset('iPhone_17_Pro_Max_1.webp') }}">
                </div>
            </div>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container mt-5 p-4 rounded shadow" style="background:#9FB6C7;">

        <h3 class="fw-bold mb-4">Daftar Barang</h3>

        {{-- SEARCH + FILTER --}}
        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
            <div class="position-relative">
                <input type="text" class="form-control rounded-pill ps-4" placeholder="Cari Barang..." style="width:220px;">
                <i class="fa-solid fa-magnifying-glass position-absolute" style="top:10px; right:15px; color:gray;"></i>
            </div>

            <button class="filter-btn">Barang Hilang</button>
            <button class="filter-btn">Barang Ditemukan</button>
        </div>

        {{-- LIST ITEMS --}}
        <div class="d-flex flex-column gap-4">

            {{-- ITEM 1 --}}
            <div class="item-card">
                <img src="{{ asset('STNK.webp') }}" class="item-img">

                <div class="flex-grow-1">
                    <h5 class="fw-bold">STNK Vario 150</h5>
                    <p class="mb-1">Kategori: Barang Berharga</p>
                    <p class="mb-1">Lokasi Hilang: SWK Telkom</p>
                    <p class="mb-1">Tanggal: 25 Nov 2025</p>
                </div>

                <div class="text-end">
                    <div class="d-flex align-items-center justify-content-end gap-2 text-success fw-bold">
                        <div class="status-dot" style="border:2px solid green;"></div>
                        DITEMUKAN
                    </div>
                    <button class="detail-btn mt-2">Lihat Detail</button>
                </div>
            </div>

            {{-- ITEM 2 --}}
            <div class="item-card">
                <img src="{{ asset('tumblrTuku.jpeg') }}" class="item-img">

                <div class="flex-grow-1">
                    <h5 class="fw-bold">Tumblr Tuku</h5>
                    <p class="mb-1">Kategori: Barang Berharga</p>
                    <p class="mb-1">Lokasi Hilang: Gerbong Kereta</p>
                    <p class="mb-1">Tanggal: 27 Nov 2025</p>
                </div>

                <div class="text-end">
                    <div class="d-flex align-items-center justify-content-end gap-2 text-danger fw-bold">
                        <div class="status-dot" style="border:2px solid red;"></div>
                        HILANG
                    </div>
                    <button class="detail-btn mt-2">Lihat Detail</button>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
