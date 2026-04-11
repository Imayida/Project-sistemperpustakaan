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
        border-radius: 12px;
        background: #fff;
        transition: 0.3s;
    }

    .buku-card:hover {
        transform: translateY(-3px);
    }

    .img-wrapper {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .buku-img {
        max-height: 140px;
        max-width: 100%;
        object-fit: contain;
    }

    .judul-buku {
        font-size: 13px;
        font-weight: 600;
        min-height: 40px;
        margin-top: 8px;
    }

    .btn-detail {
        padding: 6px 18px;
        font-size: 14px;
        border-radius: 7px;
        margin-top: 10px;
    }
</style>

<!-- HEADER (TIDAK DIUBAH) -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="fw-bold" style="color:#60a5fa;">Koleksi Buku</h4>

    <!-- SEARCH (TIDAK DIUBAH) -->
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

<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman koleksi buku
</p>

<!-- DATA (SUDAH DIPERBAIKI) -->
<div class="row g-4">

@forelse($buku as $b)
    <div class="col-custom d-flex">
        <div class="card border-0 text-center p-3 buku-card w-100">

            <!-- GAMBAR -->
            <div class="img-wrapper">
                <img src="{{ $b->gambar ? asset('storage/'.$b->gambar) : asset('images/no-image.png') }}"
                     class="buku-img">
            </div>

            <!-- JUDUL -->
            <div class="judul-buku">
                {{ $b->judul }}
            </div>

            <!-- BUTTON -->
            <a href="{{ route('buku.detail', $b->id) }}"
               class="btn btn-primary w-100 btn-detail">
                Detail
            </a>

        </div>
    </div>
@empty
    <div class="col-12 text-center">
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
