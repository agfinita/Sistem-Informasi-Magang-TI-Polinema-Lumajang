<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengajuanMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Mengambil pengajuan magang milik mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->username;

        $pengajuanMagang = DB::table('pengajuan_magang')
            ->select('id','mahasiswa_id', 'instansi_magang', 'alamat_magang', 'status', 'files')
            ->orderBy('created_at', 'desc')
            ->where('mahasiswa_id', $mahasiswa_id)
            ->get();
        return view('pages.contents.mahasiswa.pengajuan-magang.index', compact('pengajuanMagang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        // Ambil user yang sedang login
        $user   = Auth::user();

        // Cari data mahasiswa berdasarkan username yang login
        $mahasiswa          = Mahasiswa::where('nim', $user->username)->first();

        // Jika mahasiswa ditemukan ambil data mahasiswa
        if ($mahasiswa) {
            $pengajuanMagang   = PengajuanMagang::where('mahasiswa_id', $mahasiswa->nim)->first();
        } else {
            $pengajuanMagang    = null;
        }
        return view('pages.contents.mahasiswa.pengajuan-magang.create', compact('mahasiswa', 'pengajuanMagang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData  = $request->validate([
            'nim'               => 'required',
            'instansi_magang'   => 'required',
            'alamat_magang'     => 'required'
        ]);

        // Menyimpan data ke database
        $pengajuanMagang    = new PengajuanMagang([
            'mahasiswa_id'      => $validatedData['nim'],
            'instansi_magang'   => $validatedData['instansi_magang'],
            'alamat_magang'     => $validatedData['alamat_magang']
        ]);

        $pengajuanMagang->save();

        // Redirect halaman
        return redirect('/mahasiswa/pengajuan-magang')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanMagang $pengajuanMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanMagang $pengajuanMagang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanMagang $pengajuanMagang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanMagang $pengajuanMagang)
    {
        //
    }
}
