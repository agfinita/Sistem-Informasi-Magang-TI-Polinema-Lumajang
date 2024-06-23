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
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id', 20);
            $table->unsignedBigInteger('pengajuan_magang_id');
            $table->unsignedBigInteger('data_magang_id');
            $table->unsignedBigInteger('data_bimbingan_id')->nullable();
            $table->integer('pertemuan')->nullable(false);
            $table->date('tanggal');
            $table->string('pembahasan');
            $table->date('batas_waktu');
            $table->enum('verifikasi_dosen', ['1', '0'])->default('0');

            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('pengajuan_magang_id')->references('id')->on('pengajuan_magang')->onDelete('cascade');
            $table->foreign('data_magang_id')->references('id')->on('data_magang')->onDelete('cascade');
            $table->foreign('data_bimbingan_id')->references('id')->on('data_bimbingan')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan');
    }
};
