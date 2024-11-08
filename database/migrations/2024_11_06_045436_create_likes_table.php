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
        Schema::create('likes', function (Blueprint $table) {
            $table->integer('id_likes')->primary()->autoIncrement();
            $table->integer('id_artikel');
            $table->foreign('id_artikel')
                  ->references('id_artikel')
                  ->on('artikel')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        
            $table->integer('id_user');
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->enum('role', ['user']); // Misalnya jika ingin menandakan peran dari pengguna yang memberi like
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
