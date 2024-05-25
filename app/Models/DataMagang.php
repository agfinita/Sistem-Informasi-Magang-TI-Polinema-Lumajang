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
        'files'
    ];

    public function pengajuanMagang() {
                                                        // foreign key di tabel data magang, yang mengacu pada tabel pengajuan magang
        return $this->belongsTo(PengajuanMagang::class, 'pengajuan_magang_id', 'id');
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim');
    }
}
