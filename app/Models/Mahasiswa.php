<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model {
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table    = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
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

        static::created(function($mahasiswa) {
            $userExists = DB::table('users')->where('username', $mahasiswa->nim)->exists();
            if (!$userExists) {
                \App\Models\User::create([
                    'username'  => $mahasiswa->nim,
                    'password'  => $mahasiswa->nim,
                    'nama'      => $mahasiswa->nama,
                    'email'     => $mahasiswa->email,
                    'role'      => 'Mahasiswa',
                ]);
            }
        });
    }

    public function pengajuanMagang() {
        return $this->hasMany(PengajuanMagang::class);
    }

    public function dataMagang() {
        return $this->hasMany(DataMagang::class);
    }
}
