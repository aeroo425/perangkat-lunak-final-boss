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

    .report-btn {
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: bold;
        border: none;
        color: white;
        text-decoration: none;
        font-size: 15px;
        display: inline-block;
    }

    .report-btn-lost {
        background: #dc3545;
    }

    .report-btn-lost:hover {
        background: #bb2d3b;
        color: white;
    }

    .report-btn-found {
        background: #28a745;
    }

    .report-btn-found:hover {
        background: #218838;
        color: white;
    }

    .filter-tab {
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 14px;
    }

    .filter-tab.active {
        background: #DE8651;
        color: white;
    }

    .filter-tab:not(.active) {
        background: white;
        color: black;
    }

    .filter-tab:not(.active):hover {
        background: #f0f0f0;
        color: black;
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

    .action-btn {
        padding: 6px 15px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 13px;
        border: none;
        text-decoration: none;
        color: white;
        margin: 0 3px;
    }

    .btn-edit {
        background: #0d6efd;
    }

    .btn-edit:hover {
        background: #0b5ed7;
        color: white;
    }

    .btn-delete {
        background: #dc3545;
    }

    .btn-delete:hover {
        background: #bb2d3b;
        color: white;
    }

    .btn-detail {
        background: #DE8651;
    }

    .btn-detail:hover {
        background: #c96f3f;
        color: white;
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
                <a href="{{ route('list-items.index') }}" class="menu-link">List Item</a>
                <a href="{{ route('my-reports.index') }}" class="menu-link active">My Report</a>
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

    <div class="container mt-5">

        {{-- Header dengan tombol laporkan --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">MY REPORT</h3>
            <div class="d-flex gap-3">
                <a href="{{ route('lost-items.create') }}" class="report-btn report-btn-lost">
                    <i class="fa-solid fa-plus"></i> Laporkan Barang Hilang
                </a>
                <a href="{{ route('found-items.create') }}" class="report-btn report-btn-found">
                    <i class="fa-solid fa-plus"></i> Laporkan Barang Ditemukan
                </a>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div class="d-flex gap-3 mb-4">
            <a href="{{ route('my-reports.index') }}"
               class="filter-tab {{ !request('status') ? 'active' : '' }}">
                Semua Laporan
            </a>
            <a href="{{ route('my-reports.index', ['status' => 'hilang']) }}"
               class="filter-tab {{ request('status') === 'hilang' ? 'active' : '' }}">
                Laporan Kehilangan
            </a>
            <a href="{{ route('my-reports.index', ['status' => 'ditemukan']) }}"
               class="filter-tab {{ request('status') === 'ditemukan' ? 'active' : '' }}">
                Laporan Penemuan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- List Items --}}
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
                            <p class="mb-1"><i class="fa-solid fa-location-dot"></i> {{ $item->lokasi }}</p>
                            <p class="mb-1"><i class="fa-solid fa-calendar"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                            <p class="mb-0"><small class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</small></p>
                        </div>

                        <div class="text-end">
                            @if($item->status === 'hilang')
                                <div class="d-flex align-items-center justify-content-end gap-2 text-danger fw-bold mb-2">
                                    <div class="status-dot" style="border:2px solid red;"></div>
                                    HILANG
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-end gap-2 text-success fw-bold mb-2">
                                    <div class="status-dot" style="border:2px solid green;"></div>
                                    DITEMUKAN
                                </div>
                            @endif

                            <div class="d-flex gap-1">
                                <a href="{{ route('lost-found.show', $item->id) }}" class="action-btn btn-detail">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('lost-found.edit', $item->id) }}" class="action-btn btn-edit">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('lost-found.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $items->appends(request()->query())->links() }}
            </div>
        @else
            <div class="alert alert-info text-center p-5">
                <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                <p class="mb-0 fw-bold">Belum ada laporan</p>
            </div>
        @endif

    </div>

</div>

@endsection
