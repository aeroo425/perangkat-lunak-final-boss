@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    .claim-container {
        background: #9FB6C7;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .claim-title {
        font-weight: 800;
        color: #2D5165;
    }

    .claim-card {
        background: #FFF2DB;
        border-radius: 14px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .claim-card img {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
        background: #ddd;
    }

    .claim-badge {
    position: absolute;
    top: 12px;
    right: 12px;

    background: #DC2626;
    color: white;

    padding: 8px 22px;
    font-size: 14px;
    font-weight: 700;

    border-radius: 999px; /* pill */
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;
}


    .back-btn {
        background: #DE8651;
        color: white;
        font-weight: bold;
        padding: 8px 18px;
        border-radius: 20px;
        text-decoration: none;
    }

    .back-btn:hover {
        background: #c96f3f;
        color: white;
    }


    .btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 8px 22px;
    border-radius: 999px; /* 🔥 PENTING */
    font-weight: 700;
    font-size: 14px;

    border: none;
    background-color: #E39A63;
    color: white;
    text-decoration: none;

    height: 38px; /* samain tinggi */
    transition: all 0.25s ease;
}

.btn-action:hover {
    background-color: #d68750;
    color: white;
}




</style>

<div class="container mt-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="claim-title">📦 Claim Items</h3>
        <a href="{{ route('dashboard') }}" class="back-btn">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="claim-container">

        @if($items->count())
            <div class="d-flex flex-column gap-4">
                @foreach($items as $item)
                    <div class="claim-card">

                        {{-- STAMP --}}
                        <div class="claim-badge">DIKLAIM</div>

                        {{-- FOTO --}}
                        @if($item->foto)
                            <img src="{{ asset('storage/'.$item->foto) }}">
                        @else
                            <img src="/default-item.png">
                        @endif

                        {{-- INFO --}}
                        <div class="flex-grow-1">
                            <h5 class="fw-bold">{{ $item->judul }}</h5>
                            <p class="mb-1">
                                <i class="fa fa-user"></i> {{ $item->user->name }}
                            </p>
                            <p class="mb-1">
                                <i class="fa fa-location-dot"></i> {{ $item->lokasi }}
                            </p>
                            <p class="mb-0">
                                <i class="fa fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </p>
                        </div>

                        {{-- DETAIL --}}
                        <a href="{{ route('items.show_item', $item->id) }}"
   class="btn-action">
    Detail
</a>

                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fa fa-inbox fa-3x mb-2"></i>
                <p class="mb-0">Belum ada barang yang diklaim</p>
            </div>
        @endif

    </div>
</div>
@endsection
