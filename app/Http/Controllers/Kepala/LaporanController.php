<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota\PinjamBuku;
use App\Models\Petugas\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // ================= HALAMAN LAPORAN =================
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $peminjaman = PinjamBuku::when($from && $to, function($query) use ($from, $to){
                $query->whereBetween('tanggal_pinjam', [$from, $to]);
            })
            ->latest()
            ->get();

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

    // ================= EXPORT PDF =================
    public function exportPdf(Request $request)
{
    $from = $request->from;
    $to = $request->to;

    $peminjaman = PinjamBuku::when($from, function ($q) use ($from) {
            return $q->whereDate('tanggal_pinjam', '>=', $from);
        })
        ->when($to, function ($q) use ($to) {
            return $q->whereDate('tanggal_pinjam', '<=', $to);
        })
        ->get();

    $pengembalian = Pengembalian::when($from, function ($q) use ($from) {
            return $q->whereDate('tanggal_kembali', '>=', $from);
        })
        ->when($to, function ($q) use ($to) {
            return $q->whereDate('tanggal_kembali', '<=', $to);
        })
        ->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.kepala.laporan.pdf', compact('peminjaman', 'pengembalian', 'from', 'to'));

    return $pdf->download('laporan.pdf');
}
}
