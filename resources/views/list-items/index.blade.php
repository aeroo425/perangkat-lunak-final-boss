@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-4">

    <h2 class="mb-4 fw-bold text-center">List of Items</h2>

    {{-- SEARCH BAR --}}
    <form action="{{ route('items.search') }}" method="GET" class="d-flex">
    <form action="{{ route('items.search') }}" method="GET" class="d-flex mb-4">
        <input
            name="search"
            class="form-control me-2"
            type="search"
            placeholder="Cari barang..."
            value="{{ request('search') }}"
            required>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>

    <div class="row">
        @forelse ($items as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="Item Image">

                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <p class="card-text"><small class="text-muted">Location: {{ $item->location }}</small></p>
                        <p class="card-text"><small class="text-muted">Status: {{ $item->status }}</small></p>

                        <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-primary w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">No items found.</div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $items->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
