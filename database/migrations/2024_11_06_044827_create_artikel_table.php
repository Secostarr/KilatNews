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
            $table->text('konten');
            $table->string('slug', 150)->unique();
            $table->dateTime('tanggal_publikasi');
        
            $table->integer('id_user');
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        
            $table->integer('id_kategori');
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori_berita')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_tag');
            $table->foreign('id_tag')
                ->references('id_tag')
                ->on('tag')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                  
            $table->string('media_utama', 255);
            $table->enum('status_publikasi', ['published', 'draft', 'archived']);
            $table->boolean('highlight')->default(false);
            $table->string('lokasi', 100)->nullable();
            $table->integer('viewer_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->boolean('trending')->default(false);
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
