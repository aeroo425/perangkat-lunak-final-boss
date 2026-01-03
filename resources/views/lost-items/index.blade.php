@extends('layouts.app')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

<style>
    body {
        background-color: #87A9C4 !important;
        font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
        background: #F6EEDB;
        padding: 6px 25px;
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

    .menu-link.active,
    .menu-link:hover {
        color: #DE8651;
        border-bottom: 2px solid #DE8651;
    }

    .profile-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #DE8651;
    }

    .item-card {
        background: white;
        border-radius: 12px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 3px 6px rgba(0,0,0,.1);
    }

    .detail-btn {
        background: #DE8651;
        padding: 7px 18px;
        color: white;
        border-radius: 12px;
        font-weight: bold;
        text-decoration: none;
    }

    .detail-btn:hover {
        background: #c96f3f;
        color: white;
    }

    .add-btn {
        background: #28a745;
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: bold;
        color: white;
        text-decoration: none;
    }

    .add-btn:hover {
        background: #218838;
        color: white;
    }

    .status-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid red;
    }
</style>

<div class="min-vh-100 pb-5">

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container-fluid">

        <div class="d-flex align-items-center gap-3">
            <img src="/Frame 1.png" class="logo-img">
            <h4 class="fw-bold m-0">LOST AND FOUND</h4>
        </div>

        <div class="ms-auto me-4">
            <a href="{{ route('dashboard') }}" class="menu-link">Home</a>
            <a href="{{ route('lost-items.index') }}" class="menu-link active">Lost Item</a>
            <a href="{{ route('found-items.index') }}" class="menu-link">Found Item</a>
            <a href="{{ route('my-reports.index') }}" class="menu-link">My Report</a>
        </div>

        <div class="dropdown">
            <a data-bs-toggle="dropdown">
                <img src="/avatar.png" class="profile-img">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-item-text fw-bold">{{ Auth::user()->name }}</li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>

<div class="container mt-5 p-4 rounded shadow" style="background:#9FB6C7;">

    <div class="d-flex justify-content-between mb-4">
        <h3 class="fw-bold">Barang Hilang</h3>
        <a href="{{ route('lost-items.create') }}" class="add-btn">
            <i class="fa fa-plus"></i> Laporkan Barang Hilang
        </a>
    </div>

    {{-- FILTER --}}
    <form method="GET" class="d-flex flex-wrap gap-3 mb-4">
        <input type="text" name="search" class="form-control rounded-pill"
            placeholder="Cari barang..." value="{{ request('search') }}" style="width:250px">

        <select name="kategori" class="form-select rounded-pill" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <option value="primer" {{ request('kategori')=='primer'?'selected':'' }}>Primer</option>
            <option value="sekunder" {{ request('kategori')=='sekunder'?'selected':'' }}>Sekunder</option>
            <option value="tersier" {{ request('kategori')=='tersier'?'selected':'' }}>Tersier</option>
        </select>

        {{-- ✅ FIX FILTER TANGGAL --}}
        <input type="date" name="tanggal" class="form-control"
            value="{{ request('tanggal') }}" onchange="this.form.submit()">

        <a href="{{ route('lost-items.index') }}" class="btn btn-secondary rounded-pill">
            Reset
        </a>
    </form>

    {{-- LIST --}}
    @forelse($items as $item)
        <div class="item-card mb-3">
            @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" width="120" class="rounded">
            @endif

            <div class="flex-grow-1">
                <h5 class="fw-bold">{{ $item->judul }}</h5>
                <p class="mb-1"><i class="fa fa-user"></i> {{ $item->user->name }}</p>
                <p class="mb-1"><i class="fa fa-location-dot"></i> {{ $item->lokasi }}</p>
                <p class="mb-1"><i class="fa fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                </p>
            </div>

            <div class="text-end">
                <div class="d-flex align-items-center gap-2 text-danger fw-bold">
                    <div class="status-dot"></div> HILANG
                </div>
                <a href="{{ route('lost-found.show', $item->id) }}" class="detail-btn mt-2 d-inline-block">
                    Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            Belum ada laporan barang hilang.
        </div>
    @endforelse

    {{ $items->links() }}

</div>
</div>
@endsection
