@extends('layouts.app')

@section('content')

<!-- Header halaman -->
<div class="d-flex justify-content-between align-items-center mb-2">
     <h4 class="fw-bold" style="color:#60a5fa;">Data Pengembalian</h4>

    <!-- Tombol menuju form pengembalian buku -->
    <a href="{{ route('pengembalian.create.simple') }}"
   class="btn btn-primary btn-sm">
   Kembalikan Buku +
</a>
</div>

<!-- Deskripsi halaman -->
<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman data pengembalian
</p>

<!-- Card utama -->
<div class="card shadow-sm border-0 rounded-4 p-3">

    <!-- Tabel data pengembalian -->
    <div class="table-responsive">
        <table class="table align-middle">

            <!-- Header tabel -->
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

            <!-- Isi tabel -->
            <tbody style="font-size:14px;">

                <!-- Perulangan data pengembalian -->
                @forelse($data as $item)
                <tr>

                    <!-- Nama anggota -->
                    <td>{{ $item->nama }}</td>

                    <!-- Judul buku -->
                    <td>{{ $item->judul }}</td>

                    <!-- Tanggal pinjam -->
                    <td>
                        {{ $item->tanggal_pinjam
                            ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y')
                            : '-' }}
                    </td>

                    <!-- Tanggal kembali -->
                    <td>
                        {{ $item->tanggal_kembali
                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y')
                            : '-' }}
                    </td>

                    <!-- Tanggal jatuh tempo -->
                    <td>
                        {{ $item->tanggal_jatuh_tempo
                            ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y')
                            : '-' }}
                    </td>

                    <!-- Denda -->
                    <td>
                        @if(($item->denda ?? 0) > 0)
                            <span class="text-danger fw-bold">
                                Rp {{ number_format($item->denda, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-muted">
                                Rp 0
                            </span>
                        @endif
                    </td>

                    <!-- Status pengembalian -->
                    <td>
                        @php
                            // Mengubah status menjadi huruf kecil agar mudah dicek
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

                <!-- Jika data kosong -->
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data pengembalian
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
