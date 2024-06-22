<?php

namespace App\Http\Controllers;

use App\Models\DataBimbingan;
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
       // Mengambil user yang sedang login
       $user   = Auth::user();

       // Mendapatkan ID dosen dari relasi user
       $admin      = $user->admin;
       $admin_id   = $admin->id;

       // Kemudian cari data bimbingan yang terkait dengan dosen yang login
       $dataBimbingan = DataBimbingan::where('dosen_pembimbing_id', $admin_id)
                           ->with('mahasiswa', 'dataMagang', 'dosen')
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
    public function show($data_magang_id)
    {
        // Ambil dosen yang login
        $admin_id = Auth::user()->id;

        // Ambil data bimbingan milik mahasiswa
        $dataBimbingan = DataBimbingan::with('mahasiswa', 'dataMagang')
                            ->where('dosen_pembimbing_id', $admin_id)
                            ->where('data_magang_id', $data_magang_id)
                            ->get();

        // Ambil data logbook mahasiswa yang dipilih
        $logbook = Logbook::where('data_magang_id', $data_magang_id)->get();

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
