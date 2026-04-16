@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="fw-bold" style="color:#60a5fa;">Data Peminjaman</h4>
</div>

<!-- Deskripsi halaman -->
<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman data peminjaman
</p>

<!-- Card utama -->
<div class="card shadow-sm border-0 rounded-4 p-3">

    <!-- Tabel data peminjaman -->
    <div class="table-responsive">
        <table class="table align-middle">

            <!-- Header tabel -->
            <thead class="text-muted" style="font-size:13px;">
                <tr>
                    <th>NAMA</th>
                    <th>JUDUL BUKU</th>
                    <th>TANGGAL PINJAM</th>
                    <th>TANGGAL JATUH TEMPO</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <!-- Isi tabel -->
            <tbody style="font-size:14px;">

                <!-- Jika ada data -->
                @forelse($data as $item)
                <tr>

                    <!-- Nama anggota -->
                    <td>{{ $item->nama }}</td>

                    <!-- Judul buku -->
                    <td>{{ $item->judul }}</td>

                    <!-- Format tanggal pinjam -->
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>

                    <!-- Format tanggal jatuh tempo -->
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>

                    <!-- Status peminjaman -->
                    <td>
                        @php
                            // Ambil tanggal hari ini
                            $today = \Carbon\Carbon::now();

                            // Ambil tanggal jatuh tempo
                            $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);

                            // Ubah status menjadi huruf kecil agar mudah dicek
                            $status = strtolower(trim($item->status));

                            // Default badge dan label
                            $badge = 'secondary';
                            $label = ucfirst($status);

                            // Cek status
                            if($status == 'pending') {
                                $badge = 'warning';
                            } elseif($status == 'ditolak') {
                                $badge = 'danger';
                            } elseif($status == 'dikembalikan') {
                                $badge = 'success';
                            } elseif($status == 'dipinjam') {

                                // Jika sudah lewat jatuh tempo
                                if($jatuhTempo < $today) {
                                    $badge = 'danger';
                                    $label = 'Terlambat';
                                } else {
                                    $badge = 'primary';
                                    $label = 'Dipinjam';
                                }
                            }
                        @endphp

                        <!-- Badge status -->
                        <span class="badge bg-{{ $badge }} px-3 py-1">{{ $label }}</span>
                    </td>

                </tr>

                <!-- Jika tidak ada data -->
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada data peminjaman
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection
