@extends('layouts.petugas.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold" style="color:#60a5fa;">Data Peminjaman</h4>

        <!-- SEARCH -->
        <div class="mx-auto" style="width:280px;">
            <input type="text"
                   id="search"
                   class="form-control"
                   placeholder="Search..."
                   style="border-radius:10px;">
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

                <tbody id="data-table" style="font-size:14px;">
                    @forelse ($peminjaman as $index => $item)
                        <tr class="data-row" data-index="{{ $index }}">

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

                                    if ($item->tanggal_jatuh_tempo < now() && $status == 'dipinjam') {
                                        $status = 'terlambat';
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

                                    @if($status == 'pending')
                                        <form action="{{ route('petugas.peminjaman.setujui', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('petugas.peminjaman.tolak', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                Tolak
                                            </button>
                                        </form>

                                    @elseif($status == 'dipinjam')
                                        <span class="text-primary" style="font-size:13px;">
                                            Sudah Diproses
                                        </span>

                                    @elseif($status == 'ditolak')
                                        <span class="text-danger" style="font-size:13px;">
                                            Ditolak
                                        </span>

                                    @elseif($status == 'dikembalikan')
                                        <span class="badge bg-success">Selesai</span>

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

        <!-- TOMBOL KE KANAN -->
        <div class="d-flex justify-content-end mt-3">
            <button id="toggleBtn" class="btn btn-outline-primary">
                Lihat Semua
            </button>
        </div>

    </div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const rows = document.querySelectorAll('.data-row');
    const toggleBtn = document.getElementById('toggleBtn');
    const search = document.getElementById('search');

    let showAll = false;

    // 🔥 tampil awal (4 data)
    function tampilAwal() {
        rows.forEach((row, index) => {
            row.style.display = index < 4 ? '' : 'none';
        });
    }

    tampilAwal();

    // 🔁 toggle lihat semua
    toggleBtn.addEventListener('click', function() {
        showAll = !showAll;

        if (showAll) {
            rows.forEach(row => row.style.display = '');
            toggleBtn.innerText = 'Tampilkan Sedikit';
        } else {
            tampilAwal();
            toggleBtn.innerText = 'Lihat Semua';
        }
    });

    // 🔍 search realtime
    search.addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();

        rows.forEach(function(row) {
            let text = row.innerText.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

});
</script>
@endsection
