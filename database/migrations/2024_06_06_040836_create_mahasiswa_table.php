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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique()->nullable(false);
            $table->string('nama', 100)->nullable(false);
            $table->string('kelas', 10)->nullable(false);
            $table->string('jurusan', 50)->nullable(false);
            $table->string('email', 100)->unique()->nullable();
            $table->char('telp', 15)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->enum('role', ['Mahasiswa', 'Admin', 'Dosen'] )->default('Mahasiswa');
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
