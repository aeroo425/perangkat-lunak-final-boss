@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
        background: #F6EEDB;
        padding: 6px 25px;
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

    .menu-link.active {
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
        text-decoration: none;
    }

    .detail-btn:hover {
        background: #c96f3f;
        color: white;
    }

    .filter-btn {
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s;
    }

    .filter-btn.active {
        background: #DE8651;
        color: white;
    }

    .filter-btn:not(.active) {
        background: white;
        color: black;
    }

    .filter-btn:not(.active):hover {
        background: #f0f0f0;
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

            <div class="d-flex align-items-center ms-auto me-4">
                <a href="{{ route('dashboard') }}" class="menu-link">Home</a>
                <a href="{{ route('list-items.index') }}" class="menu-link active">List Item</a>
                <a href="{{ route('my-reports.index') }}" class="menu-link">My Report</a>
            </div>

            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: black;">
                    <img src="/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.webp" class="profile-img">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><span class="dropdown-item-text"><strong>{{ Auth::user()->name }}</strong></span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 p-4 rounded shadow" style="background:#9FB6C7;">

        <div class="mb-4">
            <h3 class="fw-bold mb-3">LIST ITEM</h3>

            {{-- Search Bar --}}
            <form method="GET" action="{{ route('list-items.index') }}" class="mb-3">
                <div class="position-relative" style="max-width: 350px;">
                    <input type="text" name="search" class="form-control rounded-pill ps-4" placeholder="Cari Barang..." value="{{ request('search') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <button type="submit" class="btn btn-link position-absolute" style="top:0; right:10px;">
                        <i class="fa-solid fa-magnifying-glass" style="color:gray;"></i>
                    </button>
                </div>
            </form>

            {{-- Filter Buttons --}}
            <div class="d-flex gap-3">
                <a href="{{ route('list-items.index', ['search' => request('search'), 'status' => 'hilang']) }}"
                   class="filter-btn {{ request('status') === 'hilang' ? 'active' : '' }}">
                    Barang Hilang
                </a>
                <a href="{{ route('list-items.index', ['search' => request('search'), 'status' => 'ditemukan']) }}"
                   class="filter-btn {{ request('status') === 'ditemukan' ? 'active' : '' }}">
                    Barang Ditemukan
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($items->count() > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($items as $item)
                    <div class="item-card">
                        @if($item->foto)
                            <img src="{{ asset($item->foto) }}" class="item-img" alt="{{ $item->judul }}">
                        @else
                            <div class="item-img d-flex align-items-center justify-content-center bg-secondary text-white">
                                <i class="fa-solid fa-image fa-2x"></i>
                            </div>
                        @endif

                        <div class="flex-grow-1">
                            <h5 class="fw-bold">{{ $item->judul }}</h5>
                            <p class="mb-1"><i class="fa-solid fa-user"></i> Dilaporkan oleh: {{ $item->user->name }}</p>
                            <p class="mb-1"><i class="fa-solid fa-location-dot"></i> Lokasi: {{ $item->lokasi }}</p>
                            <p class="mb-1"><i class="fa-solid fa-calendar"></i> Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                        </div>

                        <div class="text-end">
                            @if($item->status === 'hilang')
                                <div class="d-flex align-items-center justify-content-end gap-2 text-danger fw-bold">
                                    <div class="status-dot" style="border:2px solid red;"></div>
                                    HILANG
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-end gap-2 text-success fw-bold">
                                    <div class="status-dot" style="border:2px solid green;"></div>
                                    DITEMUKAN
                                </div>
                            @endif
                            <a href="{{ route('lost-found.show', $item->id) }}" class="detail-btn mt-2">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $items->appends(request()->query())->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                <p class="mb-0">Tidak ada item ditemukan.</p>
            </div>
        @endif

    </div>

</div>

@endsection
