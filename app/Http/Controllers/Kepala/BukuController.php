<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Kepala\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('pages.kepala.buku.index', compact('buku'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.kepala.buku.detail', compact('buku'));
    }
}
