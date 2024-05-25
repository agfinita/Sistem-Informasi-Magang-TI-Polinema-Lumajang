<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\Auth;

class DataMagangController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Mengambil data milik mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->username;

        // Kemudian cari mahasiswa yang login di tabel data magang dan relasinya dengan tabel mahasiswa dan tabel pengajuan_magang
        $dataMagang = DataMagang::where('mahasiswa_id', $mahasiswa_id)
            ->with('mahasiswa', 'pengajuanMagang')
            ->get();
        return view('pages.contents.mahasiswa.data-magang.index', compact('dataMagang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        // Ambil user yang sedang login
        $user   = Auth::user();

        // Cari data mahasiswa berdasarkan username yang login
        $mahasiswa          = Mahasiswa::where('nim', $user->username)->first();
        // Jika mahasiswa ditemukan ambil data pengajuan magangnya
        if ($mahasiswa) {
            $pengajuanMagang    = PengajuanMagang::where('mahasiswa_id', $mahasiswa->nim)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
        } else {
            $pengajuanMagang    = null;
        }

        return view('pages.contents.mahasiswa.data-magang.create', compact('mahasiswa', 'pengajuanMagang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validasi inputan
        $validatedData  = $request->validate([
            'nim'               => 'required|exists:mahasiswa,nim',
            'period'            => 'required',
            'tm'                => 'required',
            'ts'                => 'required',
            'file'              => 'required|file|mimes:docx,doc,pdf'
        ]);

        // Handle upload file
        if ($request->hasFile('file')) {
            $file           = $request->file('file');

            // Generate nama file unik
            $originalname   = $file->getClientOriginalName();
            $filename   = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path       = $file->storeAs('uploads', $filename, 'public');

            // Simpan path ke dalam database
            $validatedData['file']  = $path;
        }

        // Ambil pengajuan magang terbaru berdasarkan nim
        $pengajuanMagang = PengajuanMagang::where('mahasiswa_id', $validatedData['nim'])
            ->orderBy('created_at', 'desc')
            ->first();

        // Menyimpan ke database
        DataMagang::create([
            'mahasiswa_id'          => $validatedData['nim'],
            'pengajuan_magang_id'   => $pengajuanMagang ? $pengajuanMagang->id : null,
            'periode'               => $validatedData['period'],
            'tanggal_mulai'         => $validatedData['tm'],
            'tanggal_selesai'       => $validatedData['ts'],
            'files'                 => $validatedData['file']
        ]);

        // Redirect halaman
        return redirect('/mahasiswa/data-magang')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataMagang $dataMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataMagang $dataMagang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataMagang $dataMagang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataMagang $dataMagang) {
        //
    }
}
