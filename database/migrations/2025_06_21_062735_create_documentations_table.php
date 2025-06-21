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
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduling_id');
            $table->foreign('scheduling_id')->references('id')->on('schedulings')->onDelete('cascade');

            $table->string('nama');
            $table->string('foto_1');
            $table->string('foto_2');
            $table->string('absen_1')->nullable();
            $table->string('absen_2')->nullable();
            $table->timestamp('tanggal_upload')->nullable(); // Tambahan opsional
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
