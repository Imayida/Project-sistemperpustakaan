<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('judul');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');

            // tambahan kolom baru
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->integer('denda')->default(0);

            $table->string('status')->default('Dikembalikan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
};
