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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laprak_id');
            $table->unsignedBigInteger('template_id');
            $table->timestamps();

            $table->foreign('laprak_id')->references('id')->on('laporan_praktikum')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('certificate_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
