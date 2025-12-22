@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    .edit-card {
        max-width: 550px;
        margin: 80px auto;
        background: #FFF2DB;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }

    .edit-card h3 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .form-control {
        border-radius: 12px;
        padding: 10px 15px;
    }

    .btn-update {
        background: #DE8651;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 30px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-update:hover {
        background: #c96f3f;
    }

    .btn-back {
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        font-weight: 600;
        color: #555;
    }

    .btn-back:hover {
        text-decoration: underline;
    }
</style>

<div class="edit-card">

    <h3>✏️ Edit Item</h3>

    <form method="POST" action="{{ route('admin.items.update', $item->id) }}">
        @csrf
        @method('PUT')

        <input
            class="form-control mb-3"
            name="judul"
            value="{{ $item->judul }}"
            placeholder="Judul Item"
            required
        >

        <input
            class="form-control mb-3"
            name="lokasi"
            value="{{ $item->lokasi }}"
            placeholder="Lokasi ditemukan / hilang"
            required
        >

        <input
            type="date"
            class="form-control mb-3"
            name="tanggal"
            value="{{ $item->tanggal }}"
            required
        >

        <select class="form-control mb-4" name="status" required>
            <option value="hilang" {{ $item->status=='hilang'?'selected':'' }}>Hilang</option>
            <option value="ditemukan" {{ $item->status=='ditemukan'?'selected':'' }}>Ditemukan</option>
            <option value="diklaim" {{ $item->status=='diklaim'?'selected':'' }}>Diklaim</option>
        </select>

        <div class="text-center">
            <button class="btn-update">
                💾 Update Item
            </button>
        </div>
    </form>

    <div class="text-center">
        <a href="{{ route('admin.items.index') }}" class="btn-back">
            ← Kembali ke Daftar Item
        </a>
    </div>

</div>

@endsection
