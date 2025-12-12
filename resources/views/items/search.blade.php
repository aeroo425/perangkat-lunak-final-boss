@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3>Hasil Pencarian: "{{ $search }}"</h3>
    <p class="text-secondary">Ditemukan {{ $items->count() }} hasil</p>

    @if($items->count() == 0)
        <div class="alert alert-warning">Tidak ada hasil ditemukan.</div>
    @endif

    <div class="row">
        @foreach($items as $item)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">

                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text">{{ Str::limit($item->deskripsi, 80) }}</p>

                        <a href="{{ route('items.show', $item->id) }}" class="btn btn-primary w-100">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $items->links() }}
</div>
@endsection
