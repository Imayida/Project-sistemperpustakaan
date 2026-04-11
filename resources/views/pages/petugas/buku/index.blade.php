@extends('layouts.petugas.app')

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

    .btn-group-custom {
        display: flex;
        gap: 5px;
        margin-top: 10px;
    }

    .btn-group-custom .btn {
        flex: 1;
        font-size: 12px;
        padding: 5px;
        border-radius: 6px;
    }
</style>

<!-- HEADER (TIDAK DIUBAH) -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="fw-bold" style="color:#60a5fa;">Koleksi Buku</h4>

    <form method="GET" action="{{ route('petugas.buku.index') }}" style="width:280px;">
        <input type="text"
               name="keyword"
               class="form-control"
               placeholder="Search..."
               value="{{ request('keyword') }}">
    </form>

    <a href="{{ route('petugas.buku.create') }}" class="btn btn-primary btn-sm">
        Tambah Buku +
    </a>
</div>

<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman koleksi buku
</p>

<!-- DATA BUKU (SUDAH DIPERBAIKI) -->
<div class="row g-4">

@forelse($buku as $item)
    <div class="col-custom d-flex">
        <div class="card border-0 text-center p-3 buku-card w-100">

            <!-- GAMBAR -->
            <div class="img-wrapper">
                <img src="{{ $item->gambar_url }}" class="buku-img">
            </div>

            <!-- JUDUL -->
            <div class="judul-buku">
                {{ $item->judul }}
            </div>

            <!-- BUTTON -->
            <div class="btn-group-custom">

                <a href="{{ route('petugas.buku.show', $item->id) }}"
                   class="btn btn-info text-white">
                    Detail
                </a>

                <a href="{{ route('petugas.buku.edit', $item->id) }}"
                   class="btn btn-warning text-white">
                    Edit
                </a>

                <form action="{{ route('petugas.buku.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-danger"
                        onclick="return confirm('Yakin hapus buku?')">
                        Delete
                    </button>
                </form>

            </div>

        </div>
    </div>
@empty
    <div class="col-12 text-center">
        <p>Data buku tidak ada</p>
    </div>
@endforelse

</div>

<!-- TOMBOL -->
<div class="d-flex justify-content-end mt-4">
    @if(!$showAll)
        <a href="{{ route('petugas.buku.index', [
            'show_all' => 1,
            'keyword' => request('keyword')
        ]) }}" class="btn btn-outline-primary">
            Lihat Semua
        </a>
    @else
        <a href="{{ route('petugas.buku.index') }}"
           class="btn btn-outline-secondary">
            Tampilkan Sedikit
        </a>
    @endif
</div>

@endsection
