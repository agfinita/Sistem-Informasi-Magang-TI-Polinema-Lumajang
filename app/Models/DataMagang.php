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
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function pengajuanMagang() {
        return $this->belongsTo(PengajuanMagang::class);
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
}
