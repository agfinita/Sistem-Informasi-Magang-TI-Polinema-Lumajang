<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use Illuminate\Support\Facades\Auth;

class DataBimbinganDosenSideController extends Controller
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
        $dataBimbingan  = DataBimbingan::where('dosen_pembimbing_id', $dosen_id)
                            ->with('mahasiswa', 'dataMagang', 'dosen')
                            ->get();

        return view ('pages.contents.dosen.data-bimbingan.index', compact('dataBimbingan', 'dosen_id', 'dosen'));
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
    public function edit(DataBimbingan $dataBimbingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataBimbingan $dataBimbingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataBimbingan $dataBimbingan)
    {
        //
    }
}
