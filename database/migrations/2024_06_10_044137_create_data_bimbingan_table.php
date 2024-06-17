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
        Schema::create('data_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id', 20);
            $table->unsignedBigInteger('data_magang_id');
            $table->unsignedBigInteger('dosen_pembimbing_id')->nullable();

            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('data_magang_id')->references('id')->on('data_magang')->onDelete('cascade');
            $table->foreign('dosen_pembimbing_id')->references('id')->on('dosen')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bimbingan');
    }
};
