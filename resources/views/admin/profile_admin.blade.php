@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #87A9C4;
        font-family: 'Poppins', sans-serif;
    }

    .profile-card {
        max-width: 480px;
        margin: 80px auto;
        background: #FFF2DB;
        border-radius: 18px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #444, #999);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
        margin: 0 auto 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .profile-name {
        font-size: 22px;
        font-weight: 700;
    }

    .profile-email {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    .profile-joined {
        font-size: 13px;
        color: #777;
        margin-bottom: 25px;
    }

    .btn-dashboard {
        background: #DE8651;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 20px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-dashboard:hover {
        background: #c96f3f;
        color: white;
    }
</style>

<div class="profile-card">

    {{-- AVATAR --}}
    <div class="profile-avatar">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>

    {{-- INFO --}}
    <div class="profile-name">{{ Auth::user()->name }}</div>
<div class="profile-email">{{ Auth::user()->email }}</div>

<div class="badge bg-dark text-light px-3 py-1 rounded-pill mt-2">
    ADMINISTRATOR
</div>

<div class="profile-joined mt-3">
    Bergabung {{ Auth::user()->created_at->translatedFormat('d F Y') }}
</div>

    {{-- BUTTON --}}
<a href="{{ route('admin.items.index') }}" class="btn-dashboard">
    ← Kembali ke Daftar Item
</a>
</div>

@endsection
