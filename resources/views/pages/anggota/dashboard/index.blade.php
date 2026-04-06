@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold" style="color:#60a5fa;">Dashboard Anggota</h4>

    <div class="mx-auto" style="width:280px;">
        <input type="text"
        id="search"
        class="form-control"
        placeholder="Search..."
        style="border-radius:10px;">
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle">

                <thead class="text-muted" style="font-size:13px;">
                    <tr>
                        <th>NAMA</th>
                        <th>JUDUL BUKU</th>
                        <th>TANGGAL PINJAM</th>
                        <th>TANGGAL JATUH TEMPO</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peminjaman as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>

                        <td>
                            @php
                                 $today = \Carbon\Carbon::now();
                                 $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                            @endphp

                            @if($item->status == 'pending')
                                <span class="badge bg-warning text-white px-3 py-1">Pending</span>

                            @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger px-3 py-1">Ditolak</span>

                            @elseif($item->status == 'dikembalikan')
                                <span class="badge bg-success px-3 py-1">Dikembalikan</span>

                            @elseif($item->status == 'dipinjam')

                                {{-- cek terlambat --}}
                                @if($jatuhTempo < $today)
                                    <span class="badge bg-danger px-3 py-1">Terlambat</span>
                                @else
                                    <span class="badge bg-primary px-3 py-1">Dipinjam</span>
                                 @endif

                            @else
                                <span class="badge bg-secondary px-3 py-1">-</span>
                             @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
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
    let rows = document.querySelectorAll('tbody tr');

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
