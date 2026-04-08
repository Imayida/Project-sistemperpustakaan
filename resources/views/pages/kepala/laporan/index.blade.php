@extends('layouts.kepala.app')

@section('content')

<h4 class="fw-bold mb-3" style="color:#60a5fa;">Laporan Peminjaman & Pengembalian</h4>

<!-- FILTER -->
<form method="GET" class="row g-2 mb-4">
    <div class="col-md-3">
        <input type="date" name="from" value="{{ $from }}" class="form-control">
    </div>
    <div class="col-md-3">
        <input type="date" name="to" value="{{ $to }}" class="form-control">
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary">Filter</button>
        <a href="{{ route('kepala.laporan') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

<!-- 🔥 PEMINJAMAN -->
<div class="card mb-4 shadow-sm border-0 rounded-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3">Data Peminjaman</h6>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($peminjaman as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- 🔥 PENGEMBALIAN -->
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3">Data Pengembalian</h6>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pengembalian as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($item->denda) }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
