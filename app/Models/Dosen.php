<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model {
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'dosen';

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'telp',
        'alamat',
        'is_active',
    ];

    // Set nilai default untuk is_active
    protected $attributes = [
        'is_active' => 1,
    ];

    // Update is_active ketika is_active di table user diupdate
    public function updateIsActive($isActive) {
        if ($this->is_active !== $isActive) {
            $this->is_active = $isActive;
            $this->save();
        }
    }

    // Create event untuk user otomatis tertambah di tabel user
    public static function boot() {
        parent::boot();

        static::creating(function($dosen) {
            $userExists = DB::table('users')->where('username', $dosen->nip)->exists();
            if ($userExists) {
                return false; // Membatalkan pembuatan entitas Dosen baru
            }
        });

        static::created(function($dosen) {
            User::create([
                'username'  => $dosen->nip,
                'password'  => $dosen->nip,
                'nama'      => $dosen->nama,
                'email'     => $dosen->email,
                'role'      => 'Dosen',
            ]);
        });
    }

}
