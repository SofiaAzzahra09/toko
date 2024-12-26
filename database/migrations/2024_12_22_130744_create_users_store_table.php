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
        Schema::create('users_store', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user');
            $table->string('peran');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('id_cabang', 4)->nullable();
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang')->onDelete('cascade');
            $table->rememberToken();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_store');
    }
};
