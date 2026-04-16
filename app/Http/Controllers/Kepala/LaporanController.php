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

        // DATA PEMINJAMAN
        $peminjaman = PinjamBuku::when($from, function ($q) use ($from) {
                return $q->whereDate('tanggal_pinjam', '>=', $from);
            })
            ->when($to, function ($q) use ($to) {
                return $q->whereDate('tanggal_pinjam', '<=', $to);
            })
            ->latest()
            ->get();

        // DATA PENGEMBALIAN
        $pengembalian = Pengembalian::when($from, function ($q) use ($from) {
                return $q->whereDate('tanggal_kembali', '>=', $from);
            })
            ->when($to, function ($q) use ($to) {
                return $q->whereDate('tanggal_kembali', '<=', $to);
            })
            ->latest()
            ->get();

        // ✅ FILTER DATA DENDA
        $dataDenda = $pengembalian->filter(function ($item) {
            return ($item->denda ?? 0) > 0;
        });

        // ✅ (OPSIONAL) TOTAL DENDA
        $totalDenda = $dataDenda->sum('denda');

        // GENERATE PDF
        $pdf = Pdf::loadView(
            'pages.kepala.laporan.pdf',
            compact(
                'peminjaman',
                'pengembalian',
                'dataDenda',   // WAJIB
                'totalDenda',  // opsional
                'from',
                'to'
            )
        );

        return $pdf->download('laporan.pdf');
    }
}
