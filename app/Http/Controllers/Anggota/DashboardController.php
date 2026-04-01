<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota\PinjamBuku;

class DashboardController extends Controller
{


public function index()
{
    $peminjaman = PinjamBuku::latest()->take(5)->get();

    return view('pages.anggota.dashboard.index', compact('peminjaman'));
}
}
