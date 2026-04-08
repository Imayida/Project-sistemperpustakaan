<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota\PinjamBuku;
use App\Models\Petugas\Pengembalian;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    // INDEX
    public function index()
    {
        $data = Pengembalian::where('nama', Auth::user()->name)
                ->latest()
                ->get();

        return view('pages.anggota.pengembalian.index', compact('data'));
    }

    // FORM CREATE
    public function create()
    {
        $peminjaman = PinjamBuku::where('nama', Auth::user()->name)
                        ->where('status', 'dipinjam')
                        ->get();

        return view('pages.anggota.pengembalian.create', compact('peminjaman'));
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'pinjam_buku_id' => 'required',
            'tanggal_kembali' => 'required|date',
        ]);

        $pinjam = PinjamBuku::findOrFail($request->pinjam_buku_id);

        // hitung denda
        $denda = 0;
        if ($request->tanggal_kembali > $pinjam->tanggal_jatuh_tempo) {
            $selisih = (strtotime($request->tanggal_kembali) - strtotime($pinjam->tanggal_jatuh_tempo)) / 86400;
            $denda = ceil($selisih) * 1000;
        }

        // ✅ simpan pengembalian (status pending)
        Pengembalian::create([
            'pinjam_buku_id' => $pinjam->id,
            'nama' => Auth::user()->name,
            'judul' => $pinjam->judul,
            'tanggal_pinjam' => $pinjam->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'tanggal_jatuh_tempo' => $pinjam->tanggal_jatuh_tempo,
            'denda' => $denda,
            'status' => 'pending'
        ]);

        // ❌ HAPUS bagian ini (biar tidak langsung dikembalikan)
        // $pinjam->update([
        //     'status' => 'dikembalikan'
        // ]);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil dikirim, menunggu konfirmasi petugas');
    }
}
