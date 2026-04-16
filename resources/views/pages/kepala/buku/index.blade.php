@extends('layouts.kepala.app')

@section('content')

<style>
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

<!-- HEADER + SEARCH -->
<div class="d-flex align-items-center mb-2">

    <!-- KIRI -->
    <div>
        <h4 class="fw-bold" style="color:#60a5fa;">Koleksi Buku</h4>
    </div>

    <!-- SEARCH TENGAH -->
    <div class="mx-auto" style="width:280px;">
        <form method="GET" action="{{ route('kepala.buku.index') }}">
            <input type="text"
                   name="keyword"
                   class="form-control"
                   placeholder="Search..."
                   value="{{ request('keyword') }}">
        </form>
    </div>

    <!-- KANAN (kosong biar balance) -->
    <div style="width:120px;"></div>

</div>

<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman koleksi buku
</p>

<!-- DATA BUKU -->
<div class="row g-4">

@forelse($buku as $item)
    <div class="col-custom d-flex">
        <div class="card border-0 text-center p-3 buku-card w-100">

            <div class="img-wrapper">
                <img src="{{ $item->gambar
                        ? asset('storage/' . $item->gambar)
                        : asset('images/no-image.png') }}"
                     class="buku-img">
            </div>

            <div class="judul-buku">
                {{ $item->judul }}
            </div>

            <a href="{{ route('kepala.buku.detail', $item->id) }}"
               class="btn btn-primary w-100 btn-detail">
                Detail
            </a>

        </div>
    </div>
@empty
    <div class="col-12 text-center">
        <p>Data buku tidak ditemukan</p>
    </div>
@endforelse

</div>

<!-- TOMBOL LIHAT SEMUA DAN TAMPILKAN SEDIKIT -->
<div class="d-flex justify-content-end mt-4">

    @if(!$showAll)
        <a href="{{ route('kepala.buku.index', [
            'show_all' => 1,
            'keyword' => request('keyword')
        ]) }}" class="btn btn-outline-primary">
            Lihat Semua
        </a>
    @else
        <a href="{{ route('kepala.buku.index') }}"
           class="btn btn-outline-secondary">
            Tampilkan Sedikit
        </a>
    @endif

</div>

@endsection
