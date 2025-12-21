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

    .foto-item {
        width: 80px;
        height: 80px;
        border-radius: 5px;
        object-fit: cover;
        background: #D9D9D9;
    }

    .foto-zoom {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 6px;
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.foto-zoom.zoomed {
    transform: scale(3);
    cursor: zoom-out;
    z-index: 10;
}

</style>

<div class="detail-container">

    <!-- LEFT PANEL -->
    <div class="box">
        <div class="title">DETAIL BARANG</div>

        <!-- FOTO -->
<div style="display:flex; gap:10px; margin-bottom:20px;">
    @if($item->foto)
        <img
            src="{{ asset('storage/' . $item->foto) }}"
            class="foto-zoom"
            onclick="toggleZoom(this)"
        >
    @else
        <div class="foto-zoom placeholder">-</div>
    @endif
</div>

        <p class="label">NAMA BARANG:</p>
        <p>{{ $item->judul }}</p>

        <p class="label">KATEGORI:</p>
        <p>-</p>

        <hr style="margin:20px 0;">

        <p class="label">INFORMASI PELAPOR</p>
        <p>Nama: {{ $item->user->name }}</p>
        <p>Email: {{ $item->user->email }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
    </div>

  <!-- RIGHT PANEL -->
<div class="box">

    <div class="title">DESKRIPSI BARANG</div>

    <p>{{ $item->deskripsi ?? '-' }}</p>

    <p class="label">LOKASI</p>
    <p>{{ $item->lokasi ?? '-' }}</p>

    <div style="display:flex; align-items:center; gap:12px; margin-top:20px;">

        {{-- STATUS --}}
        <div
            id="statusBadge"
            class="status-badge"
            style="
                {{ $item->status == 'hilang' ? 'border-color:#D77400;color:#D77400;background:#FFE7CD;' : '' }}
                {{ $item->status == 'ditemukan' ? 'border-color:#16A34A;color:#16A34A;background:#DCFCE7;' : '' }}
                {{ $item->status == 'diklaim' ? 'border-color:#9CA3AF;color:#374151;background:#E5E7EB;' : '' }}
            ">
            {{ strtoupper($item->status) }}
        </div>

        {{-- TOMBOL KLAIM --}}
        @if($item->status !== 'diklaim')
            <button
                id="btnKlaim"
                class="btn-claim"
                onclick="klaimItem({{ $item->id }})">
                Klaim Barang
            </button>
        @endif

    </div>




</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function klaimItem(itemId) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin ingin klaim item ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Klaim',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/items/${itemId}/klaim`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: data.message,
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = "{{ route('dashboard') }}";
});


                    // UPDATE STATUS
                    const badge = document.getElementById('statusBadge');
                    badge.innerText = 'DIKLAIM';
                    badge.style.borderColor = '#9CA3AF';
                    badge.style.color = '#374151';
                    badge.style.background = '#E5E7EB';

                    // HILANGKAN TOMBOL
                    document.getElementById('btnKlaim').remove();
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Item sudah diklaim.', 'error');
            });
        }
    });
}

function toggleZoom(img) {
    img.classList.toggle('zoomed');
}
</script>
















@endsection
