<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use Illuminate\Support\Facades\Auth;

class LogbookDosenSideController extends Controller
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

        // Kemudian cari data bimbingan yang terkait dengan dosen yang login
        $dataBimbingan = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                            ->with('mahasiswa', 'dataMagang', 'dosen')
                            ->get();

        return view('pages.contents.dosen.logbook.index', compact('dataBimbingan'));
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
    public function show($data_magang_id)
    {
        // Ambil dosen yang login
        $dosen_id = Auth::user()->id;

        // Ambil data bimbingan milik mahasiswa
        $dataBimbingan = DataBimbingan::with('mahasiswa', 'dataMagang')
                            ->where('dosen_pembimbing_id', $dosen_id)
                            ->where('data_magang_id', $data_magang_id)
                            ->get();

        // Ambil data logbook mahasiswa yang dipilih
        $logbook = Logbook::where('data_magang_id', $data_magang_id)->get();

        return view('pages.contents.dosen.logbook.show', compact('logbook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil logbook berdasarkan ID
        $logbook = Logbook::findOrFail($id);

        return view('pages.contents.dosen.logbook.edit', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData  = $request->validate([
            'verif'     => 'required|boolean'
        ]);

        // Ambil logbook berdasarkan ID
        $logbook    = Logbook::findOrFail($id);
        if(!$logbook) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Data tidak ditemukan'
            ], 404);
        }

        $logbook->update([
            'verifikasi_dosen'  => $validatedData['verif']
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

    }

    /**
     * Validasi logbook yang dipilih
     */
    public function validasi(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:logbook,id'
        ]);

        // Update status verifikasi
        Logbook::whereIn('id', $validatedData['ids'])->update(['verifikasi_dosen' => 1]);

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        //
    }
}
