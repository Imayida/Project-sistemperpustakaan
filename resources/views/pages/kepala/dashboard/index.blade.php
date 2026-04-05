@extends('layouts.kepala.app')

@section('content')

<style>
    body { background: #f5f7fb; }

    .card-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    table {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 12px;
    }
</style>

<h4 class="mb-4">Dashboard</h4>

<!-- CARD -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card-box">
            <small>Total Anggota</small>
            <h4>234</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box">
            <small>Total Denda</small>
            <h4>456</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box">
            <small>Total Buku</small>
            <h4>456</h4>
        </div>
    </div>

</div>

<!-- TABEL -->
<div class="card-box">

    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Jatuh Tempo</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Maya</td>
                <td>Hujan</td>
                <td>15-02-2026</td>
                <td>15-02-2026</td>
                <td>15-02-2026</td>
                <td>8000</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                    <button class="btn btn-primary btn-sm">Detail</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>

            <tr>
                <td>Rama</td>
                <td>Sejarah Indonesia</td>
                <td>15-02-2026</td>
                <td>15-02-2026</td>
                <td>15-02-2026</td>
                <td>8000</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                    <button class="btn btn-primary btn-sm">Detail</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>

</div>

@endsection
