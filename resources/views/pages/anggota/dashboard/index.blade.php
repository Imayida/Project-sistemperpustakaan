@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="fw-bold" style="color:#60a5fa;">Dashboard Anggota</h4>
</div>

<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman dashboard anggota
</p>

<div class="row mb-4 justify-content-center">

    <!-- Total Peminjaman -->
    <div class="col-md-4 col-6">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">

                <div class="text-start">
                    <small class="text-muted d-block" style="font-size:13px;">
                        Total Peminjaman
                    </small>
                    <h4 class="fw-bold mb-0">{{ $totalPinjam }}</h4>
                </div>

                <i class="bi bi-journal-arrow-down fs-3 text-dark"></i>

            </div>
        </div>
    </div>

    <!-- Total Dikembalikan -->
    <div class="col-md-4 col-6">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">

                <div class="text-start">
                    <small class="text-muted d-block" style="font-size:13px;">
                        Total Dikembalikan
                    </small>
                    <h4 class="fw-bold mb-0">{{ $totalKembali }}</h4>
                </div>

                <i class="bi bi-check-circle fs-3 text-dark"></i>

            </div>
        </div>
    </div>

    <!-- Total Buku -->
    <div class="col-md-4 col-6">
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">

                <div class="text-start">
                    <small class="text-muted d-block" style="font-size:13px;">
                        Total Buku
                    </small>
                    <h4 class="fw-bold mb-0">{{ $totalBuku }}</h4>
                </div>

                <i class="bi bi-book fs-3 text-dark"></i>

            </div>
        </div>
    </div>

</div>

<div class="card border-0 shadow-sm rounded-4 p-3">
    <div class="table-responsive">
        <table class="table align-middle">

            <thead class="text-muted" style="font-size:13px;">
                <tr>
                    <th>NAMA</th>
                    <th>JUDUL BUKU</th>
                    <th>TANGGAL PINJAM</th>
                    <th>TANGGAL JATUH TEMPO</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <tbody style="font-size:14px;">
                @forelse($peminjaman as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                    <td>
                        @php
                            $today = \Carbon\Carbon::now();
                            $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                        @endphp

                        @if($item->status == 'pending')
                            <span class="badge bg-warning text-white px-3 py-1">Pending</span>
                        @elseif($item->status == 'ditolak')
                            <span class="badge bg-danger px-3 py-1">Ditolak</span>
                        @elseif($item->status == 'dikembalikan')
                            <span class="badge bg-success px-3 py-1">Dikembalikan</span>
                        @elseif($item->status == 'dipinjam')
                            @if($jatuhTempo < $today)
                                <span class="badge bg-danger px-3 py-1">Terlambat</span>
                            @else
                                <span class="badge bg-primary px-3 py-1">Dipinjam</span>
                            @endif
                        @else
                            <span class="badge bg-secondary px-3 py-1">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection
