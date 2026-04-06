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
                        <th>AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($peminjaman as $item)
                        <tr>

                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->judul}}</td>

                            <td>{{ $item->tanggal_pinjam }}</td>
                            <td>{{ $item->tanggal_jatuh_tempo }}</td>

                            {{-- STATUS --}}
                            <td>
                                @php
                                    $status = ucfirst($item->status);
                                    $badge = 'secondary';

                                    if ($item->status == 'pending') {
                                     $badge = 'warning';
                                    }
                                    elseif ($item->status == 'dipinjam') {
                                        $badge = 'primary';
                                    } elseif ($item->status == 'ditolak') {
                                        $badge = 'danger';
                                    } elseif ($item->status == 'dikembalikan') {
                                        $badge = 'success';
                                    }

                                    // terlambat
                                    if ($item->tanggal_jatuh_tempo < now() && $item->status == 'dipinjam') {
                                        $status = 'Terlambat';
                                        $badge = 'danger';
                                    }
                                @endphp

                                <span class="badge bg-{{ $badge }}">
                                    {{ $status }}
                                </span>
                            </td>

                            {{-- AKSI --}}
         <td>

    {{-- PENDING --}}
    @if($item->status == 'pending')

        <form action="{{ route('petugas.peminjaman.setujui', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-sm btn-success"
                onclick="return confirm('Setujui peminjaman ini?')">
                Setujui
            </button>
        </form>

        <form action="{{ route('petugas.peminjaman.tolak', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-sm btn-danger"
                onclick="return confirm('Tolak peminjaman ini?')">
                Tolak
            </button>
        </form>

    {{-- SUDAH DISETUJUI --}}
    @elseif($item->status == 'dipinjam')
        <span style="color: #0d6efd; font-style: italic; font-weight: 500; font-size: 13px;">
    Sudah Diproses
</span>

    {{--  DITOLAK --}}
    @elseif($item->status == 'ditolak')
       <span style="color: #dc3545; font-style: italic; font-weight: 500; font-size: 12px;">
    Ditolak
</span>

    {{-- SELESAI --}}
    @elseif($item->status == 'dikembalikan')
        <span class="badge bg-success">Selesai</span>

    @endif

</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Data tidak tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
