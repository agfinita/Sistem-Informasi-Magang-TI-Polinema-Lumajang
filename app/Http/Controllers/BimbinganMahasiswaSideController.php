<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\DataBimbingan;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganMahasiswaSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /// Ambil mahasiswa yang login
        $mahasiswa_id   = Auth::user()->username;

        // Ambil data magang mahasiswa yang login
        $dataMagang     = DataMagang::where('mahasiswa_id', $mahasiswa_id)
                            ->with('mahasiswa','pengajuanMagang')
                            ->get();

        // Kemudian ambil data bimbingan mahasiswa yang login
        $bimbingan        = Bimbingan::where('mahasiswa_id', $mahasiswa_id)
                            ->with('mahasiswa', 'pengajuanMagang', 'dataMagang')
                            ->get();

        return view('pages.contents.mahasiswa.bimbingan.index', compact('dataMagang','bimbingan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    // Ambil mahasiswa yang login
    $user   = Auth::user();

    return view('pages.contents.mahasiswa.bimbingan.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil mahasiswa yang login
        $mahasiswa_id   = Auth::user()->username;

        // Ambil data magang mahasiswa yang login dan relasi yang terkait
        $dataMagang = DataMagang::where('mahasiswa_id', $mahasiswa_id)
                        ->with('pengajuanMagang')
                        ->first();
        // Ambil data bimbingan mahasiswa yang login dan relasi yang terkait
        $dataBimbingan  = DataBimbingan::where('mahasiswa_id', $mahasiswa_id)
                        ->with('mahasiswa')
                        ->first();

        // Masukkan data logbook mahasiswa yang login berdasarkan relasi yang terkait
        // Validasi input
        $validatedData  = $request->validate([
            'tgl_bimbingan'   => 'required|date',
            'pembahasan'      => 'required|max:255',
            'pertemuan'      => 'required|max:255'
        ]);

        // Menyimpan ke database
        $bimbingan = Bimbingan::create([
            'mahasiswa_id'          => $dataBimbingan->mahasiswa->nim,
            'pengajuan_magang_id'   => $dataMagang->pengajuanMagang->id,
            'data_magang_id'        => $dataMagang->id,
            'data_bimbingan_id'     => $dataBimbingan->id,
            'pertemuan'             => $validatedData['pertemuan'],
            'tanggal'               => $validatedData['tgl_bimbingan'],
            'pembahasan'            => $validatedData['pembahasan'],
            'batas_waktu'           => $validatedData['tgl_bimbingan'],
            // 'verifikasi_dosen'      => 'belum diverifikasi'

        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Bimbingan $bimbingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bimbingan $bimbingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bimbingan $bimbingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bimbingan $bimbingan)
    {
        //
    }
}
