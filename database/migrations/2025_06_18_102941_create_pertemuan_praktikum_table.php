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
        Schema::create('pertemuan_praktikum', function (Blueprint $table) {
            $table->id();
            $table->string('pertemuan');
            $table->foreignId('mata_kuliah_praktikum_id')->constrained('mata_kuliah_praktikum')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuan_praktikum');
    }
};
