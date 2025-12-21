@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #2D5165;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        color: #F9F1DD;
    }

    /* NAVBAR */
    .navbar-custom {
        background: #F6EEDB;
        padding: 8px 30px;
    }

    .logo-img {
        width: 55px;
        height: 55px;
        object-fit: contain;
    }

    .menu-link {
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        color: black;
        margin-left: 25px;
    }

    .menu-link:hover,
    .menu-link.active {
        color: #E46A2F;
        border-bottom: 2px solid #E46A2F;
        padding-bottom: 4px;
    }

    /* CARD */
    .item-card {
        background: #F9F1DD;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .item-img {
        height: 200px;
        object-fit: cover;
        background: #D9D9D9;
    }

    .no-image {
        height: 200px;
        background: #9CA3AF;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .item-title {
        font-weight: bold;
        font-size: 18px;
    }

    .item-location {
        color: #6B7280;
        font-size: 14px;
    }

    .btn-detail {
        background: #E46A2F;
        border: none;
        font-weight: bold;
        border-radius: 10px;
    }

    .btn-detail:hover {
        background: #d45f29;
    }

    /* STATUS BADGE */
    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 13px;
    }

    .status-found {
        background: #E8F5E9;
        color: #2E7D32;
        border: 2px solid #2E7D32;
    }

    .status-lost {
        background: #FDECEA;
        color: #C62828;
        border: 2px solid #C62828;
    }
</style>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container-fluid">
        <div class="d-flex align-items-center gap-3">
            <img src="/Frame 1.png" class="logo-img">
            <h4 class="fw-bold m-0">LOST AND FOUND</h4>
        </div>

        <div class="ms-auto">
            <a href="{{ route('dashboard') }}"
               class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Home
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <h3 class="fw-bold text-center mb-4 page-title">
        Daftar Barang Lost & Found
    </h3>

    <div class="row g-4">
        @foreach($items as $item)
            <div class="col-md-4">
                <div class="card item-card shadow-sm">

                    {{-- STATUS --}}
                    @if($item->status === 'ditemukan')
                        <div class="status-badge status-found">DITEMUKAN</div>
                    @elseif($item->status === 'hilang')
                        <div class="status-badge status-lost">HILANG</div>
                    @endif

                    {{-- GAMBAR --}}
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             class="item-img w-100">
                    @else
                        <div class="no-image">Tidak ada gambar</div>
                    @endif

                    <div class="card-body">
                        <h5 class="item-title">{{ $item->judul }}</h5>
                        <p class="item-location">{{ $item->lokasi }}</p>

                        <a href="{{ route('lost-found.show', $item->id) }}"
                           class="btn btn-detail w-100 text-white">
                            Lihat Detail
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
