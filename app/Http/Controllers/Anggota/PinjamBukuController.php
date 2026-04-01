<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota\Buku;
use App\Models\Anggota\PinjamBuku;
use Illuminate\Http\Request;

class PinjamBukuController extends Controller
{
    public function create($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.anggota.buku.pinjambuku', compact('buku'));
    }

    
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'judul' => 'required',
        'tanggal_pinjam' => 'required',
        'tanggal_jatuh_tempo' => 'required'
    ]);

    // 🔹 ambil buku berdasarkan judul
    $buku = Buku::where('judul', $request->judul)->first();

    // 🔹 cek stok
    if ($buku->stok <= 0) {
        return redirect()->back()->with('error', 'Stok buku habis');
    }

    // 🔹 simpan data peminjaman
    \App\Models\Anggota\PinjamBuku::create([
        'nama' => $request->nama,
        'judul' => $request->judul,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
    ]);

    // 🔹 kurangi stok
    $buku->stok -= 1;
    $buku->save();

    return redirect()->route('peminjaman.index')
        ->with('success', 'Buku berhasil dipinjam');
}

   public function index()
{
    $data = PinjamBuku::latest()->get();
    return view('pages.anggota.peminjaman.index', compact('data'));
}
}
