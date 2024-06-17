<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMagang extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara ekplisit
    protected $table   = 'laporan_magang';

    protected $fillable = [
        'mahasiswa_id',
        'data_magang_id',
        'pengajuan_magang_id',
        'data_bimbingan_id',
        'laporan_magang',
        'catatan',
        'status_laporan',
    ];

    protected $attributes = [
        'status_laporan'    => 0,
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim');
    }

    public function dataMagang() {
        return $this->belongsTo(DataMagang::class, 'data_magang_id');
    }

    public function pengajuanMagang() {
        return $this->belongsTo(PengajuanMagang::class, 'pengajuan_magang_id');
    }

    public function dataBimbingan() {
        return $this->belongsTo(DataBimbingan::class, 'data_bimbingan_id');
    }
}
