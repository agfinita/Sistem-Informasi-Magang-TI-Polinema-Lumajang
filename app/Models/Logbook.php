<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    // Mendefinisikan tabel secara eksplisit
    protected $table    = 'logbook';

    protected $fillable = [
        'mahasiswa_id',
        'pengajuan_magang_id',
        'data_magang_id',
        'data_bimbingan_id',
        'tanggal_logbook',
        'jam_mulai',
        'jam_selesai',
        'kegiatan',
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
