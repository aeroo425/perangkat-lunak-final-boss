@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="fw-bold mb-4">➕ Tambah Item</h3>

    <form method="POST" action="{{ route('items.store') }}">
        @csrf

        <input class="form-control mb-3" name="judul" placeholder="Judul">
        <input class="form-control mb-3" name="lokasi" placeholder="Lokasi">
        <input type="date" class="form-control mb-3" name="tanggal">

        <select class="form-control mb-3" name="status">
            <option value="hilang">Hilang</option>
            <option value="ditemukan">Ditemukan</option>
            <option value="diklaim">Diklaim</option>
        </select>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
