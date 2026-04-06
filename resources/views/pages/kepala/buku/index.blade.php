@extends('layouts.kepala.app')

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

    /* BUTTON */
    .btn-detail {
        padding: 6px 18px;
        font-size: 14px;
        border-radius: 7px;
        margin-top: 10px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold" style="color:#60a5fa;">Koleksi Buku</h4>
</div>

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

            <!--DETAIL -->
            <a href="{{ route('kepala.buku.detail', $item->id) }}"
                class="btn btn-primary w-100 btn-detail">
                Detail
            </a>

        </div>
    </div>
@empty
    <p class="text-center">Data buku tidak ada</p>
@endforelse

</div>

@endsection
