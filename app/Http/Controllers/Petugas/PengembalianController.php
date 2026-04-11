<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Pengembalian;
use App\Models\Petugas\Buku;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::with(['user','buku','peminjaman'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.petugas.pengembalian.index', compact('data'));
    }

    // SETUJUI (SUDAH TAMBAH STOK)
    public function setujui($id)
    {
        $data = Pengembalian::with('peminjaman')->findOrFail($id);

        // biar tidak double klik
        if ($data->status != 'dikembalikan') {

            // UPDATE PENGEMBALIAN
            $data->update([
                'status' => 'dikembalikan'
            ]);

            // UPDATE PEMINJAMAN
            if ($data->peminjaman) {

                $data->peminjaman->update([
                    'status' => 'dikembalikan'
                ]);

                // TAMBAH STOK
                $buku = Buku::where('judul', $data->peminjaman->judul)->first();

                if ($buku) {
                    $buku->increment('stok');
                }
            }
        }

        return back()->with('success', 'Pengembalian disetujui & stok bertambah');
    }

    // TOLAK
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

    // SELESAI
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

    // DELETE
    public function destroy($id)
    {
        $data = Pengembalian::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
