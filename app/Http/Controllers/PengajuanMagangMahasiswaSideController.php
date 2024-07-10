<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanMagangMahasiswaSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil pengajuan magang milik mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->username;

        $pengajuanMagang = DB::table('pengajuan_magang')
            ->select('id', 'mahasiswa_id', 'instansi_magang', 'alamat_magang', 'status', 'files', 'created_at')
            ->orderBy('created_at', 'desc')
            ->where('mahasiswa_id', $mahasiswa_id)
            ->get();
        return view('pages.contents.mahasiswa.pengajuan-magang.index', compact('pengajuanMagang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nim'               => 'required',
            'instansi_magang'   => 'required',
            'alamat_magang'     => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validatedData->errors()
            ], 422);
        }

        // Menyimpan hasil validasi yang sukses
        $validated  = $validatedData->validated();

        // Menyimpan data ke database
        $pengajuanMagang    = PengajuanMagang::create([
            'mahasiswa_id'      => $validated['nim'],
            'instansi_magang'   => $validated['instansi_magang'],
            'alamat_magang'     => $validated['alamat_magang']
        ]);

        // Buat notifikasi untuk admin
        $admin = User::where('role', 'admin')->first();

        // Mengambil nama mahasiswa yang mengajukan magang
        $mahasiswa = Mahasiswa::where('nim', $validated['nim'])->first();
        $namaMahasiswa = $mahasiswa ? $mahasiswa->nama : 'Mahasiswa tidak ditemukan';

        Notification::create([
            'user_id'   => $admin->id,
            'type'      => 'pengajuan_magang',
            'message'   => 'Pengajuan magang baru dari ' . $namaMahasiswa,
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        //return redirect('/mahasiswa/pengajuan-magang');
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
