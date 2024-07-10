<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DataMagang;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\PengajuanMagang;
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
        $credentials   = $request->only('username', 'password');

        // Proses pengecekan login
        if(Auth::attempt($credentials)) {
            $user   = Auth::user();

            // Cek apakah pengguna aktif
            if ($user->is_active != 1) {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun sudah tidak aktif.');
            }

            // Pemeriksaan session
            $request->session()->regenerate();

            // Cek role pengguna setelah login
            $role   = $user->role;
            switch ($role) {
                case 'Admin':
                    return redirect()->intended('/');
                case 'Mahasiswa':
                    return redirect('mahasiswa/dashboard');
                case 'Dosen':
                    return redirect('dosen/dashboard');
                default:
                    abort(403, 'Unauthorized action');
            }
        }
        return back()
        ->withInput($request->only('username'))
        ->withErrors(['username'  => 'Username atau password salah!']);
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

    public function showPengumumanMhs($id) {
        $pengumuman = Pengumuman::find($id);

        if ($pengumuman) {
            return response()->json($pengumuman);
        } else {
            return response()->json(['error'], 404);
        }
    }

    // Dashboard admin
    public function statistikDashboardAdmin() {
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
    public function statistikDashboardDosen() {
        // Mengambil user yang sedang login
        $user   = Auth::user();

        // Mendapatkan ID dosen dari relasi user
        $dosen      = $user->dosen;
        $dosen_id   = $dosen->id;

        // Menghitung jumlah data bimbingan dari dosen yang sedang login
        $totalBimbingan = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)->count();

        // Menghitung jumlah status_magang 'selesai' mahasiswa bimbingan dari dosen yang sedang login
        $totalBimbinganIds  = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                            ->pluck('data_magang_id');
        $totalSelesai   = DataMagang::whereIn('id', $totalBimbinganIds)
                            ->where('status_magang', 'selesai')
                            ->count();

        return [
            'total_bimbingan'       => $totalBimbingan,
            'total_selesai'         => $totalSelesai,
        ];
    }

}
