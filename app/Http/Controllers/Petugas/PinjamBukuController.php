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
        $pinjam = PinjamBuku::with(['user', 'buku'])->latest()->get();

        return view('petugas.peminjaman.index', compact('pinjam'));
    }

    /**
     * Form tambah peminjaman
     */
    public function create()
    {
        $users = User::all();
        $buku  = Buku::all();

        return view('petugas.peminjaman.create', compact('users', 'buku'));
    }

    /**
     * Simpan peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        PinjamBuku::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    /**
     * Detail peminjaman
     */
    public function show($id)
    {
        $pinjam = PinjamBuku::with(['user', 'buku'])->findOrFail($id);

        return view('petugas.peminjaman.show', compact('pinjam'));
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);
        $users = User::all();
        $buku  = Buku::all();

        return view('petugas.peminjaman.edit', compact('pinjam', 'users', 'buku'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'status' => 'required'
        ]);

        $pinjam = PinjamBuku::findOrFail($id);

        $pinjam->update([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => $request->status,
        ]);

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);
        $pinjam->delete();

        return redirect()->route('petugas.peminjaman.index')
            ->with('success', 'Data berhasil dihapus');
    }

    /**
     * Kembalikan buku
     */
    public function kembalikan($id)
    {
        $pinjam = PinjamBuku::findOrFail($id);

        $pinjam->update([
            'status' => 'tersedia'
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
    }
}
