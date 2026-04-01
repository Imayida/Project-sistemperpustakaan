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
            <thead>
                <tr class="text-muted small">
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
        $today = date('Y-m-d');
    @endphp

    @if($item->tanggal_jatuh_tempo < $today)
        <span class="badge bg-danger">Terlambat</span>

    @elseif($item->tanggal_pinjam <= $today)
        <span class="badge bg-warning text-dark">Dipinjam</span>

    @else
        <span class="badge bg-success">Tersedia</span>
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

        if (nama.includes(keyword)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

});
</script>
@endsection
