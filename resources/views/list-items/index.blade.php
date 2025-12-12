"@extends('layouts.app')

@section('content')

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

    .list-item-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .list-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .item-image {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        object-fit: cover;
        background: #ddd;
        margin-bottom: 15px;
    }

    .no-image {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .badge-lost {
        background-color: #dc3545;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
    }

    .badge-found {
        background-color: #28a745;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
    }

    .item-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .item-info {
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .item-info i {
        margin-right: 8px;
        color: #DE8651;
    }

    .detail-link {
        background: #DE8651;
        border: none;
        padding: 8px 20px;
        color: white;
        border-radius: 12px;
        font-weight: bold;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        margin-top: auto;
        text-align: center;
    }

    .detail-link:hover {
        background: #c96f3f;
        color: white;
    }
</style>

<div class=\"min-vh-100 pb-5\">

    {{-- NAVBAR --}}
    <nav class=\"navbar navbar-expand-lg navbar-custom shadow-sm\">
        <div class=\"container-fluid\">

            <div class=\"d-flex align-items-center gap-3\">
                <img src=\"/Frame 1.png\" class=\"logo-img\">
                <h4 class=\"fw-bold m-0\">LOST AND FOUND</h4>
            </div>

            <div class=\"d-flex align-items-center ms-auto me-4\">
                <a href=\"{{ route('dashboard') }}\" class=\"menu-link\">Home</a>
                <a href=\"{{ route('list-items.index') }}\" class=\"menu-link active\">List Item</a>
                <a href=\"{{ route('my-reports.index') }}\" class=\"menu-link\">My Report</a>
            </div>

            <div class=\"dropdown\">
                <a class=\"dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" style=\"text-decoration: none; color: black;\">
                    <img src=\"/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.webp\" class=\"profile-img\">
                </a>
                <ul class=\"dropdown-menu dropdown-menu-end\">
                    <li><span class=\"dropdown-item-text\"><strong>{{ Auth::user()->name }}</strong></span></li>
                    <li><hr class=\"dropdown-divider\"></li>
                    <li>
                        <form action=\"{{ route('logout') }}\" method=\"POST\">
                            @csrf
                            <button type=\"submit\" class=\"dropdown-item\">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class=\"container mt-5 p-4 rounded shadow\" style=\"background:#9FB6C7;\">

        <div class=\"mb-4\">
            <h3 class=\"fw-bold text-center\">LIST ITEM</h3>
            <p class=\"text-center\">Daftar semua barang hilang dan ditemukan</p>
        </div>

        @if($items->count() > 0)
            <div class=\"row g-4\">
                @foreach($items as $item)
                    <div class=\"col-12 col-sm-6 col-lg-4 col-xl-3\">
                        <div class=\"list-item-card\">

                            {{-- Gambar Item --}}
                            @if($item->foto)
                                <img src=\"{{ asset($item->foto) }}\" class=\"item-image\" alt=\"{{ $item->judul }}\">
                            @else
                                <div class=\"no-image\">
                                    <i class=\"fa-solid fa-image fa-3x text-secondary\"></i>
                                </div>
                            @endif

                            {{-- Nama Barang --}}
                            <div class=\"item-title\">{{ $item->judul }}</div>

                            {{-- Status Badge --}}
                            <div class=\"mb-3\">
                                @if($item->status === 'hilang')
                                    <span class=\"badge-lost\">
                                        <i class=\"fa-solid fa-circle-exclamation\"></i> LOST
                                    </span>
                                @else
                                    <span class=\"badge-found\">
                                        <i class=\"fa-solid fa-circle-check\"></i> FOUND
                                    </span>
                                @endif
                            </div>

                            {{-- Lokasi --}}
                            @if($item->lokasi)
                                <div class=\"item-info\">
                                    <i class=\"fa-solid fa-location-dot\"></i>
                                    {{ Str::limit($item->lokasi, 30) }}
                                </div>
                            @endif

                            {{-- Tanggal --}}
                            @if($item->tanggal)
                                <div class=\"item-info\">
                                    <i class=\"fa-solid fa-calendar\"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </div>
                            @endif

                            {{-- Tombol Detail --}}
                            <a href=\"{{ route('lost-found.show', $item->id) }}\" class=\"detail-link mt-3\">
                                Lihat Detail
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class=\"alert alert-info text-center\">
                <i class=\"fa-solid fa-inbox fa-3x mb-3\"></i>
                <p class=\"mb-0\">Tidak ada item ditemukan</p>
            </div>
        @endif

    </div>

</div>

@endsection
"
