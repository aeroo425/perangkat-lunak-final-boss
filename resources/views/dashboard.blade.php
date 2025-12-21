@extends('layouts.app')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Font Awesome 6.5.1 CDN -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIByS3VYH2R5pP0b6Y1eZq9VHtVHCfQW2Z8Hs8fL0PpBA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />

@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

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
    .menu-link:hover,
    .menu-link.active {
        color: #DE8651;
    }
    .menu-link.active {
        border-bottom: 2px solid #DE8651;
    }
    .profile-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #DE8651;
    }
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
        background: #DE8651;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
        color: white;
        text-decoration: none;
    }
    .filter-btn.active,
    .filter-btn:hover {
        background: #c96f3f;
    }

    .stamp-diklaim {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-12deg);
    border: 4px solid #DC2626;
    color: #DC2626;
    padding: 12px 20px;
    font-weight: 900;
    font-size: 16px;
    background: rgba(255,255,255,0.9);
    z-index: 10;
    pointer-events: none;
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
                <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Home</a>
                <a href="{{ route('lost-items.index') }}" class="menu-link {{ request()->routeIs('lost-items.*') ? 'active' : '' }}">Lost Item</a>
                <a href="{{ route('found-items.index') }}" class="menu-link {{ request()->routeIs('found-items.*') ? 'active' : '' }}">Found Item</a>
                <a href="{{ route('my-reports.index') }}" class="menu-link {{ request()->routeIs('my-reports.*') ? 'active' : '' }}">My Report</a>
            </div>



            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="/default-profile.png" class="profile-img">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if(Auth::check())
                        <li><span class="dropdown-item-text"><strong>{{ Auth::user()->name }}</strong></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">@csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>

    {{-- BANNER --}}
    <div class="container mt-4">
    <div class="row g-4">

        {{-- Lost Items --}}
        <div class="col-md-4">
            <div class="banner-box d-flex flex-column justify-content-center">
                <i class="fa-solid fa-triangle-exclamation fa-4x text-warning"></i>
                <h5 class="mt-2 fw-bold">Lost Items</h5>
            </div>
        </div>

        {{-- Found Items --}}
        <div class="col-md-4">
            <div class="banner-box d-flex flex-column justify-content-center">
                <i class="fa-solid fa-hand-holding-heart fa-4x text-success"></i>
                <h5 class="mt-2 fw-bold">Found Items</h5>
            </div>
        </div>

        {{-- Claim Items --}}
        <div class="col-md-4">
            <div class="banner-box d-flex flex-column justify-content-center">
                <i class="fa-solid fa-clipboard-check fa-4x text-primary"></i>
                <h5 class="mt-2 fw-bold">Claim Items</h5>
            </div>
        </div>

    </div>
</div>


    {{-- CONTENT --}}

    @if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}"
});
</script>
@endif

@if(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: "{{ session('error') }}"
});
</script>
@endif

    <div class="container mt-5 p-4 rounded shadow" style="background:#9FB6C7;">

        <h3 class="fw-bold mb-4">Daftar Barang</h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                <div class="position-relative">
                    <input type="text" name="search" class="form-control rounded-pill ps-4"
                        placeholder="Cari Barang..." style="width:220px;" value="{{ request('search') }}">
                    <i class="fa-solid fa-magnifying-glass position-absolute" style="top:10px; right:15px; color:gray;"></i>
                </div>

                <button type="submit" name="status" value="" class="filter-btn {{ request('status') == '' ? 'active' : '' }}">Semua</button>
                <button type="submit" name="status" value="hilang" class="filter-btn {{ request('status') == 'hilang' ? 'active' : '' }}">Barang Hilang</button>
                <button type="submit" name="status" value="ditemukan" class="filter-btn {{ request('status') == 'ditemukan' ? 'active' : '' }}">Barang Ditemukan</button>
            </div>
        </form>

        {{-- ITEM LIST --}}
        @if($items->count() > 0)
            <div class="d-flex flex-column gap-4">
                @foreach($items as $item)
                    <div class="item-card position-relative">
                        {{-- STEMPEL JIKA SUDAH DIKLAIM --}}
@if($item->status === 'diklaim')
    <div class="stamp-diklaim">
        BARANG SUDAH DIKLAIM
    </div>
@endif



                        @if($item->foto)
    <img src="{{ asset('storage/' . $item->foto) }}"
         alt="Foto barang"
         style="max-width:200px">
@endif


                        <div class="flex-grow-1">
                            <h5 class="fw-bold">{{ $item->judul }}</h5>
                            <p class="mb-1"><i class="fa-solid fa-user"></i> Dilaporkan oleh: {{ $item->user->name }}</p>
                            <p class="mb-1"><i class="fa-solid fa-location-dot"></i> Lokasi: {{ $item->lokasi }}</p>
                            <p class="mb-1"><i class="fa-solid fa-calendar"></i> Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                        </div>

                        <div class="text-end">
                           @if($item->status === 'ditemukan')
    <div class="d-flex align-items-center justify-content-end gap-2 text-success fw-bold">
        <div class="status-dot" style="border:2px solid green;"></div> DITEMUKAN
    </div>
@elseif($item->status === 'hilang')
    <div class="d-flex align-items-center justify-content-end gap-2 text-danger fw-bold">
        <div class="status-dot" style="border:2px solid red;"></div> HILANG
    </div>
@elseif($item->status === 'diklaim')
    <div class="d-flex align-items-center justify-content-end gap-2 text-secondary fw-bold">
        <div class="status-dot" style="border:2px solid gray;"></div> DIKLAIM
    </div>
@endif


                            {{-- pastikan route-nya ada --}}
                            <a href="{{ route('items.show_item', $item->id) }}" class="detail-btn mt-2">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-0">

            </div>

        @else
            <div class="alert alert-info text-center">
                <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                <p class="mb-0">Belum ada data barang.</p>
            </div>
        @endif

    </div>
</div>

@endsection
