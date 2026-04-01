@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold mb-0">Data Pengembalian</h4>

    <a href="{{ route('pengembalian.create') }}" class="btn btn-primary btn-sm">
        Kembalikan Buku +
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-3">

    <div class="table-responsive">
        <table class="table align-middle">

            <thead class="text-muted small" style="font-weight:500;">
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

            <tbody style="font-size:14px;">
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                    <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>

                    <td>
                        <span class="badge bg-success px-3 py-1">
                            {{ $item->status }}
                        </span>
                    </td>

                    <!-- 🔥 AKSI DIRAPIHIN -->
                    <td>
                        <div class="d-flex justify-content-center gap-1">

                            <a href="#" class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <form action="{{ route('pengembalian.delete', $item->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>

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

</div>

@endsection
