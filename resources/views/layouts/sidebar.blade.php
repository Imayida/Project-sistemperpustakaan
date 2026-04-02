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
        <span class="badge-role">{{ auth()->user()->role ?? 'Anggota' }}</span>
    </div>

    <!-- Dashboard -->
    <a href="{{ url('/dashboard') }}"
       class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <!-- Buku -->
    <a href="{{ route('buku.index') }}"
       class="menu-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
        <i class="bi bi-book"></i> Buku
    </a>

    <!-- Peminjaman -->
    <a href="{{ route('peminjaman.index') }}"
       class="menu-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
        <i class="bi bi-journal-text"></i> Peminjaman
    </a>

    <!-- Pengembalian -->
    <a href="{{ route('pengembalian.index') }}"
       class="menu-item {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
        <i class="bi bi-arrow-repeat"></i> Pengembalian
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
