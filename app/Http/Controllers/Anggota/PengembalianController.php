<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::latest()->get();

        return view('pages.anggota.pengembalian.index', compact('data'));
    }

    public function destroy($id)
    {
        $data = Pengembalian::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function create()
{
    return view('pages.anggota.pengembalian.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'judul' => 'required',
        'tanggal_pinjam' => 'required',
        'tanggal_kembali' => 'required',
        'tanggal_jatuh_tempo' => 'required',
        'denda' => 'required'
    ]);

    \App\Models\Anggota\Pengembalian::create([
        'nama' => $request->nama,
        'judul' => $request->judul,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        'denda' => $request->denda,
        'status' => 'Selesai'
    ]);

    return redirect()->route('pengembalian.index')
        ->with('success', 'Buku berhasil dikembalikan');
}


}
