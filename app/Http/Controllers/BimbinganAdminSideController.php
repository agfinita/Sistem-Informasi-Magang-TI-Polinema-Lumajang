<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;

class BimbinganAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data mahasiswa melalui data bimbingannya
        $dataBimbingan  = DataBimbingan::select('id', 'mahasiswa_id')
                            ->with('mahasiswa')
                            ->get();
        return view('pages.contents.admin.bimbingan.index', compact('dataBimbingan'));
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
    public function show($id)
    {
        // Ambil id data bimbingan mahasiswa
        $dataBimbingan  = DataBimbingan::findOrFail($id);

        // Ambil data bimbingan mahasiswa berdasarkan id data bimbingan
        $bimbingan      = Bimbingan::where('data_bimbingan_id', $dataBimbingan->id)
                            ->with('dataBimbingan')
                            ->get();
        return view('pages.contents.admin.bimbingan.show', compact('bimbingan', 'dataBimbingan'));
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
