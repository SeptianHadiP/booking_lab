<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedulings', function (Blueprint $table) {
            $table->id();

            // Relasi ke user (dosen)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('mata_kuliah_id')->nullable();
            $table->unsignedBigInteger('lab_id')->nullable();

            // Relasi ke semester
            $table->unsignedBigInteger('semester_id')->nullable();
            // after('lab_id');
            // jika ingin menambahkan foreign key
            // $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            // Hapus kolom nama_dosen
            $table->date('tanggal_praktikum');
            $table->string('waktu_praktikum');
            $table->string('modul_praktikum')->nullable(); // simpan path file
            $table->string('judul_praktikum')->nullable();
            $table->text('deskripsi');
            $table->timestamps();

            // Constraint unique gabungan
            $table->unique(['tanggal_praktikum', 'waktu_praktikum', 'lab_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedulings');
    }
};
