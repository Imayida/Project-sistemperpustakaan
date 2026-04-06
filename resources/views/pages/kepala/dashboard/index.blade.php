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
        text-align: left; /* 🔥 FIX */
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
</style>

<div class="title">
    <h4 class="fw-bold" style="color:#60a5fa;">Dashboard Kepala Perpustakaan</h4>
</div>

<div class="row mb-5">

    <div class="col-md-3">
        <div class="card-box">
            <small>Total Anggota</small>
            <h4>234</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box">
            <small>Total Buku</small>
            <h4>456</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box">
            <small>Total Peminjaman</small>
            <h4>120</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box">
            <small>Total Terlambat</small>
            <h4>25</h4>
        </div>
    </div>

</div>

@endsection
