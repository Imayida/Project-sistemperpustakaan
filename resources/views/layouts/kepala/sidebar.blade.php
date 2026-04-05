<div class="sidebar">

    <h5 class="fw-bold mb-4 text-center">Sistem Perpustakaan</h5>

    <!-- PROFILE -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/foto-saya.jpg') }}"
             class="rounded-circle mb-2"
             width="70"
             height="70"
             style="object-fit: cover;">
        <br>

        <!-- LANGSUNG KEPALA -->
        <span class="badge-role">Kepala Perpustakaan</span>
    </div>

    <!-- MENU -->

    <!-- Dashboard -->
    <a href="{{ route('kepala.dashboard') }}"
       class="menu-item {{ request()->is('kepala/dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <!-- Data Buku -->
    <a href="{{ route('kepala.buku.index') }}"
       class="menu-item {{ request()->is('kepala/buku*') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Data Buku
    </a>

    <!-- Laporan -->
    <a href="{{ route('kepala.laporan') }}"
       class="menu-item {{ request()->is('kepala/laporan') ? 'active' : '' }}">
        <i class="bi bi-file-text"></i> Laporan
    </a>

    <!-- LOGOUT -->
    <form action="{{ route('logout') }}" method="POST" id="logout-form">
        @csrf
    </form>

    <a href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="menu-item text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>
