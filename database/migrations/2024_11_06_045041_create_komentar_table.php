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
        Schema::create('komentar', function (Blueprint $table) {
            $table->integer('id_komentar')->primary()->autoIncrement();
            $table->integer('id_artikel');
            $table->foreign('id_artikel')
                  ->references('id_artikel')
                  ->on('artikel')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_users');
            $table->foreign('id_users')
                  ->references('id_users')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->text('isi_komentar');
            $table->dateTime('tanggal_komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
