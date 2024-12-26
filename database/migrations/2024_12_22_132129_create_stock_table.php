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
        Schema::create('stok_produk', function (Blueprint $table) {
            $table->id();
            $table->char('id_cabang', 4);
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_produk');
            $table->integer('jumlah_stok');
            $table->timestamp('last_updated')->nullable();

            $table->foreign('id_cabang')->references('id_cabang')->on('cabang')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
