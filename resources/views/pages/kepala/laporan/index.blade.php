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

<!-- ================= PEMINJAMAN ================= -->
<div class="card mb-4 shadow-sm border-0 rounded-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3" style="color:#60a5fa;">Data Peminjaman</h6>

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
                    @php
                        $status = strtolower(trim($item->status));
                    @endphp
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>

                        <td>
                            @if($status == 'pending')
                                <span class="badge bg-warning px-3 py-1">Pending</span>
                            @elseif($status == 'ditolak')
                                <span class="badge bg-danger px-3 py-1">Ditolak</span>
                            @elseif($status == 'dikembalikan')
                                <span class="badge bg-success px-3 py-1">Dikembalikan</span>
                            @elseif($status == 'dipinjam')
                                <span class="badge bg-primary px-3 py-1">Dipinjam</span>
                            @else
                                <span class="badge bg-secondary px-3 py-1">{{ $item->status }}</span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Tidak ada data peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- ================= PENGEMBALIAN ================= -->
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3" style="color:#60a5fa;">Data Pengembalian</h6>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="text-muted" style="font-size:13px;">
                    <tr>
                        <th>NAMA</th>
                        <th>JUDUL BUKU</th>
                        <th>TANGGAL PINJAM</th>
                        <th>TANGGAL KEMBALI</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>DENDA</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody style="font-size:14px;">
                    @forelse($pengembalian as $item)
                    @php
                        $status = strtolower(trim($item->status));
                    @endphp
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                        <td>
                            {{ $item->tanggal_jatuh_tempo
                                ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y')
                                : '-' }}
                        </td>
                        <td> {{ number_format($item->denda ?? 0, 0, ',', '.') }}</td>

                        <td>
                            @if($status == 'pending')
                                <span class="badge bg-warning px-3 py-1">Pending</span>
                            @elseif($status == 'dikembalikan')
                                <span class="badge bg-success px-3 py-1">Dikembalikan</span>
                            @elseif($status == 'ditolak')
                                <span class="badge bg-danger px-3 py-1">Ditolak</span>
                            @elseif($status == 'selesai')
                                <span class="badge bg-primary px-3 py-1">Selesai</span>
                            @else
                                <span class="badge bg-secondary px-3 py-1">{{ $item->status }}</span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Tidak ada data pengembalian
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
