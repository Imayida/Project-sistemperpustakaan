@extends('layouts.petugas.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container">
    <h4 class="mb-4 fw-semibold">Dashboard</h4>

    <!-- CARD -->
    <div class="row mb-4">
        <!-- Total Anggota -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted small">Total Anggota</h6>
                        <h3 class="fw-bold">{{ $totalAnggota ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
            </div>
        </div>

        <!-- Total Denda -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted small">Total Denda</h6>
                        <h3 class="fw-bold">{{ $totalDenda ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-cash-stack fs-3"></i>
                </div>
            </div>
        </div>

        <!-- Total Buku -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted small">Total Buku</h6>
                        <h3 class="fw-bold">{{ $totalBuku ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-book fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔥 TABLE RAPI -->
    <div class="card shadow-sm border-0 rounded-4 p-3">
        <div class="table-responsive">
            <table class="table align-middle">

                <thead class="text-muted small" style="font-weight:500;">
                    <tr>
                        <th>NAMA</th>
                        <th>JUDUL BUKU</th>
                        <th>TANGGAL PINJAM</th>
                        <th>TANGGAL KEMBALI</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>DENDA</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody style="font-size:14px;">
                    <tr>
                        <td>Maya</td>
                        <td>Hujan</td>
                        <td>15-02-2026</td>
                        <td>15-02-2026</td>
                        <td>15-02-2026</td>
                        <td>Rp 8.000</td>

                        <td>
                            <span class="badge bg-success px-3 py-1">
                                Selesai
                            </span>
                        </td>

                        <!-- 🔥 AKSI RAPIH -->
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn btn-info btn-sm">
                                    Detail
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
