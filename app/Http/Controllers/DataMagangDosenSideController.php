<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use Illuminate\Support\Facades\Auth;

class DataMagangDosenSideController extends Controller
{
    /**
     * Menampilkan data magang mahasiswa bimbingan masing-masin dosen
     */

    public function index() {
        // Mengambil user yang sedang login
        $user   = Auth::user();

        // Mendapatkan ID dosen dari relasi user
        $dosen      = $user->dosen;
        $dosen_id   = $dosen->id;

        // Cari data mahasiswa bimbingan sesuai dosen yang login dan ambil data magangnya
        $dataBimbingan  = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                            ->with(['mahasiswa', 'dataMagang.pengajuanMagang'])
                            ->get();

        return view('pages.contents.dosen.data-magang.index', compact('dataBimbingan', 'dosen_id', 'dosen'));
    }
}
