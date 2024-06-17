<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\LaporanMagang;
use Illuminate\Support\Facades\Auth;

class LaporanMagangDosenSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil user yang sedang login
        $user   = Auth::user();

        // Mendapatkan ID dosen dari relasi user
        $dosen      = $user->dosen;
        $dosen_id   = $dosen->id;

        // Ambil data bimbingan mahasiswa berdasar dosen yang login
        $dataBimbingan  = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)->get();

        // Ambil ID dari data bimbingan untuk digunakan dalam whereIn
        $dataBimbinganIds   = $dataBimbingan->pluck('id');

        // Ambil laporan mahasiswa bimbingan berdasar dosen yang login
        $laporanMagang  = LaporanMagang::whereIn('data_bimbingan_id', $dataBimbinganIds)
                            ->with('mahasiswa', 'pengajuanMagang', 'dataMagang')
                            ->get();

        return view('pages.contents.dosen.laporan-magang.index', compact('dataBimbingan', 'laporanMagang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanMagang $laporanMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil user yang sedang login
        $user   = Auth::user();

        // Mendapatkan ID dosen dari relasi user
        $dosen      = $user->dosen;
        $dosen_id   = $dosen->id;

        // Ambil data bimbingan berdasar dosen yang login
        $dataBimbingan  = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                            ->pluck('mahasiswa_id');    // Ambil ID mahasiswa dosen yang login

        // Ambil laporan magang setiap mahasiswa bimbingannya
        $laporanMagang  = LaporanMagang::whereIn('mahasiswa_id', $dataBimbingan)
                            ->with('dataMagang')
                            ->firstOrFail();

        return view('pages.contents.dosen.laporan-magang.edit', compact('laporanMagang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'note'          => 'nullable|string|max:255',
            'status-lap'    => 'nullable|in:0,1',
            'status_magang' => 'required|in:belum mulai,sedang magang,dihentikan,selesai'
        ]);

        // Mengambil user yang sedang login
        $user = Auth::user();

        // Mendapatkan ID dosen dari relasi user
        $dosen = $user->dosen;
        $dosen_id = $dosen->id;

        // Ambil data bimbingan berdasar dosen yang login
        $dataBimbingan = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
            ->pluck('mahasiswa_id'); // Ambil ID mahasiswa dosen yang login

        // Ambil laporan magang berdasarkan ID dan pastikan mahasiswa berada di bimbingan dosen yang login
        $laporanMagang = LaporanMagang::whereIn('mahasiswa_id', $dataBimbingan)
            ->where('id', $id)
            ->with('dataMagang')
            ->firstOrFail();

        // Update data laporan magang
        $laporanMagang->catatan         = $validatedData['note'];
        $laporanMagang->status_laporan  = $validatedData['status-lap'];
        $laporanMagang->save();

        // Update data magang
        $dataMagang = $laporanMagang->dataMagang;
        $dataMagang->status_magang      = $validatedData['status_magang'];
        $dataMagang->save();

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanMagang $laporanMagang)
    {
        //
    }
}
