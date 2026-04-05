<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Petugas\Buku;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'nama',
        'judul',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_jatuh_tempo',
        'denda',
        'status',
        'petugas_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
