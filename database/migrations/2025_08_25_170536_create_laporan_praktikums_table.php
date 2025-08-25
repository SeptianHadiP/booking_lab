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
        Schema::create('laporan_praktikum', function (Blueprint $table) {
            $table->id();
            $table->string('laporan_file'); // file laporan PDF/DOCX
            $table->string('kelas');        // nama kelas
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('nilai_file');   // file excel nilai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_praktikum');
    }
};
