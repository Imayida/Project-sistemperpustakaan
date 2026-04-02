@extends('layouts.petugas.app')

@section('content')

<style>
    .card-custom {
        border-radius: 12px;
        background: #fff;
    }

    .search-box {
        width: 260px;
    }

    table th {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
    }

    table td {
        font-size: 14px;
    }

    .badge-status {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        color: #fff;
    }

    .dipinjam {
        background: #c6ff00;
        color: #000;
    }

    .terlambat {
        background: #ff0000;
    }

    .tersedia {
        background: #198754;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold">Data Peminjaman</h5>

    <input type="text" id="search" class="form-control search-box" placeholder="Search...">
</div>

<div class="card shadow-sm border-0 card-custom p-4">

    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pinjam as $p)
                <tr class="data-item"
                    data-search="{{ strtolower(($p->user->name ?? '') . ' ' . ($p->buku->judul ?? '')) }}">

                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->buku->judul ?? '-' }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_jatuh_tempo }}</td>

                    <td>
                        @if($p->status == 'dipinjam')
                            <span class="badge-status dipinjam">Dipinjam</span>
                        @elseif($p->status == 'terlambat')
                            <span class="badge-status terlambat">Terlambat</span>
                        @else
                            <span class="badge-status tersedia">Tersedia</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const search = document.getElementById('search');
    const items = document.querySelectorAll('.data-item');

    if (!search) return;

    search.addEventListener('input', function() {
        let keyword = this.value.toLowerCase();

        items.forEach(function(item) {
            let text = item.dataset.search || '';

            if (text.includes(keyword)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

});
</script>
@endsection
