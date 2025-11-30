@extends('layouts.app')

@section('content')

{{-- BOOTSTRAP 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
        background: #F6EEDB;
        padding: 15px 40px;
    }

    .menu-link {
        font-weight: 600;
        margin-left: 25px;
        text-decoration: none;
        color: black;
    }

    .menu-link:hover {
        color: #DE8651;
    }

    .banner-box {
        background: #FFF2DB;
        height: 160px;
        border: 4px solid #DE8651;
        border-radius: 12px;
    }

    .filter-btn {
        background: #DE8651;
        border: none;
        padding: 10px 25px;
        border-radius: 20px;
        font-weight: bold;
        color: white;
    }

    .item-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .detail-btn {
        background: #DE8651;
        border: none;
        padding: 8px 20px;
        color: white;
        border-radius: 12px;
        font-weight: bold;
    }
</style>

<div class="min-vh-100 pb-5">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
        <div class="container-fluid">
            <div class="d-flex align-items-center gap-2">
                <img src="/icon.png" width="45">
                <h4 class="fw-bold">LOST AND FOUND</h4>
            </div>

            <div class="d-flex align-items-center">
                <a href="#" class="menu-link">Home</a>
                <a href="#" class="menu-link">Lost Item</a>
                <a href="#" class="menu-link">Found Item</a>
                <a href="#" class="menu-link">My Report</a>
            </div>

            <div>
                <div class="rounded-circle bg-warning d-flex justify-content-center align-items-center"
                     style="width:45px; height:45px;">
                    <i class="fa-solid fa-user text-white"></i>
                </div>
            </div>
        </div>
    </nav>

    {{-- 3 Banner Box --}}
    <div class="container mt-4">
        <div class="row g-4">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-md-4">
                    <div class="banner-box"></div>
                </div>
            @endfor
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container mt-5 p-4 rounded shadow" style="background:#9FB6C7;">
        <h3 class="fw-bold mb-4">Daftar Barang</h3>

        {{-- SEARCH + FILTER --}}
        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
            <div class="position-relative">
                <input type="text" class="form-control rounded-pill ps-4" placeholder="Cari Barang..." style="width:220px;">
                <i class="fa-solid fa-magnifying-glass position-absolute"
                   style="top:10px; right:15px; color:gray;"></i>
            </div>

            <button class="filter-btn">Barang Hilang</button>
            <button class="filter-btn">Barang Ditemukan</button>
        </div>

        {{-- LIST ITEM --}}
        <div class="d-flex flex-column gap-4">

            {{-- ITEM 1 --}}
            <div class="item-card d-flex gap-3 align-items-center">
                <div class="bg-secondary rounded" style="width:95px; height:95px;"></div>

                <div class="flex-grow-1">
                    <h5 class="fw-bold">STNK Vario 150</h5>
                    <p class="mb-1">Kategori: Barang Berharga</p>
                    <p class="mb-1">Lokasi Hilang: SWK Telkom</p>
                    <p class="mb-1">Tanggal: 25 Nov 2025</p>
                </div>

                <div class="text-end">
                    <div class="d-flex align-items-center justify-content-end gap-2 fw-bold text-success">
                        <div class="rounded-circle" style="width:18px; height:18px; border:2px solid green;"></div>
                        DITEMUKAN
                    </div>

                    <button class="detail-btn mt-2">Lihat Detail</button>
                </div>
            </div>

            {{-- ITEM 2 --}}
            <div class="item-card d-flex gap-3 align-items-center">
                <div class="bg-secondary rounded" style="width:95px; height:95px;"></div>

                <div class="flex-grow-1">
                    <h5 class="fw-bold">Tumblr Tuku</h5>
                    <p class="mb-1">Kategori: Barang Berharga</p>
                    <p class="mb-1">Lokasi Hilang: Gerbong Kereta</p>
                    <p class="mb-1">Tanggal: 27 Nov 2025</p>
                </div>

                <div class="text-end">
                    <div class="d-flex align-items-center justify-content-end gap-2 fw-bold text-danger">
                        <div class="rounded-circle" style="width:18px; height:18px; border:2px solid red;"></div>
                        HILANG
                    </div>

                    <button class="detail-btn mt-2">Lihat Detail</button>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
