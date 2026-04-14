<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // nama tabel
    protected $table = 'buku';

    // Kolom
    protected $fillable = [
    'judul',
    'pengarang',
    'penerbit',
    'tahun_terbit',
    'stok',
    'deskripsi',
    'gambar'
];

    /*
    |--------------------------------------------------------------------------
    | 🔥 ACCESSOR (URL GAMBAR)
    |--------------------------------------------------------------------------
    */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }

        // fallback kalau tidak ada gambar
        return asset('images/no-image.png');
    }
}
