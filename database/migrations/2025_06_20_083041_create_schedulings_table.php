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
        Schema::create('schedulings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen');
            $table->string('kelas');
            $table->string('mata_kuliah');
            $table->date('tanggal_praktikum');
            $table->string('waktu_praktikum');
            $table->string('modul_praktikum')->nullable(); // simpan path file
            $table->text('tools_software');
            $table->timestamps();

            // Tambahkan constraint unique gabungan di bawah ini
            $table->unique(['tanggal_praktikum', 'waktu_praktikum']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedulings');
    }
};
