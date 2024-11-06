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
        Schema::create('artikel_tag', function (Blueprint $table) {
            $table->integer('id_artikel');
            $table->foreign('id_artikel')
                  ->references('id_artikel')
                  ->on('artikel')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_tag');
            $table->foreign('id_tag')
                  ->references('id_tag')
                  ->on('tag')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_tag');
    }
};
