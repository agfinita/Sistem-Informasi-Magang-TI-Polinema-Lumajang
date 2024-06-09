<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanMagang extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'pengajuan_magang';

    protected $fillable = [
        'mahasiswa_id',
        'instansi_magang',
        'alamat_magang',
        'status',
        'catatan',
        'files'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dataMagang() {
        return $this->hasOne(DataMagang::class);
    }
}
