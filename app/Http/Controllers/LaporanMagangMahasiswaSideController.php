<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\LaporanMagang;

class LaporanMagangMahasiswaSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil username mahasiswa yang login
        $mahasiswa_id   = auth()->user()->username;

        // Mengambil laporan magang mahasiswa dan relasinya
        $laporanMagang = LaporanMagang::where('mahasiswa_id', $mahasiswa_id)
                            ->with([
                                'mahasiswa'  => function($query) {
                                $query->select('nim', 'nama');
                                },
                                'pengajuanMagang'   => function($query) {
                                    $query->select('id', 'instansi_magang');
                                },
                                'dataMagang'    => function($query) {
                                    $query->select('id', 'kategori_magang');
                                },
                                'dataBimbingan' => function($query) {
                                    $query->select('id', 'dosen_pembimbing_id');
                                }
                            ])
                            ->get();

        // Menangani bimbingan bila tidak ada
        $dataBimbingan  = DataBimbingan::where('mahasiswa_id', $mahasiswa_id)
                            ->with('dosen')
                            ->first();

        // Jika data bimbingan tidak ada, buat objek kosong untuk menghindari error
        if (!$dataBimbingan) {
            $dataBimbingan          = new \stdclass();
            $dataBimbingan->dosen   = null;
        }

        return view('pages.contents.mahasiswa.laporan-magang.index', compact('laporanMagang', 'dataBimbingan'));
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
    public function store(Request $request, $id)
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
        // Mengambil username mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->username;

        // Mengambil ID laporan magang berdasarkan $mahasiswa_id
        $laporanMagang = LaporanMagang::where('mahasiswa_id', $mahasiswa_id)
                                        ->firstOrFail();

        // Jika laporan magang belum ada
        if (!$laporanMagang) {
            abort(404, 'Laporan magang tidak ditemukan');
        }

        return view('pages.contents.mahasiswa.laporan-magang.edit', compact('laporanMagang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Mengambil username mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->username;

        // Mencari laporan magang milik mahasiswa yang login
        $laporanMagang = LaporanMagang::where('mahasiswa_id', $mahasiswa_id)
                                        ->firstOrFail();

        // Validasi input
        $validatedData  = $request->validate([
            'file'      => 'required|file|mimes:doc,docx,pdf'
        ]);

        // Jika ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate nama file unik
            $originalname   = $file->getClientOriginalName();
            $filename       = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path = $file->storeAs('uploads/laporan_magang', $filename, 'public');

            // Hapus file lama jika ada
            if ($laporanMagang->laporan_magang) {
                $oldFilePath = public_path('storage/' . $laporanMagang->laporan_magang);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Simpan path ke dalam database
            $laporanMagang->laporan_magang = $path;
        }

        // Menyimpan ke database
        $laporanMagang->save();

        // Mengembalikan respon sukses
        return response()->json([ 'status'  => 'success' ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanMagang $laporanMagang)
    {
        //
    }
}
