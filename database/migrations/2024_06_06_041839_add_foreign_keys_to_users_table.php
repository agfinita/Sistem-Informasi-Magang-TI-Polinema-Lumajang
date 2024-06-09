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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan foreign key untuk masing-masing kolom
            $table->unsignedBigInteger('admin_id')->nullable()->after('id');
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->after('admin_id');
            $table->unsignedBigInteger('dosen_id')->nullable()->after('mahasiswa_id');

            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('set null');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('set null');
            $table->foreign('dosen_id')->references('id')->on('dosen')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['mahasiswa_id']);
            $table->dropForeign(['dosen_id']);

            $table->dropColumn(['admin_id']);
            $table->dropColumn(['mahasiswa_id']);
            $table->dropColumn(['dosen_id']);
        });
    }
};
