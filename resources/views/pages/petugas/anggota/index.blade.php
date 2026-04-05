@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Data Anggota</h4>

    
</div>

    <!-- CARD -->
    <div class="card shadow-sm border-0 rounded-4 p-3">

        <div class="table-responsive">
            <table class="table align-middle">

                <thead class="text-muted small" style="font-weight:500;">
                    <tr>
                        <th width="70" class="text-center">NO</th>
                        <th style="padding-left:20px;">NAMA</th>
                        <th>EMAIL</th>
                        <th class="text-center" width="120">AKSI</th>
                    </tr>
                </thead>

                <tbody style="font-size:14px;">
                    @forelse ($anggota as $key => $item)
                    <tr style="height:60px;">
                        <td class="text-center fw-semibold">
                            {{ $key + 1 }}
                        </td>

                        <td style="padding-left:20px;">
                            {{ $item->name }}
                        </td>

                        <td>
                            {{ $item->email }}
                        </td>

                        <td>
                            <div class="d-flex justify-content-center gap-1">

                                <form action="{{ route('petugas.anggota.delete', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin mau hapus?')">
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
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection
