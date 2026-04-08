@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold" style="color:#60a5fa;">Data Peminjaman</h4>

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
                </tr>
            </thead>

            <tbody style="font-size:14px;">
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
                            $status = strtolower(trim($item->status));
                            $badge = 'secondary';
                            $label = ucfirst($status);

                            if($status == 'pending') $badge = 'warning';
                            elseif($status == 'ditolak') $badge = 'danger';
                            elseif($status == 'dikembalikan') $badge = 'success';
                            elseif($status == 'dipinjam') {
                                if($jatuhTempo < $today) {
                                    $badge = 'danger';
                                    $label = 'Terlambat';
                                } else {
                                    $badge = 'primary';
                                    $label = 'Dipinjam';
                                }
                            }
                        @endphp

                        <span class="badge bg-{{ $badge }} px-3 py-1">{{ $label }}</span>
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
