@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    .admin-wrapper {
        max-width: 1100px;
        margin: 80px auto;
        background: #FFF2DB;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        position: relative;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .admin-header h3 {
        font-weight: 700;
        margin: 0;
    }

    /* PROFILE */
    .profile-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #E5E7EB;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #DE8651;
        cursor: pointer;
    }

    .profile-avatar i {
        color: #6B7280;
        font-size: 18px;
    }

    table {
        overflow: hidden;
        border-radius: 12px;
    }

    thead {
        background: #f0e3cd;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 14px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-hilang { background: #ffc107; color: #000; }
    .status-ditemukan { background: #0d6efd; color: #fff; }
    .status-diklaim { background: #198754; color: #fff; }

    .btn-action {
        border-radius: 15px;
        padding: 4px 14px;
        font-size: 13px;
        font-weight: 600;
    }

    .item-thumb {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 3px 8px rgba(0,0,0,.2);
    }
</style>

<div class="admin-wrapper">

    {{-- HEADER --}}
    <div class="admin-header">
        <h3>📦 Admin - Semua Item</h3>

        <div class="d-flex align-items-center gap-3">

           

            {{-- DROPDOWN PROFILE --}}
            <div class="dropdown">
                <a href="#"
                   class="d-flex align-items-center text-decoration-none dropdown-toggle"
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

    {{-- TABLE --}}
    <table class="table table-bordered shadow-sm">
        <thead>
            <tr>
                <th>Foto</th>
                <th>#</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($items as $item)
            <tr>

                <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" class="item-thumb">
                    @else
                        <img src="{{ asset('default-item.png') }}" class="item-thumb">
                    @endif
                </td>

                <td>{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $item->judul }}</td>

                <td>
                    <span class="badge-status
                        {{ $item->status == 'hilang' ? 'status-hilang' :
                           ($item->status == 'ditemukan' ? 'status-ditemukan' : 'status-diklaim') }}">
                        {{ strtoupper($item->status) }}
                    </span>
                </td>

                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->tanggal }}</td>

                <td>
                    <a href="{{ route('admin.items.edit', $item->id) }}"
                       class="btn btn-warning btn-sm btn-action">
                        Edit
                    </a>

                    <form action="{{ route('admin.items.destroy', $item->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus item?')"
                                class="btn btn-danger btn-sm btn-action">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    Belum ada data item.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
