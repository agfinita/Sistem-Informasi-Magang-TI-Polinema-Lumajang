<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\LaporanMagang;

class DataBimbinganAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBimbingan  = DataBimbingan::orderBy('id', 'asc')
                            ->with('mahasiswa', 'dataMagang', 'dosen')
                            ->get();

        return view('pages.contents.admin.data-bimbingan.index', compact('dataBimbingan'));
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
    public function show(DataBimbingan $dataBimbingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataBimbingan  = DataBimbingan::where('id', $id)
                            ->with('mahasiswa', 'dataMagang')
                            ->first();

        $dosenList = Dosen::where('is_active', 1)->get();

        return view('pages.contents.admin.data-bimbingan.edit', compact('dataBimbingan', 'dosenList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Mencari data bimbingan berdasarkan id
        $dataBimbingan  = DataBimbingan::find($id);
        if (!$dataBimbingan) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Data tidak ditemukan'
            ], 404);
        }

        $dataBimbingan->dosen_pembimbing_id = $request->input('dosen_pembimbing_id');
        $dataBimbingan->save();

        // Mengambil data magang berdasarkan id yang sesuai
        $dataMagang = DataMagang::find($dataBimbingan->data_magang_id);

        // Buat atau perbarui laporan magang
        LaporanMagang::updateOrCreate(
            ['data_bimbingan_id' => $dataBimbingan->id],
            [
                'mahasiswa_id'          => $dataBimbingan->mahasiswa->nim,
                'pengajuan_magang_id'   => $dataMagang->pengajuanMagang->id,
                'data_magang_id'        => $dataBimbingan->data_magang_id,
                'dosen_pembimbing_id'   => $dataBimbingan->dosen_pembimbing_id,
                'status_laporan'        => '0',
            ]
        );

        // Mengembalikan respon sukses
        return response()->json(['status'   => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataBimbingan $dataBimbingan)
    {
        //
    }
}
