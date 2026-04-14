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

        // 🔥 hitung jumlah buku yang masih dipinjam / pending
        $jumlahPinjam = PinjamBuku::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'dipinjam'])
            ->count();

        return view('pages.anggota.buku.pinjambuku', compact('buku', 'jumlahPinjam'));
    }

    // 🔹 Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // 🔥 CEK BATAS MAKSIMAL (3 BUKU)
        $jumlahPinjam = PinjamBuku::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'dipinjam'])
            ->count();

        if ($jumlahPinjam >= 3) {
            return redirect()->back()
                ->with('error', 'Maksimal peminjaman 3 buku, silakan kembalikan salah satu terlebih dahulu');
        }

        // 🔹 ambil buku (lebih aman pakai firstOrFail)
        $buku = Buku::where('judul', $request->judul)->first();

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        // 🔹 cek stok
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        // 🔹 simpan peminjaman
        PinjamBuku::create([
            'user_id' => Auth::id(),
            'nama' => Auth::user()->name,
            'judul' => $request->judul,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'pending', // tetap pending kalau pakai ACC petugas
        ]);

        // 🔹 kurangi stok
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil, menunggu konfirmasi');
    }

    // 🔹 Data peminjaman user login
    public function index()
    {
        $data = PinjamBuku::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.anggota.peminjaman.index', compact('data'));
    }
}
