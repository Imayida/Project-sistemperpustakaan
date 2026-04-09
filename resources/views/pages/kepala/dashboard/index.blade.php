@extends('layouts.kepala.app')

@section('content')

<style>
    body { background: #f5f7fb; }

    .title {
        margin-bottom: 30px;
    }

    .card-box {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: 0.3s;
        text-align: left;
    }

    .card-box:hover {
        transform: translateY(-3px);
    }

    .card-box small {
        color: #6b7280;
        font-size: 13px;
    }

    .card-box h4 {
        margin-top: 5px;
        font-weight: bold;
    }

    .welcome-box {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .welcome-box h5 {
        color: #60a5fa;
        font-weight: bold;
    }

    .welcome-box p {
        color: #6b7280;
        margin-top: 10px;
    }
</style>

<div class="title">
    <h4 class="fw-bold" style="color:#60a5fa;">
        Dashboard Kepala Perpustakaan
    </h4>
</div>

<div class="row mb-5">

    <!-- Total Anggota -->
    <div class="col-md-3">
        <div class="card-box d-flex justify-content-between align-items-center">
            <div>
                <small>Total Anggota</small>
                <h4>{{ $totalAnggota }}</h4>
            </div>
            <i class="bi bi-people fs-2 text-dark"></i>
        </div>
    </div>

    <!-- Total Buku -->
    <div class="col-md-3">
        <div class="card-box d-flex justify-content-between align-items-center">
            <div>
                <small>Total Buku</small>
                <h4>{{ $totalBuku }}</h4>
            </div>
            <i class="bi bi-book fs-2 text-dark"></i>
        </div>
    </div>

    <!-- Total Peminjaman -->
    <div class="col-md-3">
        <div class="card-box d-flex justify-content-between align-items-center">
            <div>
                <small>Total Peminjaman</small>
                <h4>{{ $totalPeminjaman }}</h4>
            </div>
            <i class="bi bi-journal-arrow-down fs-2 text-dark"></i>
        </div>
    </div>

    <!-- Total Dikembalikan -->
    <div class="col-md-3">
        <div class="card-box d-flex justify-content-between align-items-center">
            <div>
                <small>Total Dikembalikan</small>
                <h4>{{ $totalDikembalikan }}</h4>
            </div>
            <i class="bi bi-check-circle fs-2 text-dark"></i>
        </div>
    </div>

</div>

<div class="welcome-box">
    <h5>Selamat Datang</h5>
    <p>
        Selamat Datang Di Halaman Dashboard Kepala Perpustakaan.
    </p>
</div>

@endsection
