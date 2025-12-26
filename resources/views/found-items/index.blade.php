@extends('layouts.app')

@section('content')
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!-- Font Awesome 6.5.1 CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIByS3VYH2R5pP0b6Y1eZq9VHtVHCfQW2Z8Hs8fL0PpBA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
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

        .add-btn {
            background: #28a745;
            border: none;
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

        @foreach ($items as $item)
            <div class="card mb-3 shadow-sm"><div class="row g-0">{{-- FOTO --}} <div class="col-md-3">@if ($item->foto)
                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded-start" alt="Foto Barang" style="height:100%; object-fit:cover;">
            @else
                <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded-start" alt="Tidak ada foto">
            @endif
            </div>{{-- DETAIL --}} <div class="col-md-9"><div class="card-body"><h5 class="fw-bold">{{ $item->judul }}</h5><p class="mb-1"><i class="fa fa-user"></i>Dilaporkan oleh: {{ $item->user->name }} </p><p class="mb-1"><i class="fa fa-map-marker-alt"></i>Lokasi: {{ $item->lokasi }} </p><p class="mb-1"><i class="fa fa-calendar"></i>Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }} </p><span class="badge bg-danger">HILANG</span></div></div></div></div>
        @endforeach
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
                    <a href="{{ route('lost-items.index') }}" class="menu-link">Lost Item</a>
                    <a href="{{ route('found-items.index') }}" class="menu-link active">Found Item</a>
                    <a href="{{ route('my-reports.index') }}" class="menu-link">My Report</a>
                </div>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                        style="text-decoration: none; color: black;">
                        <img src="/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.webp"
                            class="profile-img">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text"><strong>{{ Auth::user()->name }}</strong></span></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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

        {{-- CONTENT --}}
        <div class="container mt-5 p-4 rounded shadow" style="background:#9FB6C7;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Barang Ditemukan</h3>
                <a href="{{ route('found-items.create') }}" class="add-btn">
                    <i class="fa-solid fa-plus"></i> Laporkan Barang Ditemukan
                </a>
            </div>

            {{-- SEARCH --}}
            <div class="d-flex align-items-center gap-3 text-center">
                <form method="GET" action="{{ route('found-items.index') }}">
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <div class="position-relative">
                            <input type="text" name="search" class="form-control rounded-pill ps-4"
                                placeholder="Cari Barang Ditemukan..." style="width:250px;"
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-link position-absolute" style="top:0; right:10px;">
                                <i class="fa-solid fa-magnifying-glass" style="color:gray;"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <form method="GET" action="{{ route('found-items.index') }}" id="filterForm">
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <div>
                            <select name="kategori" class="form-select rounded-5" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                <option value="Primer" {{ request('kategori') == 'Primer' ? 'selected' : '' }}>
                                    Primer
                                </option>
                                <option value="Sekunder" {{ request('kategori') == 'Sekunder' ? 'selected' : '' }}>
                                    Sekunder
                                </option>
                                <option value="Tersier" {{ request('kategori') == 'Tersier' ? 'selected' : '' }}>
                                    Tersier
                                </option>
                            </select>
                        </div>
                        <div>
                            <input type="date" name="created_at" class="form-control"
                                value="{{ request('created_at') }}" onchange="this.form.submit()">
                        </div>
                        <div class="align-self-end">
                            <a href="{{ route('found-items.index') }}" class="btn btn-secondary rounded-pill px-4">
                                <i class="fa-solid fa-rotate-right"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

            </div>

            {{-- LIST --}}
            @if ($items->count() > 0)
                <div class="d-flex flex-column gap-4">
                    @foreach ($items as $item)
                        <div class="item-card">

                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto barang"
                                    style="max-width:200px">
                            @endif

                            <div class="flex-grow-1">
                                <h5 class="fw-bold">{{ $item->nama_barang }}</h5>
                                <p class="mb-1"><i class="fa-solid fa-user"></i> {{ $item->nama_pelapor }}</p>
                                <p class="mb-1"><i class="fa-solid fa-location-dot"></i> {{ $item->lokasi }}</p>
                                <p class="mb-1"><i class="fa-solid fa-calendar"></i>
                                    {{ $item->created_at->format('d M Y') }}</p>
                            </div>

                            <div class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-2 text-success fw-bold">
                                    <div class="status-dot" style="border:2px solid green;"></div>
                                    DITEMUKAN
                                </div>
                                <a href="{{ route('lost-found.show', $item->id) }}" class="detail-btn mt-2">
                                    Lihat Detail
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $items->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                    <p class="mb-0">Belum ada laporan barang ditemukan.</p>
                </div>
            @endif

        </div>
    </div>

@endsection
