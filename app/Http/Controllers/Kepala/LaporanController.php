<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota\PinjamBuku;
use App\Models\Petugas\Pengembalian;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        // 🔹 Peminjaman
        $peminjaman = PinjamBuku::when($from && $to, function($query) use ($from, $to){
                $query->whereBetween('tanggal_pinjam', [$from, $to]);
            })
            ->latest()
            ->get();

        // 🔹 Pengembalian
        $pengembalian = Pengembalian::when($from && $to, function($query) use ($from, $to){
                $query->whereBetween('tanggal_kembali', [$from, $to]);
            })
            ->latest()
            ->get();

        return view('pages.kepala.laporan.index', compact(
            'peminjaman',
            'pengembalian',
            'from',
            'to'
        ));
    }
}
