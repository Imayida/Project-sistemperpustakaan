<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // Nama tabel di database
    protected $table = 'buku';

    // Kolom yang boleh diisi
    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok',
        'gambar',
        'deskripsi'
    ];
}
