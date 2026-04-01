<div class="sidebar">

    <h5 class="fw-bold mb-4">Sistem Perpustakaan</h5>

    <div class="text-center mb-4">
        <img src="{{ asset('images/foto-saya.jpg') }}"
             class="rounded-circle mb-2"
             width="70"
             height="70"
             style="object-fit: cover;">
        <br>
        <span class="badge-role">Anggota</span>
    </div>

    <a href="{{ url('/dashboard') }}" class="menu-item">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <a href="{{ route('buku.index') }}" class="menu-item">
        <i class="bi bi-book"></i> Buku
    </a>

    <a href="{{ route('peminjaman.index') }}" class="menu-item">
        <i class="bi bi-journal-text"></i> Peminjaman
    </a>

    <a href="/anggota/pengembalian" class="menu-item">
    <i class="bi bi-arrow-repeat"></i> Pengembalian
</a>

    <a href="#" class="menu-item text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>
