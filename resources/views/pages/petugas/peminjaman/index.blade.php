@extends('layouts.petugas.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold" style="color:#60a5fa;">Data Peminjaman</h4>

        <div class="mx-auto" style="width:280px;">
            <input type="text" class="form-control" placeholder="Search..." style="border-radius:10px;">
        </div>
    </div>

    <p style="color:#6b7280; font-size:14px; margin-top:-10px;">
    Selamat datang di halaman data peminjaman
</p>

    <!-- Card -->
    <div class="card shadow-sm border-0 rounded-4 p-3">

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="text-muted" style="font-size:13px;">
                    <tr>
                        <th>NAMA</th>
                        <th>JUDUL BUKU</th>
                        <th>TANGGAL PINJAM</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody style="font-size:14px;">
                    @forelse ($peminjaman as $item)
                        <tr>

                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>

                            {{-- STATUS --}}
                            <td>
                                @php
                                    $status = strtolower(trim($item->status));
                                    $badge = 'secondary';

                                    if ($status == 'pending') $badge = 'warning';
                                    elseif ($status == 'dipinjam') $badge = 'primary';
                                    elseif ($status == 'ditolak') $badge = 'danger';
                                    elseif ($status == 'dikembalikan') $badge = 'success';

                                    // terlambat
                                    if ($item->tanggal_jatuh_tempo < now() && $status == 'dipinjam') {
                                        $status = 'Terlambat';
                                        $badge = 'danger';
                                    }

                                    $statusLabel = ucfirst($status);
                                @endphp

                                <span class="badge bg-{{ $badge }} px-3 py-1">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1 flex-wrap">

                                    {{-- PENDING --}}
                                    @if($status == 'pending')
                                        <form action="{{ route('petugas.peminjaman.setujui', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm"
                                                onclick="return confirm('Setujui peminjaman ini?')">
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('petugas.peminjaman.tolak', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Tolak peminjaman ini?')">
                                                Tolak
                                            </button>
                                        </form>

                                    {{-- DIPINJAM --}}
                                    @elseif($status == 'dipinjam')
                                        <span style="color: #0d6efd; font-style: italic; font-weight: 500; font-size: 13px;">
                                            Sudah Diproses
                                        </span>

                                    {{-- DITOLAK --}}
                                    @elseif($status == 'ditolak')
                                        <span style="color: #dc3545; font-style: italic; font-weight: 500; font-size: 13px;">
                                            Ditolak
                                        </span>

                                    {{-- DIKEMBALIKAN --}}
                                    @elseif($status == 'dikembalikan')
                                        <span class="badge bg-success px-3 py-1">Selesai</span>

                                    @endif
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum Ada Data
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
