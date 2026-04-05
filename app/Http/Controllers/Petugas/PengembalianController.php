<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::with(['user','buku'])->get();

        return view('pages.petugas.pengembalian.index', compact('data'));
    }
    public function setujui($id)
{
    $data = \App\Models\Petugas\Pengembalian::findOrFail($id);

    $data->update([
        'status' => 'selesai'
    ]);

    return back()->with('success', 'Pengembalian disetujui');
}

public function tolak($id)
{
    $data = \App\Models\Petugas\Pengembalian::findOrFail($id);

    $data->update([
        'status' => 'ditolak'
    ]);

    return back()->with('success', 'Pengembalian ditolak');
}
}


