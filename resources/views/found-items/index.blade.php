@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- TITLE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Barang Ditemukan</h2>
        <a href="{{ route('found-items.create') }}" class="btn btn-success">
            Laporkan Barang Ditemukan
        </a>
    </div>

    {{-- SEARCH BAR --}}
    <form action="{{ route('found-items.index') }}" method="GET" class="mb-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari Barang Ditemukan..."
               value="{{ request('search') }}">
    </form>

    {{-- LIST FOUND ITEMS --}}
    @if($items->count() === 0)
        <div class="text-center text-muted mt-5">
            <p>Tidak ada barang ditemukan.</p>
        </div>
    @endif

    @foreach($items as $item)
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex">

            {{-- FOTO --}}
            <div style="width:100px; height:100px; background:#ccc; border-radius:10px; overflow:hidden;">
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}"
                         style="width:100%; height:100%; object-fit:cover;">
                @endif
            </div>

            {{-- DETAIL --}}
            <div class="ms-3 flex-grow-1">
                <h5 class="mb-1">{{ $item->nama_barang }}</h5>
                <p class="mb-1 text-capitalize">{{ $item->nama_pelapor }}</p>
                <p class="mb-1">{{ $item->lokasi }}</p>
                <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
            </div>

            {{-- STATUS + BUTTON --}}
            <div class="text-end">
                <span class="badge bg-primary mb-2">DITEMUKAN</span><br>
                <a href="{{ route('lost-found.show', $item->id) }}" class="btn btn-outline-primary btn-sm">
                    Lihat Detail
                </a>
            </div>

        </div>
    </div>
    @endforeach

</div>
@endsection
