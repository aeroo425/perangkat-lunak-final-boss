@extends('layouts.app')

@section('content')
<style>
    body {
        background: #2D5165;
        font-family: Arial, sans-serif;
    }

    .detail-container {
        max-width: 1200px;
        margin: 40px auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .box {
        background: #F9F1DD;
        padding: 25px;
        border-radius: 12px;
    }

    .title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 15px;
        font-weight: bold;
        border-radius: 30px;
        border: 3px solid #D77400;
        color: #D77400;
        background: #FFE7CD;
        font-size: 18px;
        margin-top: 15px;
    }

    .btn-claim {
        padding: 10px 18px;
        background: #E46A2F;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-top: 15px;
    }
</style>

<div class="detail-container">

    <!-- LEFT PANEL -->
    <div class="box">
        <div class="title">DETAIL BARANG</div>

        <!-- FOTO -->
        <div style="display:flex; gap:10px; margin-bottom:20px;">
            <div style="width:80px; height:80px; background:#D9D9D9; border-radius:5px;"></div>
            <div style="width:80px; height:80px; background:#D9D9D9; border-radius:5px;"></div>
            <div style="width:80px; height:80px; background:#D9D9D9; border-radius:5px;"></div>
        </div>

        <p class="label">NAMA BARANG:</p>
        <p>{{ $item->nama }}</p>

        <p class="label">KATEGORI:</p>
        <p>{{ $item->kategori ?? '-' }}</p>

        <hr style="margin:20px 0;">

        <p class="label">INFORMASI PELAPOR</p>
        <p>{{ $item->pelapor_nama ?? '-' }}</p>
        <p>{{ $item->pelapor_kontak ?? '-' }}</p>
        <p>{{ $item->pelapor_email ?? '-' }}</p>
        <p>{{ $item->tanggal_lapor ?? '-' }}</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="box">
        <div class="title">DESKRIPSI BARANG</div>

        <p>{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

        <br>

        <p class="label">LOKASI</p>
        <p>{{ $item->lokasi }}</p>

        <div class="status-badge">
            {{ strtoupper($item->status) }}
        </div>

        <button class="btn-claim">Klaim Barang</button>
    </div>

</div>
@endsection
