<?php

namespace App\Models\Kepala;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku'; // SAMA dengan petugas

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok',
        'deskripsi',
        'gambar'
    ];
}
