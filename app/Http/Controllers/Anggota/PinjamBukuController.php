<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota\Buku;
use App\Models\Anggota\PinjamBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamBukuController extends Controller
{
    // 🔹 Form pinjam buku
    public function create($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.anggota.buku.pinjambuku', compact('buku'));
    }

    // 🔹 Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        // 🔹 ambil buku
        $buku = Buku::where('judul', $request->judul)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        // 🔹 cek stok
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        // 🔹 simpan peminjaman (pakai user login)
        PinjamBuku::create([
            'user_id' => Auth::id(), //penting
            'nama' => Auth::user()->name, // auto ambil nama user
            'judul' => $request->judul,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'pending',
        ]);

        // 🔹 kurangi stok
        $buku->stok -= 1;
        $buku->save();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    // 🔹 Tampilkan data peminjaman (HANYA MILIK USER LOGIN)
    public function index()
    {
        $data = PinjamBuku::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.anggota.peminjaman.index', compact('data'));
    }
}
