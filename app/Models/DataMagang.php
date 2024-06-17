<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMagang extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'data_magang';

    protected $fillable = [
        'mahasiswa_id',
        'pengajuan_magang_id',
        'kategori_magang',
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_magang',
        'files'
    ];

    protected $attributes   = [
        'status_magang'   => 'belum dimulai',
    ];

    public function pengajuanMagang() {
                                                        // foreign key di tabel data magang, yang mengacu pada tabel pengajuan magang
        return $this->belongsTo(PengajuanMagang::class, 'pengajuan_magang_id', 'id');
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim');
    }

    public function dataBimbingan() {
        return $this->hasMany(DataBimbingan::class, 'data_magang_id');
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
