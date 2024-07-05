<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_buatBarang', function (Blueprint $table) {
            $table->id('id_tb_buatBarang');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('harga_barang');
            $table->string('stok_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_buatBarang');
    }
};
