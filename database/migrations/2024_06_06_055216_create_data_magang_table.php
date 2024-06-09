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
        Schema::create('data_magang', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id', 20);
            $table->unsignedBigInteger('pengajuan_magang_id');
            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('pengajuan_magang_id')->references('id')->on('pengajuan_magang')->onDelete('cascade');
            $table->string('kategori_magang', 50)->nullable(false);
            $table->string('periode', 20)->nullable(false);
            $table->date('tanggal_mulai')->nullable(false);
            $table->date('tanggal_selesai')->nullable(false);
            $table->enum('status_magang', ['selesai', 'sedang magang', 'belum dimulai', 'dihentikan'])->default('belum dimulai');
            $table->string('files', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_magang');
    }
};
