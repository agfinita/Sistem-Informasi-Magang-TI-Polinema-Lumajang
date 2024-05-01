<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'remember_token',
        'role',
        'is_active',
    ];

    /**
 * Set the user's password.
 *
 * @param  string  $value
 * @return void
 */
public function setPasswordAttribute($value) {
    $this->attributes['password'] = Hash::make($value);
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public static function boot() {
        parent::boot();

        // Fungsi untuk update is_active dari tabel user maka is_active di tabel mahasiswa juga berubah
        static::updated(function($user) {
            $mahasiswa = Mahasiswa::where('nim', $user->username)->first();
            if ($mahasiswa) {
                $mahasiswa->is_active = $user->is_active;
                $mahasiswa->save();
            }
        });


        // Fungsi untuk update is_active dari tabel user maka is_active di tabel dosen juga berubah
        static::updated(function($user) {
            $dosen = Dosen::where('nip', $user->username)->first();
            if ($dosen) {
                $dosen->is_active = $user->is_active;
                $dosen->save();
            }
        });

        // Fungsi untuk update is_active dari tabel user maka is_active di tabel admin juga berubah
        static::updated(function($user) {
            $admin = Admin::where('nip', $user->username)->first();
            if ($admin) {
                $admin->is_active = $user->is_active;
                $admin->save();
            }
        });
    }


}
