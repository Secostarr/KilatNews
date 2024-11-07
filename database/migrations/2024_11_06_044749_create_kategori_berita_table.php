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
        Schema::create('kategori_berita', function (Blueprint $table) {
            $table->integer('id_kategori')->primary()->autoIncrement();
            $table->string('nama_kategori', 100);
            $table->text('deskripsi');
            $table->string('slug', 100)->unique();
            $table->integer('urutan');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_berita');
    }
};