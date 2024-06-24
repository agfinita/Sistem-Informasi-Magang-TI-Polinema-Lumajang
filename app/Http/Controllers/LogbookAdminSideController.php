<?php

namespace App\Http\Controllers;

use App\Models\DataBimbingan;
use App\Models\Logbook;
// use App\Models\DataMagang;
use Illuminate\Http\Request;
// use App\Models\DataBimbingan;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class LogbookAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBimbingan = DataBimbingan::orderBy('id', 'asc')->with('mahasiswa', 'dataMagang', 'dosen')->get();

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
        // Ambil data logbook mahasiswa yang dipilih
        $logbook = Logbook::where('data_magang_id', $id)->get();

        return view('pages.contents.admin.logbook.show', compact('logbook'));
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
