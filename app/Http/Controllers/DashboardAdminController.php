<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\DataMagang;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\PengajuanMagang;

class DashboardAdminController extends Controller
{
        // Dashboard admin
        public function statistikDashboardAdmin() {
            // Jumlah user
            $totalUser  = User::count();
            // Jumlah admin
            $totalAdmin = Admin::count();
            // Jumlah dosen
            $totalDosen = Dosen::count();
            // Jumlah mahasiswa
            $totalMhs   = Mahasiswa::count();
            // Pengguna aktif
            $activeUsers = User::where('last_activity', '>=', Carbon::now()->subMinutes(5))->count();
            // Total pengumuman
            $totalPengumuman    = Pengumuman::count();
            // Pengajuan Magang
            $selesai    = PengajuanMagang::where('status', 'selesai')->count();
            $diproses   = PengajuanMagang::where('status', 'diproses')->count();

            // Statistik bimbingan
            // Mendapatkan total mahasiswa yang terdaftar di data magang
            $totalMahasiswaMagang = DataMagang::distinct()->pluck('mahasiswa_id')->count();
            // Mendapatkan ID mahasiswa yang sudah melakukan bimbingan
            $mahasiswaSudahBimbinganIds = Bimbingan::distinct()->pluck('mahasiswa_id')->toArray();
            // Menghitung jumlah mahasiswa yang sudah melakukan bimbingan
            $sdhBimbingan = count($mahasiswaSudahBimbinganIds);
            // Menghitung jumlah mahasiswa yang belum melakukan bimbingan
            $blmBimbingan = $totalMahasiswaMagang - $sdhBimbingan;

            // Statistik belum magang : sudah magang
            // Mengambil daftar mahasiswa_id yang sudah magang
            $sdhMagangIds = DataMagang::distinct()->pluck('mahasiswa_id')->toArray();
            // Menghitung jumlah mahasiswa yang belum magang
            $blmMagang = Mahasiswa::whereNotIn('nim', $sdhMagangIds)->where('is_active', '1')->count();
            // Menghitung jumlah mahasiswa yang belum mulai
            $blmMulai       = DataMagang::where('status_magang', 'belum dimulai')->count();
            // Menghitung jumlah mahasiswa yang sedang magang
            $sedangMagang   = DataMagang::where('status_magang', 'sedang magang')->count();
            // Menghitung jumlah mahasiswa yang selesai
            $selesaiMagang  = DataMagang::where('status_magang', 'selesai')->count();

            return view('pages.contents.admin.index', compact('totalUser','totalAdmin', 'totalMhs',
                                                            'totalDosen', 'activeUsers',
                                                            'totalPengumuman', 'selesai', 'diproses',
                                                            'sdhBimbingan', 'blmBimbingan', 'blmMagang', 'blmMulai',
                                                            'sedangMagang', 'selesaiMagang'));
        }
}
