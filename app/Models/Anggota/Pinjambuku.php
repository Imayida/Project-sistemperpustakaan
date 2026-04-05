<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Anggota\Buku; // ✅ FIX DI SINI

class PinjamBuku extends Model
{
    protected $table = 'pinjam_buku';

    protected $fillable = [
    'nama',
    'judul',
    'tanggal_pinjam',
    'tanggal_jatuh_tempo',
    'status', // ✅ WAJIB ADA
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
