<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanDosenSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pengumuman = Pengumuman::select('id', 'created_by', 'judul', 'deskripsi', 'kategori', 'created_at')
                ->orderBy('id', 'DESC')
                ->get();

        // Menghitung total pengumuman
        $totalPengumuman    = Pengumuman::count();

        return view('pages.contents.dosen.index', compact('pengumuman', 'totalPengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.contents.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData  = $request->validate([
            'judul'         => 'required',
            'desc'          => 'required',
            'cat'           => 'required',
            'creator'       => 'required',
            'date_created'  => 'required|date'
        ]);

        // Menyimpan ke dalam database
        DB::table('pengumuman')->insert([
            'judul'         => $validatedData['judul'],
            'deskripsi'     => strip_tags($validatedData['desc'], '<a><b><u>'),
            'kategori'      => $validatedData['cat'],
            'created_by'    => $validatedData['creator'],
            'created_at'    => $validatedData['date_created']
        ]);

        // Redirect halaman
        return redirect('/dosen/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $pengumuman = Pengumuman::find($id);

        if(!$pengumuman) {
            return redirect('/dosen/dashboard')->with('error', 'Data tidak ditemukan');
        }

        return view('pages.contents.dosen.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validatedData  = $request->validate([
            'judul'         => 'required',
            'desc'          => 'required',
            'cat'           => 'required',
            'creator'       => 'required',
            'date_created'  => 'required|date'
        ]);

        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) {
            return redirect('/dosen/dashboard')->with('error', 'Data tidak ditemukan');
        }

        $pengumuman->update([
            'judul'         => $validatedData['judul'],
            'deskripsi'     => $validatedData['desc'],
            'kategori'      => $validatedData['cat'],
            'created_by'    => $validatedData['creator'],
            'created_at'    => $validatedData['date_created']
        ]);

        return redirect('/dosen/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $pengumuman = DB::table('pengumuman')->where('id', $id)->first();

        if ($pengumuman) {
            $pengumuman = DB::table('pengumuman')->where('id', $id)->delete();

            return redirect('/dosen/dashboard');
        }

        return redirect('/dosen/dashboard')->with('error', 'Data tidak ditemukan');
    }
}
