<?php

namespace App\Http\Controllers;

use App\Models\PengajuanMagang;
use Illuminate\Http\Request;

class PengajuanMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('pages.contents.mahasiswa.pengajuan-magang.index', [ 'pm' => PengajuanMagang::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.contents.mahasiswa.pengajuan-magang.create');
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
