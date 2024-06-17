<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'email',
        'telp',
        'alamat',
        'role',
        'is_active',
    ];

    protected $attributes = [
        'role'      => 'Mahasiswa',
        'is_active' => 1
    ];

    public function pengajuanMagang() {
        return $this->hasMany(PengajuanMagang::class);
    }

    public function dataMagang() {
        return $this->hasOne(DataMagang::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

    public function dataBimbingan() {
        return $this->hasOne(DataBimbingan::class);
    }

    public function logbook() {
        return $this->hasMany(Logbook::class);
    }

    public function bimbingan() {
        return $this->hasMany(Bimbingan::class);
    }

    public function laporanMagang() {
        return $this->hasOne(LaporanMagang::class);
    }
}
