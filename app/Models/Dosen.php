<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'dosen';

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'telp',
        'alamat',
        'role',
        'is_active',
    ];

    protected $attributes   = [
        'role'      => 'Dosen',
        'is_active' => 1,
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
}
