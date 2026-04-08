<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Buku;
use App\Models\Petugas\PinjamBuku;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalBuku = Buku::count();
        $totalPeminjaman = PinjamBuku::count();


$totalTerlambat = PinjamBuku::where('tanggal_jatuh_tempo', '<', Carbon::now())
    ->count();

        return view('pages.kepala.dashboard.index', compact(
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'totalTerlambat'
        ));
    }
}
