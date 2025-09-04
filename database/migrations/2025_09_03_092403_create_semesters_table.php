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
        // Schema::create('semesters', function (Blueprint $table) {
        //     // ID langsung custom, contoh: 20251, 20252
        //     $table->unsignedBigInteger('id')->primary();
        //     $table->string('name'); // contoh: 2025/2026 Ganjil
        //     $table->date('start_date');
        //     $table->date('end_date');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('semesters');
    }
};
