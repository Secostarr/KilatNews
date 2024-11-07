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
        Schema::create('menu', function (Blueprint $table) {
            $table->integer('id_menu')->primary()->autoIncrement();
            $table->string('name', 100);
            $table->string('url', 255);
            $table->integer('id_parent')->nullable(); // Allows null for top-level menus
            $table->integer('order');
            $table->enum('status', ['aktif', 'tidak aktif']); // Changed from `role` to `status` with actual enum values
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
