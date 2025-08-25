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
        Schema::create('certificate_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_path');

            // Posisi nama
            $table->enum('name_x_type', ['center', 'custom'])->default('center');
            $table->integer('name_x')->nullable();
            $table->enum('name_y_type', ['center', 'custom'])->default('center');
            $table->integer('name_y')->nullable();

            // Posisi skor
            $table->enum('score_x_type', ['center', 'custom'])->default('center');
            $table->integer('score_x')->nullable();
            $table->enum('score_y_type', ['center', 'custom'])->default('center');
            $table->integer('score_y')->nullable();

            // Posisi deskripsi
            $table->enum('desc_x_type', ['center', 'custom'])->default('center');
            $table->integer('desc_x')->nullable();
            $table->enum('desc_y_type', ['center', 'custom'])->default('center');
            $table->integer('desc_y')->nullable();

            // Warna font
            $table->string('font_color', 7)->nullable(); // Format: #RRGGBB

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_templates');
    }
};
