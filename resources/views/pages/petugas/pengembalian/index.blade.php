@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold" style="color:#60a5fa;">Data Pengembalian</h4>

        <div class="mx-auto" style="width:280px;">
            <input type="text"
                   id="search"
                   class="form-control"
                   placeholder="Search..."
                   style="border-radius:10px;">
        </div>
    </div>

    <p style="color:#6b7280; font-size:14px; margin-top:-10px;">
        Selamat datang di halaman data pengembalian
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
                        <th>TANGGAL KEMBALI</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>DENDA</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody id="data-table" style="font-size:14px;">
                    @forelse($data as $index => $item)
                    <tr class="data-row" data-index="{{ $index }}">

                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>{{ $item->tanggal_kembali }}</td>
                        <td>{{ $item->tanggal_jatuh_tempo }}</td>

                        <td>
                            {{ number_format($item->denda ?? 0, 0, ',', '.') }}
                        </td>

                        <!-- STATUS -->
                        <td>
                            @php $status = strtolower(trim($item->status)); @endphp

                            @if($status == 'pending')
                                <span class="badge bg-warning text-white px-3 py-1">Pending</span>
                            @elseif($status == 'dikembalikan')
                                <span class="badge bg-success px-3 py-1">Dikembalikan</span>
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

                                    <form action="{{ route('petugas.pengembalian.setujui', $item->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Setujui</button>
                                    </form>

                                    <form action="{{ route('petugas.pengembalian.tolak', $item->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </form>

                                @elseif($status == 'dikembalikan')

                                    <form action="{{ route('petugas.pengembalian.selesai', $item->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Selesai</button>
                                    </form>

                                    <form action="{{ route('petugas.pengembalian.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
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

        <!-- TOMBOL -->
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

    // 🔍 search sederhana
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
