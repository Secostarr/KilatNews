<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaturan_situs', function (Blueprint $table) {
            $table->integer('id_pengaturan')->primary()->autoIncrement();
            $table->string('nama_situs', 100);
            $table->string('logo', 255); // Perpanjang ke 255 karakter jika URL panjang
            $table->text('deskripsi_singkat');
            $table->string('kontak_email', 150);
            $table->json('social_media_links'); // Ubah dari 'role' ke 'social_media_links'
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_situs');
    }
};
