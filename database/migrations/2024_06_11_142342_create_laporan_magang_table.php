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
        Schema::create('laporan_magang', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id', 20);
            $table->unsignedBigInteger('pengajuan_magang_id');
            $table->unsignedBigInteger('data_magang_id');
            $table->unsignedBigInteger('data_bimbingan_id');
            $table->string('laporan_magang', 255)->nullable();
            $table->string('catatan', 255)->nullable();
            $table->enum('status_laporan', ['1', '0'])->default('0');

            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('pengajuan_magang_id')->references('id')->on('pengajuan_magang')->onDelete('cascade');
            $table->foreign('data_magang_id')->references('id')->on('data_magang')->onDelete('cascade');
            $table->foreign('data_bimbingan_id')->references('id')->on('data_bimbingan')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_magang');
    }
};
