@extends('layouts.app')

@section('content')
<style>
    body {
        background: #EEF2F7;
        font-family: 'Poppins', sans-serif;
    }

    .admin-container {
        max-width: 1200px;
        margin: 40px auto;
    }

    .admin-title {
        font-weight: 800;
        color: #1F2937;
        margin-bottom: 25px;
    }

    .admin-card {
    background: #FFFFFF;
    border-radius: 16px;
    padding: 30px 20px 20px; /* 👈 padding atas ditambah */
    display: flex;
    gap: 20px;
    position: relative;
    box-shadow: 0 6px 14px rgba(0,0,0,0.08);
}




    .admin-card:hover {
        transform: translateY(-4px);
    }

    .admin-card img {
        width: 110px;
        height: 110px;
        border-radius: 14px;
        object-fit: cover;
        background: #E5E7EB;
    }

    .stamp-diklaim {
    position: absolute;
    top: -12px; /* 👈 naik ke atas */
    right: 20px;
    background: rgba(220,38,38,0.95);
    color: white;
    padding: 6px 16px;
    font-weight: 800;
    font-size: 12px;
    border-radius: 20px;
    transform: rotate(-8deg);
    z-index: 10;
}


    .status {
        font-weight: 800;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .status.hilang { color: #DC2626; }
    .status.ditemukan { color: #16A34A; }
    .status.diklaim { color: #6B7280; }

    .admin-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-left: auto;
    margin-top: 28px; /* 👈 TURUNIN tombol */
}

    .btn-admin {
        padding: 8px 18px;
        border-radius: 14px;
        font-weight: 700;
        border: 2px solid;
        text-decoration: none;
        text-align: center;
        transition: .2s;
    }

    .btn-edit {
        border-color: #2563EB;
        color: #2563EB;
    }

    .btn-edit:hover {
        background: #2563EB;
        color: white;
    }

    .btn-delete {
        border-color: #DC2626;
        color: #DC2626;
    }

    .btn-delete:hover {
        background: #DC2626;
        color: white;
    }

    .navbar-custom {
    background: #F6EEDB;
    padding: 10px 30px;
    margin-bottom: 60px; /* 🔥 JARAK KE BAWAH */

    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-bottom: 1px solid #e6e0d3;
}

.logo-img {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

.profile-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #ff7a00;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ff7a00;
}

.profile-avatar i {
    font-size: 18px;
    color: #6B7280;
}
</style>
{{-- NAVBAR ADMIN --}}

<div class="container">
    <div class="bg-white rounded-4 shadow-sm p-4">
        {{-- ISI DASHBOARD --}}

<nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container-fluid">

        {{-- LEFT --}}
        <div class="d-flex align-items-center gap-3">
            <img src="/Frame 1.png" class="logo-img">
            <h4 class="fw-bold m-0">LOST AND FOUND</h4>
        </div>

        {{-- RIGHT --}}
        <div class="ms-auto d-flex align-items-center">

            {{-- PROFILE --}}
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown" aria-expanded="false">

                    <div class="profile-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>

                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="dropdown-header text-center fw-bold">
                        {{ Auth::user()->name }}
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item" href="{{ route('profile_admin') }}">

                            <i class="fa fa-user me-2"></i> Profile
                        </a>
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fa fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>





    @if($items->count())
        <div class="d-flex flex-column gap-4">
            @foreach($items as $item)
                <div class="admin-card">

                    {{-- STAMP --}}
                    @if($item->status === 'diklaim')
                        <div class="stamp-diklaim">DIKLAIM</div>
                    @endif

                    {{-- FOTO --}}
                    @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}">
                    @else
                        <img src="/default-item.png">
                    @endif

                    {{-- INFO --}}
                    <div>
                        <h5 class="fw-bold mb-1">{{ $item->judul }}</h5>
                        
                        <p class="mb-1">
                            <i class="fa fa-user"></i>
                            {{ $item->user->name }}
                        </p>
                        <p class="mb-1">
                            <i class="fa fa-location-dot"></i>
                            {{ $item->lokasi }}
                        </p>
                        <p class="mb-1">
                            <i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </p>

                        <div class="status {{ $item->status }}">
                            {{ strtoupper($item->status) }}
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="admin-actions">

                        <a href="{{ route('admin.items.edit', $item->id) }}"
                           class="btn-admin btn-edit">
                            ✏ Edit
                        </a>

                        <form action="{{ route('lost-found.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-admin btn-delete w-100">
                                🗑 Delete
                            </button>
                        </form>

                    </div>
                    <div class="d-flex gap-2 mt-3">

    {{-- EDIT --}}
    <a href="{{ route('admin.items.edit', $item->id) }}"
       class="btn btn-warning btn-sm">
        <i class="fa fa-edit"></i> Edit
    </a>

    {{-- DELETE --}}
    <form action="{{ route('admin.items.destroy', $item->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin hapus item ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> Hapus
        </button>
    </form>

</div>


                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Tidak ada item
        </div>
    @endif

    </div>
</div>

</div>
@endsection
