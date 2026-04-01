<div class="sidebar">

    <h5 class="fw-bold mb-4">Sistem Perpustakaan</h5>

    <!-- PROFILE -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/foto-saya.jpg') }}"
             class="rounded-circle mb-2"
             width="70"
             height="70"
             style="object-fit: cover;">
        <br>
        <span class="badge-role">{{ auth()->user()->role }}</span>
    </div>

    <!-- MENU -->
    <a href="{{ route('petugas.dashboard') }}"
       class="menu-item {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <a href="/petugas/buku"
       class="menu-item {{ request()->is('petugas/buku') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Data Buku
    </a>

    <a href="/petugas/peminjaman"
       class="menu-item {{ request()->is('petugas/peminjaman') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Data Peminjaman
    </a>

    <a href="/petugas/pengembalian"
       class="menu-item {{ request()->is('petugas/pengembalian') ? 'active' : '' }}">
        <i class="bi bi-arrow-repeat"></i> Data Pengembalian
    </a>

    <a href="/petugas/denda"
       class="menu-item {{ request()->is('petugas/denda') ? 'active' : '' }}">
        <i class="bi bi-cash"></i> Menerima Denda
    </a>

    <a href="/logout" class="menu-item text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>
