@extends('layouts.petugas.app')

@section('content')

<style>
    .col-custom {
        width: 20%;
    }

    @media (max-width: 992px) {
        .col-custom { width: 33.33%; }
    }

    @media (max-width: 576px) {
        .col-custom { width: 50%; }
    }

    /* CARD */
    .buku-card {
        height: 100%;
        border-radius: 12px;
        background: #fff;
        transition: 0.3s;
    }

    .buku-card:hover {
        transform: translateY(-5px);
    }

    /* WRAPPER GAMBAR */
    .img-wrapper {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* GAMBAR (FIX SESUAI ANGGOTA) */
    .buku-img {
        max-height: 140px;
        max-width: 100%;
        object-fit: contain; /* biar tidak kepotong */
        border-radius: 0; /* hilangkan lengkung */
    }

    /* BUTTON */
    .btn-action {
        width: 60px;
        height: 28px;
        font-size: 11px;
        padding: 0;
        border-radius: 4px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-wrapper {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: auto;
    }

    .btn-wrapper form {
        width: 60px;
        height: 28px;
        margin: 0;
    }

    .btn-wrapper form button {
        width: 100%;
        height: 100%;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Data Buku</h4>

    <form method="GET" action="{{ route('petugas.buku.index') }}" style="width:280px;">
        <input type="text" name="keyword" class="form-control" placeholder="Search...">
    </form>

    <a href="{{ route('petugas.buku.create') }}" class="btn btn-primary btn-sm">
        Tambah Buku +
    </a>
</div>

<div class="row g-4">

@forelse($buku as $item)
    <div class="col-custom d-flex">
        <div class="card shadow-sm border-0 text-center p-3 buku-card w-100">

            <!-- Gambar -->
            <div class="img-wrapper">
                <img src="{{ $item->gambar_url }}" class="buku-img">
            </div>

            <!-- Judul -->
            <small class="mt-2 fw-semibold d-block" style="min-height:40px;">
                {{ $item->judul }}
            </small>

            <!-- Tombol -->
            <div class="btn-wrapper">

                <!-- DETAIL -->
                <a href="{{ route('petugas.buku.show', $item->id) }}"
                   class="btn btn-info btn-sm btn-action text-white">
                    Detail
                </a>

                <!-- DELETE -->
                <form action="{{ route('petugas.buku.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-danger btn-sm btn-action"
                        onclick="return confirm('Yakin hapus buku?')">
                        Delete
                    </button>
                </form>

                <!-- EDIT -->
                <a href="{{ route('petugas.buku.edit', $item->id) }}"
                   class="btn btn-warning btn-sm btn-action text-white">
                    Edit
                </a>

            </div>

        </div>
    </div>
@empty
    <p class="text-center">Data buku tidak ada</p>
@endforelse

</div>

@endsection
