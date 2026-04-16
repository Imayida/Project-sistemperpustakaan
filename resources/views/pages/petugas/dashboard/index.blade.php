@extends('layouts.petugas.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="fw-bold" style="color:#60a5fa;">Dashboard Petugas</h4>

    <div class="mx-auto" style="width:280px;">
        <input type="text"
        id="search"
        class="form-control"
        placeholder="Search..."
        style="border-radius:10px;">
    </div>
</div>

<p style="color:#6b7280; font-size:14px; margin-top:-5px;">
    Selamat datang di halaman dashboard petugas
</p>

    <!-- CARD -->
    <div class="row mb-4">
        <!-- TOTAL ANGGOTA -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted small">Total Anggota</h6>
                        <h3 class="fw-bold">{{ $totalAnggota ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
            </div>
        </div>

        <!-- TOTAL DENDA -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted small">Total Denda</h6>
                        <h3 class="fw-bold">{{ $totalDenda ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-cash-stack fs-3"></i>
                </div>
            </div>
        </div>

        <!-- TOTAL BUKU -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted small">Total Buku</h6>
                        <h3 class="fw-bold">{{ $totalBuku ?? 0 }}</h3>
                    </div>
                    <i class="bi bi-book fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE DATA PEMINJAMAN -->
    <div class="card shadow-sm border-0 rounded-4 p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">

        </div>

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

                <tbody id="tableBody" style="font-size:14px;">

                    @forelse($peminjaman as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>

                        <!-- STATUS -->
                        <td>
                            @php
                                $today = \Carbon\Carbon::now();
                                $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                            @endphp

                            @if($item->status == 'pending')
                                <span class="badge bg-warning px-3 py-1">Pending</span>

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

                        <!-- AKSI DELETE -->
                        <td class="text-center">
                            <form action="{{ route('petugas.peminjaman.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada data peminjaman
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('search').addEventListener('keyup', function() {

    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tableBody tr');

    rows.forEach(function(row) {
        let nama = row.children[0].textContent.toLowerCase();

        if (nama.includes(keyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

});
</script>
@endsection
