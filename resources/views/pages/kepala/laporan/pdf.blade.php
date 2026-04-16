<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom:20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
        h3 { margin-bottom: 5px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Laporan Perpustakaan</h2>

@if($from && $to)
<p>Periode: {{ $from }} s/d {{ $to }}</p>
@endif

<!-- ================= PEMINJAMAN ================= -->
<h3>Data Peminjaman</h3>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Judul</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjaman as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_jatuh_tempo }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ================= PENGEMBALIAN ================= -->
<h3>Data Pengembalian</h3>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Judul</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Jatuh Tempo</th>
            <th>Denda</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengembalian as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_kembali }}</td>
            <td>{{ $item->tanggal_jatuh_tempo }}</td>
            <td>Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ================= DATA DENDA ================= -->
<h3>Data Denda</h3>
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Judul</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Jatuh Tempo</th>
            <th>Denda</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dataDenda as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_kembali }}</td>
            <td>{{ $item->tanggal_jatuh_tempo }}</td>
            <td><strong>Rp {{ number_format($item->denda, 0, ',', '.') }}</strong></td>
            <td>{{ $item->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align:center;">Tidak ada data denda</td>
        </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
