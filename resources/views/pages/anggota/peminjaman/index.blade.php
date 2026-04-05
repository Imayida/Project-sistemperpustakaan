@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Data Peminjaman</h4>

    <div class="mx-auto" style="width:280px;">
        <input type="text"
               id="search"
               class="form-control"
               placeholder="Search..."
               style="border-radius:10px;">
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

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
                @foreach($data as $item)
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

                        {{-- 🔥 PRIORITAS STATUS DATABASE --}}
                        @if($item->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>

                        @elseif($item->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>

                        @elseif($item->status == 'dikembalikan')
                            <span class="badge bg-success">Dikembalikan</span>

                        @elseif($item->status == 'dipinjam')

                            {{-- 🔥 CEK TERLAMBAT --}}
                            @if($jatuhTempo < $today)
                                <span class="badge bg-danger">Terlambat</span>
                            @else
                                <span class="badge bg-primary">Dipinjam</span>
                            @endif

                        @else
                            <span class="badge bg-secondary">-</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

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
        let judul = row.children[1].textContent.toLowerCase();

        if (nama.includes(keyword) || judul.includes(keyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

});
</script>
@endsection
