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

        /* BIAR SAMA KAYA KEPALA */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
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

        /*  BIAR JUDUL RAPI */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .btn-group-custom {
        display: flex;
        gap: 6px;
        margin-top: 10px;
        justify-content: center;
    }

    /* FIX FORM DELETE */
    .btn-group-custom form {
        margin: 0;
    }

    /*  UKURAN TOMBOL SAMA */
    .btn-group-custom .btn {
        width: 36px;
        height: 36px;
        padding: 0;
        font-size: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;
    }
</style>

<!-- HEADER -->
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

<!-- ALERT -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- DATA BUKU -->
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

                <!-- DETAIL -->
                <a href="{{ route('petugas.buku.show', $item->id) }}"
                   class="btn btn-info text-white"
                   title="Detail">
                    <i class="bi bi-eye"></i>
                </a>

                <!-- EDIT -->
                <a href="{{ route('petugas.buku.edit', $item->id) }}"
                   class="btn btn-warning text-white"
                   title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>

                @php
    $sedangDipinjam = \App\Models\Petugas\PinjamBuku::where('judul', $item->judul)
                        ->where('status', 'dipinjam')
                        ->exists();
@endphp

                <!-- DELETE -->
                <form action="{{ route('petugas.buku.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger"
                        title="Delete"
                        onclick="
                            @if($sedangDipinjam)
                                alert('Buku sedang dipinjam, tidak bisa dihapus!');
                                return false;
                            @else
                                return confirm('Yakin hapus buku?');
                            @endif
                        ">
                        <i class="bi bi-trash"></i>
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
