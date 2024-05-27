<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DataMagang;
use App\Models\PengajuanMagang;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class HomeController extends Controller {

    // Menampilkan halaman login
    public function masuk() {
        return view('pages.contents.auth-login');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'username'  => 'required',
            'password'  => ['required', Password::min(8)]
        ]);

        // Save input ketika berhasil divalidasi
        $credentials   = [
            'username'  => $request->username,
            'password'  => $request->password
        ];

        //proses pengecekan login
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role pengguna setelah login
            $role   = Auth::user()->role;
            switch ($role) {
                case 'Admin':
                    return redirect()->intended('/');
                case 'Mahasiswa':
                    return redirect('/mahasiswa/dashboard');
                case 'Dosen':
                    return redirect('/dosen/dashboard');
                default:
                abort(403, 'Unauthorized action.');
            }
        }

        return back()->with('error', 'Username atau password salah!');
    }

    //Logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();  //menghapus sesi

        $request->session()->regenerateToken(); //generate token baru

        return redirect('/');
    }

    // Dashboard mahasiswa
    public function index() {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('pages.contents.mahasiswa.index', compact('pengumuman'));
    }

    // Dashboard admin
    public function statistik() {
        // Jumlah user
        $totalUser  = User::count();
        // Jumlah admin
        $totalAdmin  = Admin::count();
        // Jumlah dosen
        $totalDosen = Dosen::count();
        // Jumlah mahasiswa
        $totalMhs   = Mahasiswa::count();
        // Total data magang
        $totalDataMagang   = DataMagang::count();
        // Pengguna aktif
        $activeUsers = User::where('last_activity', '>=', Carbon::now()->subMinutes(5))->count();
        // Total pengumuman
        $totalPengumuman    = Pengumuman::count();
        // Pengajuan Magang
        $selesai = PengajuanMagang::where('status', 'selesai')->count();
        $diproses = PengajuanMagang::where('status', 'diproses')->count();

        return view('pages.contents.admin.index', compact('totalUser','totalAdmin', 'totalMhs',
                                                        'totalDosen', 'totalDataMagang', 'activeUsers',
                                                        'totalPengumuman', 'selesai', 'diproses'));
    }

    // Dashboard dosen
}
