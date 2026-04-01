<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('pages.anggota.buku.index', compact('buku'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.anggota.buku.detail', compact('buku'));
    }
}
