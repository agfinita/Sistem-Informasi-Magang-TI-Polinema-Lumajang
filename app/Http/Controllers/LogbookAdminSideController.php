<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;

class LogbookAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data mahasiswa melalui data bimbingannya
        $dataBimbingan  = DataBimbingan::select('id','mahasiswa_id')
                        ->with('mahasiswa')
                        ->get();

        return view('pages.contents.admin.logbook.index', compact('dataBimbingan'));
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
        $dataBimbingan = DataBimbingan::findOrFail($id);

        // Ambil data logbook mahasiswa berdasarkan id data bimbingan
        $logbook        = Logbook::where('data_bimbingan_id', $dataBimbingan->id)
                    ->with('dataBimbingan')
                    ->get();

        return view('pages.contents.admin.logbook.show', compact('logbook', 'dataBimbingan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        //
    }
}
