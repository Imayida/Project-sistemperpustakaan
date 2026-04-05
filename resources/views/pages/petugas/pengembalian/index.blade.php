@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Data Pengembalian</h4>

        <div class="mx-auto" style="width:280px;">
            <input type="text"
                   id="search"
                   class="form-control"
                   placeholder="Search..."
                   style="border-radius:10px;">
        </div>
    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0 rounded-4 p-3">

        <div class="table-responsive">
            <table class="table align-middle">

                <thead class="text-muted" style="font-size:13px;">
                    <tr>
                        <th>NAMA</th>
                        <th>JUDUL BUKU</th>
                        <th>TANGGAL PINJAM</th>
                        <th>TANGGAL KEMBALI</th>
                        <th>JATUH TEMPO</th>
                        <th>DENDA</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
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

                        <td>
                            Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                        </td>

                        <!-- STATUS -->
                        <td>
                            @php
                                $status = strtolower(trim($item->status));
                            @endphp

                            @if($status == 'pending')
                                <span class="badge bg-warning text-dark px-3 py-1">Pending</span>
                            @elseif($status == 'selesai')
                                <span class="badge bg-success px-3 py-1">Selesai</span>
                            @elseif($status == 'ditolak')
                                <span class="badge bg-danger px-3 py-1">Ditolak</span>
                            @else
                                <span class="badge bg-secondary px-3 py-1">{{ $item->status }}</span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td>
                            <div class="d-flex justify-content-center gap-1">

                                @if($status == 'pending')

                                <!-- SETUJUI -->
                                <form action="{{ route('petugas.pengembalian.setujui', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        Setujui
                                    </button>
                                </form>

                                <!-- TOLAK -->
                                <form action="{{ route('petugas.pengembalian.tolak', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        Tolak
                                    </button>
                                </form>

                                @else
                                    <span class="text-muted">-</span>
                                @endif

                            </div>
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

</div>

@endsection
