<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\DataMagang;
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
        // Ambil mahasiswa yang login
        $mahasiswa_id   = Auth::user()->username;

        // Ambil data magang mahasiswa yang login
        $dataMagang     = DataMagang::where('mahasiswa_id', $mahasiswa_id)
                            ->with('mahasiswa','pengajuanMagang')
                            ->get();

        // // Kemudian ambil data logbook mahasiswa yang login
        // $logbook        = Logbook::where('mahasiswa_id', $mahasiswa_id)
        //                     ->with('mahasiswa', 'pengajuanMagang', 'dataMagang')
        //                     ->get();
        $logbook = Logbook::all();

        return view('pages.contents.admin.logbook.index', compact('logbook','dataMagang'));
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
    public function show(Logbook $logbook)
    {
        //
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
