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
        Schema::create('artikel', function (Blueprint $table) {
            $table->integer('id_artikel')->primary()->autoIncrement();
            $table->string('judul', 150);
            $table->text('kontent');
            $table->string('slug', 150);
            $table->dateTime('tanggal publikasi');
            $table->integer('id_users');
            $table->foreign('id_users')
                  ->references('id_users')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_kategori');
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->string('media_utama', 225);
            $table->enum('role', ['status_publikasi']);
            $table->boolean('highlight');
            $table->string('lokasi', 100);
            $table->integer('viewer_count');
            $table->boolean('trending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
