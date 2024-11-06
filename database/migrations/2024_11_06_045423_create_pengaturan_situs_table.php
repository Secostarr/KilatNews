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
            $table->string('logo', 225);
            $table->text('deskripsi_singkat');
            $table->string('kontak_email',150);
            $table->json('role', ['link']);
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
