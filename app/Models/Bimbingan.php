<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'bimbingan';

    protected $fillable = [
        'mahasiswa_id',
        'pengajuan_magang_id',
        'data_magang_id',
        'data_bimbingan_id',
        'pertemuan',
        'tanggal',
        'pembahasan',
        'batas_waktu',
        'verifikasi_dosen'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pengajuanMagang() {
        return $this->belongsTo(PengajuanMagang::class);
    }

    public function dataMagang() {
        return $this->belongsTo(DataMagang::class);
    }

    public function dataBimbingan() {
        return $this->belongsTo(DataBimbingan::class);
    }
}
