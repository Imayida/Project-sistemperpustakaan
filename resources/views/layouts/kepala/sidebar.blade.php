<div class="sidebar">

    <!-- JUDUL -->
    <h5 class="fw-bold mb-4 text-center" style="color:#60a5fa;">Sistem Perpustakaan</h5>

    <!-- PROFILE -->
    <div class="text-center mb-4">
        <img src="{{ asset('storage/buku.jpg') }}"
             class="rounded-circle mb-2"
             width="70"
             height="70"
             style="object-fit: cover;">
        <br>
        <span class="badge-role">Kepala Perpustakaan</span>
    </div>

    <!-- MENU -->

    <!-- DASHBOARD -->
    <a href="{{ route('kepala.dashboard') }}"
       class="menu-item {{ request()->routeIs('kepala.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <!-- DATA BUKU -->
    <a href="{{ route('kepala.buku.index') }}"
       class="menu-item {{ request()->routeIs('kepala.buku.*') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Data Buku
    </a>

    <!-- LAPORAN -->
    <a href="{{ route('kepala.laporan') }}"
       class="menu-item {{ request()->routeIs('kepala.laporan') ? 'active' : '' }}">
        <i class="bi bi-file-text"></i> Laporan
    </a>

    <!-- LOGOUT -->
    <form action="{{ route('logout') }}" method="POST" id="logout-form">
        @csrf
    </form>

    <a href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="menu-item">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>
