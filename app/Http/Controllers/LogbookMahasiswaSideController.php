<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogbookMahasiswaSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil mahasiswa yang login
        $mahasiswa_id   = Auth::user()->username;

        // Ambil data magang mahasiswa yang login
        $dataMagang     = DataMagang::where('mahasiswa_id', $mahasiswa_id)
                            ->with('mahasiswa','pengajuanMagang')
                            ->get();

        // Kemudian ambil data logbook mahasiswa yang login
        $logbook        = Logbook::where('mahasiswa_id', $mahasiswa_id)
                            ->with('mahasiswa', 'pengajuanMagang', 'dataMagang')
                            ->get();

        return view('pages.contents.mahasiswa.logbook.index', compact('dataMagang','logbook'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil mahasiswa yang login
        $user   = Auth::user();

        return view('pages.contents.mahasiswa.logbook.create', compact('user'));
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
            'tgl_logbook'   => 'required|date',
            'jm'            => 'required|date_format:H:i',
            'js'            => 'required|date_format:H:i',
            'kegiatan'      => 'required|max:255'
        ]);

        // Menyimpan ke database
        $logbook = Logbook::create([
            'mahasiswa_id'          => $dataBimbingan->mahasiswa->nim,
            'pengajuan_magang_id'   => $dataMagang->pengajuanMagang->id,
            'data_magang_id'        => $dataMagang->id,
            'data_bimbingan_id'     => $dataBimbingan->id,
            'tanggal_logbook'       => $validatedData['tgl_logbook'],
            'jam_mulai'             => $validatedData['jm'],
            'jam_selesai'           => $validatedData['js'],
            'kegiatan'              => $validatedData['kegiatan']
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil mahasiswa yang login
        $user = Auth::user();

        $logbook = Logbook::findOrFail($id);

        return view('pages.contents.mahasiswa.logbook.edit', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tgl_logbook' => 'required|date',
            'jm'          => 'required|date_format:H:i',
            'js'          => 'required|date_format:H:i',
            'kegiatan'    => 'required|max:255'
        ]);

        // Update data logbook
        $logbook=Logbook::findOrFail($id);
        $logbook->update([
            'tanggal_logbook' => $validatedData['tgl_logbook'],
            'jam_mulai'       => $validatedData['jm'] ?? $logbook->jam_mulai,
            'jam_selesai'     => $validatedData['js'] ?? $logbook->jam_selesai,
            'kegiatan'        => $validatedData['kegiatan']
        ]);

        // Mengembalikan respon sukses


        return response()->json(['status' => 'success']);
        // return redirect('/mahasiswa/logbook')->with('status', 'Logbook berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus data logbook
        $logbook= Logbook::findOrFail($id);

        // Hapus data user
        $logbook->delete();

        // Mengembalikan respon sukses
        return redirect()->route('logbook.mahasiswa.index');

    }
}
