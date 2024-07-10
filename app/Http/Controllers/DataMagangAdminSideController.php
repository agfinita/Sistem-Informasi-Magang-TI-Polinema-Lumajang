<?php

namespace App\Http\Controllers;

use App\Models\DataMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataMagangAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data magang dengan relasi mahasiswa dan pengajuan_magang
        $dataMagang = DataMagang::with(['mahasiswa', 'pengajuanMagang'])->get();

        return view('pages.contents.admin.data-magang.index', compact('dataMagang'));
    }

    public function showDataMagangMhs($id) {
        $dataMagang = DataMagang::with(['mahasiswa', 'pengajuanMagang'])->find($id);

        if ($dataMagang) {
            return response()->json($dataMagang);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
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
    public function destroy($id)
    {
        $dataMagang    = DataMagang::find($id);

        if($dataMagang) {
            $filepath           = $dataMagang->files; //path file yang akan dihapus

            // Hapus file dari local storage
            if (Storage::disk('public')->exists($filepath)) {
                Storage::disk('public')->delete($filepath);
            }

            // Hapus data
            $dataMagang->delete();

            return redirect ('/admin/data-magang');
        }

        return redirect('/admin/data-magang');
    }
}
