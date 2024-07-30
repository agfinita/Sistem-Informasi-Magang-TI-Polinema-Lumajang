<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'pengumuman';

    protected $fillable = [
        'created_by',
        'judul',
        'deskripsi',
        'kategori',
        'files',
        'created_at'
    ];
}
