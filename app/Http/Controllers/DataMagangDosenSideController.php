<?php

namespace App\Http\Controllers;

use App\Models\DataMagang;
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

    public function showDataMagangMhs($id) {
        // Mengambil user yang sedang login
        $user = Auth::user();

        // Mendapatkan ID dosen dari relasi user
        $dosen = $user->dosen;
        $dosen_id = $dosen->id;

        // Mencari data magang berdasarkan ID
        $dataMagang = DataMagang::with(['mahasiswa', 'pengajuanMagang'])->find($id);

        // Memeriksa apakah data magang ditemukan
        if ($dataMagang) {
            // Memeriksa apakah mahasiswa tersebut dibimbing oleh dosen yang sedang login
            $isMahasiswaDibimbing = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                                    ->where('mahasiswa_id', $dataMagang->mahasiswa_id)
                                    ->exists();

            if ($isMahasiswaDibimbing) {
                return response()->json($dataMagang);
            } else {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
}
