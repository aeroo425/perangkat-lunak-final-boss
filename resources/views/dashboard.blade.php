<h2>Selamat datang, {{ auth()->user()->name }}</h2>

<p>Anda dapat mengupload laporan barang hilang/ditemukan, melihat laporan, mengedit profil, dan lainnya.</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
