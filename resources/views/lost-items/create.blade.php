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

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .submit-btn {
        background: #DE8651;
        border: none;
        padding: 10px 30px;
        border-radius: 12px;
        font-weight: bold;
        color: white;
    }

    .submit-btn:hover {
        background: #c96f3f;
    }

    .back-btn {
        background: #6c757d;
        border: none;
        padding: 10px 30px;
        border-radius: 12px;
        font-weight: bold;
        color: white;
        text-decoration: none;
    }

    .back-btn:hover {
        background: #5a6268;
        color: white;
    }
</style>

<div class="min-vh-100 pb-5">

    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
        <div class="container-fluid">
            <div class="d-flex align-items-center gap-3">
                <img src="/Frame 1.png" class="logo-img">
                <h4 class="fw-bold m-0">LOST AND FOUND</h4>
            </div>

            <div class="d-flex align-items-center ms-auto me-4">
                <a href="{{ route('dashboard') }}" class="menu-link">Home</a>
                <a href="{{ route('lost-items.index') }}" class="menu-link active">Lost Item</a>
                <a href="{{ route('found-items.index') }}" class="menu-link">Found Item</a>
                <a href="{{ route('my-reports.index') }}" class="menu-link">My Report</a>
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
        <div class="form-card">
            <h3 class="fw-bold mb-4 text-danger">Laporkan Barang Hilang</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('lost-found.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf


                <input type="hidden" name="status" value="hilang">

                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Barang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Dompet Kulit Coklat" required value="{{ old('judul') }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan ciri-ciri barang yang hilang..." required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="lokasi" class="form-label fw-bold">Lokasi Hilang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Parkiran Gedung A" required value="{{ old('lokasi') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal Hilang <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required value="{{ old('tanggal') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label fw-bold">Foto Barang (Opsional)</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="submit-btn">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
                    </button>
                    <a href="{{ route('lost-items.index') }}" class="back-btn">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
