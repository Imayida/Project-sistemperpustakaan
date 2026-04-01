<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'nama',
        'judul',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_jatuh_tempo',
        'denda'
    ];
}
