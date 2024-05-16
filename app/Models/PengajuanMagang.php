<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanMagang extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara ekplisit
    protected $table    = 'pengajuan_magang';

    protected $fillable = [
        'admin_id',
        'mahasiswa_id',
        'instansi_magang',
        'alamat_magang',
        'status',
        'catatan',
        'files'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dataMagang() {
        return $this->hasOne(DataMagang::class);
    }
}
