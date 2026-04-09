<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::with(['user','buku'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.petugas.pengembalian.index', compact('data'));
    }
    public function setujui($id)
{
    $data = Pengembalian::with('peminjaman')->findOrFail($id);

    // pengembalian
    $data->update([
        'status' => 'dikembalikan'
    ]);

    // peminjaman
    if ($data->peminjaman) {
        $data->peminjaman->update([
            'status' => 'dikembalikan'
        ]);
    }

    return back()->with('success', 'Pengembalian disetujui');
}

public function tolak($id)
{
    $data = Pengembalian::with('peminjaman')->findOrFail($id);

    $data->update([
        'status' => 'ditolak'
    ]);

    if ($data->peminjaman) {
        $data->peminjaman->update([
            'status' => 'dipinjam'
        ]);
    }

    return back()->with('success', 'Pengembalian ditolak');
}
public function selesai($id)
{
    $data = Pengembalian::with('peminjaman')->findOrFail($id);

    $data->update([
        'status' => 'selesai'
    ]);

    if ($data->peminjaman) {
        $data->peminjaman->update([
            'status' => 'selesai'
        ]);
    }

    return back()->with('success', 'Pengembalian selesai');
}
public function destroy($id)
{
    $data = \App\Models\Petugas\Pengembalian::findOrFail($id);
    $data->delete();

    return back()->with('success', 'Data berhasil dihapus');
}
}


