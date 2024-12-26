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
        Schema::create('stok_changes', function (Blueprint $table) {
            $table->id();
            $table->char('id_cabang', 4);
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('user_id');
            // $table->enum('movement_type', ['in', 'out']);
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_perubahan');

            $table->foreign('id_cabang')->references('id_cabang')->on('cabang')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users_store')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_changes');
    }
};
