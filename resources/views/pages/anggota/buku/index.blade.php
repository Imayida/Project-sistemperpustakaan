@extends('layouts.app')

@section('content')

<style>
    .search-box { width: 280px; }

    .col-custom { width: 20%; }

    @media (max-width: 992px) {
        .col-custom { width: 33.33%; }
    }

    @media (max-width: 576px) {
        .col-custom { width: 50%; }
    }

    .buku-card {
        height: 100%;
        max-width: 180px;
        margin: auto;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .img-wrapper {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .buku-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    .btn-toggle {
        border-radius: 20px;
        padding: 6px 20px;
    }
</style>

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold" style="color:#60a5fa;">Koleksi Buku</h4>

    <!-- SEARCH -->
    <form method="GET" action="{{ route('buku.index') }}"
          class="mx-auto search-box">
        <input type="text"
               name="keyword"
               class="form-control"
               placeholder="Search..."
               value="{{ request('keyword') }}"
               style="border-radius:10px;">
    </form>
</div>

<p style="color:#6b7280; font-size:14px; margin-top:-10px;">
    Selamat datang di halaman koleksi buku
</p>

<!-- DATA -->
<div class="row g-4">

@forelse($buku as $b)
    <div class="col-custom">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">

            <!-- GAMBAR -->
            <div class="img-wrapper">
                <img src="{{ $b->gambar ? asset('storage/'.$b->gambar) : asset('images/no-image.png') }}"
                     class="buku-img">
            </div>

            <!-- JUDUL -->
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">
                {{ $b->judul }}
            </h6>

            <!-- BUTTON -->
            <a href="{{ route('buku.detail', $b->id) }}"
               class="btn btn-primary btn-sm">
                Detail
            </a>

        </div>
    </div>
@empty
    <div class="text-center">
        <p>Tidak ada buku tersedia</p>
    </div>
@endforelse

</div>

<!-- TOMBOL -->
<div class="d-flex justify-content-end mt-4">
    @if(!$showAll)
        <a href="{{ route('buku.index', [
            'show_all' => 1,
            'keyword' => request('keyword')
        ]) }}"
          class="btn btn-outline-primary btn-sm">
            Lihat Semua
        </a>
    @else
        <a href="{{ route('buku.index') }}"
           class="btn btn-outline-secondary">
            Tampilkan Sedikit
        </a>
    @endif
</div>

@endsection
