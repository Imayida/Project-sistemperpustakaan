<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas\PinjamBuku;
use App\Models\User;
use App\Models\Anggota\Buku;

class PinjamBukuController extends Controller
{
    /**
     * Tampilkan data peminjaman
     */
    public function index()
    {
        $peminjaman = PinjamBuku::with(['user', 'buku'])
            ->latest()
            ->get();

        return view('pages.petugas.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $users = User::all();
        $buku  = Buku::all();

        return view('pages.petugas.peminjaman.create', compact('users', 'buku'));
    }

    /**
     * Simpan data (request peminjaman)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'judul' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        PinjamBuku::create([
            'nama' => $request->user_id,
            'judul' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'pending', // 🔥 ubah jadi pending
        ]);

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Menunggu persetujuan petugas');
    }

    /**
     * ✅ Setujui peminjaman
     */
    public function setujui($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);

        $pinjam->update([
            'status' => 'dipinjam'
        ]);

        return back()->with('success', 'Peminjaman disetujui');
    }

    /**
     * ❌ Tolak peminjaman
     */
    public function tolak($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);

        $pinjam->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    /**
     * 🔄 Kembalikan buku
     */
    public function kembalikan($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);

        $pinjam->update([
            'status' => 'dikembalikan' // 🔥 jangan pakai "tersedia"
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan');
    }

    /**
     * Hapus
     */
    public function destroy($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);
        $pinjam->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
