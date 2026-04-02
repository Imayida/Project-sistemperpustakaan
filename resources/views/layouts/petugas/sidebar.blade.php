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
            @if(auth()->check())
                <span class="badge-role">{{ auth()->user()->role }}</span>
            @else
                <span class="badge-role">Petugas</span>
            @endif
    </div>

    <!-- MENU -->
    <a href="{{ route('petugas.dashboard') }}"
       class="menu-item {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <!-- DATA BUKU -->
    <a href="{{ route('petugas.buku.index') }}"
       class="menu-item {{ request()->is('petugas/buku*') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Data Buku
    </a>

    <!-- DATA ANGGOTA (DITAMBAHKAN) -->
    <a href="{{ route('petugas.anggota.index') }}"
       class="menu-item {{ request()->is('petugas/anggota*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Data Anggota
    </a>

    <!-- DATA PEMINJAMAN -->
    <a href="/petugas/peminjaman"
       class="menu-item {{ request()->is('petugas/peminjaman') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Data Peminjaman
    </a>

    <!-- DATA PENGEMBALIAN -->
    <a href="/petugas/pengembalian"
       class="menu-item {{ request()->is('petugas/pengembalian') ? 'active' : '' }}">
        <i class="bi bi-arrow-repeat"></i> Data Pengembalian
    </a>

    <!-- DENDA -->
    <a href="/petugas/denda"
       class="menu-item {{ request()->is('petugas/denda') ? 'active' : '' }}">
        <i class="bi bi-cash"></i> Menerima Denda
    </a>

    <!-- LOGOUT -->
<form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
</form>

<a href="#"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
   class="menu-item {{ request()->is('logout') ? 'active' : '' }}">
    <i class="bi bi-box-arrow-right"></i> Logout
</a>

</div>
