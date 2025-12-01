<style>
    body {
        background-color: #8DB1CC;
        font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
        background: #F5EEDC;
        padding: 15px 40px;
        border-bottom: 2px solid #e0d3b8;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: black !important;
    }

    .navbar-menu a {
        margin-left: 25px;
        font-weight: 500;
        color: black !important;
        text-decoration: none;
    }

    .navbar-menu a:hover {
        color: #DE8651 !important;
    }

    /* Banner kosong */
    .banner-box {
        width: 100%;
        height: 150px;
        background: #F8F3E6;
        border: 7px solid #DE8651;
        border-radius: 15px;
    }

    .section-box {
        background: #7DA3BD;
        padding: 40px;
        border-radius: 10px;
        margin-top: 25px;
    }

    .search-box input {
        border-radius: 30px;
        padding-left: 40px;
        height: 42px;
        border: none;
    }

    .filter-btn {
        background: #DE8651;
        border: none;
        padding: 10px 25px;
        border-radius: 20px;
        color: white;
        font-weight: 600;
        transition: 0.2s;
    }

    .filter-btn:hover {
        opacity: 0.8;
    }

    /* card item */
    .item-card {
        background: #F8F3E6;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .item-img {
        width: 90px;
        height: 90px;
        background: #D9D9D9;
        border-radius: 8px;
    }

    .item-status {
        font-weight: 700;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-found {
        color: #4A8D52;
    }

    .status-lost {
        color: #C5423F;
    }

    .detail-btn {
        background: #DE8651;
        border: none;
        padding: 8px 18px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        margin-top: 8px;
    }

    .detail-btn:hover {
        opacity: 0.85;
    }

</style>


{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="#">
        <img src="https://img.icons8.com/?size=100&id=59807&format=png" width="40">
        LOST AND FOUND
    </a>

    <div class="ms-auto navbar-menu">
        <a href="/home">Home</a>
        <a href="/lost">Lost Item</a>
        <a href="/found">Found Item</a>
        <a href="/myreport">My Report</a>
    </div>
</nav>


<div class="container">

    {{-- Banner Section (3 kotak) --}}
    <div class="row text-center mt-4">
        <div class="col-md-4"><div class="banner-box"></div></div>
        <div class="col-md-4"><div class="banner-box"></div></div>
        <div class="col-md-4"><div class="banner-box"></div></div>
    </div>

    {{-- Daftar Barang --}}
    <div class="section-box mt-5">

        <h3 class="fw-bold text-white">Daftar Barang</h3>

        <div class="d-flex align-items-center mt-3 gap-3">
            <div class="search-box flex-grow-1">
                <input type="text" class="form-control" placeholder="Cari Barang...">
            </div>

            <button class="filter-btn">Barang Hilang</button>
            <button class="filter-btn">Barang Ditemukan</button>
        </div>

        <br>

        {{-- Looping Item --}}
        @foreach ($items as $item)
            <div class="item-card">

                <div class="d-flex align-items-center gap-3">
                    <div class="item-img"></div>

                    <div>
                        <h6 class="fw-bold">{{ $item->nama }}</h6>
                        <p style="margin:0">Kategori: {{ $item->kategori }}</p>
                        <p style="margin:0">Lokasi Hilang: {{ $item->lokasi }}</p>
                        <p style="margin:0">Tanggal: {{ $item->tanggal }}</p>
                    </div>
                </div>

                <div class="text-end">

                    @if ($item->status == 'found')
                        <div class="item-status status-found">
                            🟢 DITEMUKAN
                        </div>
                    @else
                        <div class="item-status status-lost">
                            🔴 HILANG
                        </div>
                    @endif

                    <a href="/detail/{{ $item->id }}">
                        <button class="detail-btn mt-2">Lihat Detail</button>
                    </a>

                </div>
            </div>
        @endforeach

    </div>
</div>

@endsection
