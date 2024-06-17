<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBimbingan extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'data_bimbingan';

    protected $fillable = [
        'mahasiswa_id',
        'data_magang_id',
        'dosen_pembimbing_id'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim');
    }

    public function dataMagang() {
                                                    // foreign key di tabel data bimbingan, yang mengacu pada tabel data magang
        return $this->belongsTo(DataMagang::class, 'data_magang_id');
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id', 'id');
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
