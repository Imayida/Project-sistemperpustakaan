@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-2">
     <h4 class="fw-bold" style="color:#60a5fa;">Data Pengembalian</h4>

    <a href="{{ route('pengembalian.create.simple') }}"
   class="btn btn-primary btn-sm">
   Kembalikan Buku +
</a>
</div>

<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman data pengembalian
</p>


<div class="card shadow-sm border-0 rounded-4 p-3">

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
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                    <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>

                    <td>
                        @php
    $status = strtolower(trim($item->status));
@endphp

@if($status == 'pending')
    <span class="badge bg-warning text-white px-3 py-1">
        Pending
    </span>

@elseif($status == 'dikembalikan')
    <span class="badge bg-success px-3 py-1">
        Dikembalikan
    </span>

@elseif($status == 'ditolak')
    <span class="badge bg-danger px-3 py-1">
        Ditolak
    </span>

@else
    <span class="badge bg-secondary px-3 py-1">
        {{ $item->status }}
    </span>
@endif
                    </td>


                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Belum ada data
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
