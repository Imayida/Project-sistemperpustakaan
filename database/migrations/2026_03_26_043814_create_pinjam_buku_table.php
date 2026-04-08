<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pinjam_buku', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('judul');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_jatuh_tempo');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_buku');
    }
};
