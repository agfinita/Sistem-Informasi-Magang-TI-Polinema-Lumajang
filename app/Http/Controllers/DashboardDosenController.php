<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\LaporanMagang;
use Illuminate\Support\Facades\Auth;

class DashboardDosenController extends Controller
{
    // Dashboard dosen
    public function statistikDashboardDosen(Request $request) {
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

        // Menampilkan aktivitas terakhir logbook
        // Ambil parameter jumlah entri per halaman dari request
        $perPage = $request->input('per_page', 3); // Default 3 jika tidak ada input
        // Ambil ID mahasiswa bimbingan dosen tersebut
        $mhsIds = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                ->pluck('mahasiswa_id')
                ->toArray();
        // Ambil logbook dari seluruh mahasiswa yang dibimbing oleh dosen tersebut
        $logbooks = Logbook::whereIn('mahasiswa_id', $mhsIds)
            ->with('dataMagang')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage); // Tampilkan sesuai dengan jumlah yang dipilih

        // Ambil data bimbingan dosen yang login
        $dataBimbingan = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)->get();
        $dataBimbinganIds = $dataBimbingan->pluck('id');

        // Jumlah permintaan validasi bimbingan dosen yang login
        $validasiBimbingan = Bimbingan::whereIn('data_bimbingan_id', $dataBimbinganIds)
            ->where('verifikasi_dosen', '0')
            ->count();

        // Jumlah permintaan validasi logbook dosen yang login
        $validasiLogbook = Logbook::whereIn('data_bimbingan_id', $dataBimbinganIds)
            ->where('verifikasi_dosen', '0')
            ->count();

        // Jumlah laporan magang yang belum divalidasi
        $validasiLapMagang  = LaporanMagang::whereIn('data_bimbingan_id', $dataBimbinganIds)
            ->where('status_laporan', '0')
            ->count();

        return view('pages.contents.dosen.index', compact('totalBimbingan', 'totalSelesai', 'logbooks',
                                                        'validasiBimbingan', 'validasiLogbook', 'validasiLapMagang'));
    }
}
