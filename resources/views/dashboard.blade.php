@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#87A9C4] pb-10">

    {{-- NAVBAR --}}
    <nav class="bg-[#F6EEDB] shadow-md px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="/icon.png" class="w-10">
            <h1 class="font-bold text-lg">LOST AND FOUND</h1>
        </div>

        <ul class="flex gap-8 font-semibold">
            <li><a href="#" class="hover:text-orange-500">Home</a></li>
            <li><a href="#" class="hover:text-orange-500">Lost Item</a></li>
            <li><a href="#" class="hover:text-orange-500">Found Item</a></li>
            <li><a href="#" class="hover:text-orange-500">My Report</a></li>
        </ul>

        <div>
            <div class="w-10 h-10 bg-orange-300 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user text-white"></i>
            </div>
        </div>
    </nav>

    {{-- BANNER (3 box) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 mt-8">
        @for ($i = 0; $i < 3; $i++)
            <div class="bg-[#FFF2DB] h-40 rounded-lg border-4 border-orange-400"></div>
        @endfor
    </div>

    {{-- CONTENT --}}
    <div class="bg-[#9FB6C7] mx-8 mt-10 p-6 rounded-lg shadow-lg">
        <h2 class="font-bold text-2xl mb-4">Daftar Barang</h2>

        {{-- SEARCH & FILTER --}}
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <div class="relative w-64">
                <input type="text" placeholder="Cari Barang..." class="w-full px-4 py-2 rounded-full shadow focus:outline-none">
                <i class="fa-solid fa-magnifying-glass absolute right-4 top-3 text-gray-500"></i>
            </div>

            <button class="bg-orange-300 px-4 py-2 rounded-full shadow font-semibold hover:bg-orange-400">
                Barang Hilang
            </button>

            <button class="bg-orange-300 px-4 py-2 rounded-full shadow font-semibold hover:bg-orange-400">
                Barang Ditemukan
            </button>
        </div>

        {{-- LIST ITEM --}}
        <div class="space-y-5">
            {{-- ITEM 1 --}}
            <div class="bg-white rounded-lg shadow flex p-4 gap-4 items-center">
                <div class="w-24 h-24 bg-gray-300 rounded"></div>

                <div class="flex-1">
                    <h3 class="font-bold">STNK Vario 150</h3>
                    <p>Kategori: Barang Berharga</p>
                    <p>Lokasi Hilang: SWK Telkom</p>
                    <p>Tanggal: 25 Nov 2025</p>
                </div>

                <div class="text-right">
                    <span class="flex items-center gap-2 text-green-600 font-bold">
                        <div class="w-5 h-5 border-2 border-green-600 rounded-full"></div>
                        DITEMUKAN
                    </span>

                    <button class="mt-3 bg-orange-300 px-4 py-2 rounded-full shadow hover:bg-orange-400">
                        Lihat Detail
                    </button>
                </div>
            </div>

            {{-- ITEM 2 --}}
            <div class="bg-white rounded-lg shadow flex p-4 gap-4 items-center">
                <div class="w-24 h-24 bg-gray-300 rounded"></div>

                <div class="flex-1">
                    <h3 class="font-bold">Tumblr Tuku</h3>
                    <p>Kategori: Barang Berharga</p>
                    <p>Lokasi Hilang: Gerbong Kereta</p>
                    <p>Tanggal: 27 Nov 2025</p>
                </div>

                <div class="text-right">
                    <span class="flex items-center gap-2 text-red-600 font-bold">
                        <div class="w-5 h-5 border-2 border-red-600 rounded-full"></div>
                        HILANG
                    </span>

                    <button class="mt-3 bg-orange-300 px-4 py-2 rounded-full shadow hover:bg-orange-400">
                        Lihat Detail
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
