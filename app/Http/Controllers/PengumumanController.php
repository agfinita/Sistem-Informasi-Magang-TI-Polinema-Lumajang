<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pengumuman = DB::table('pengumuman')
                        ->select('id', 'created_by', 'judul',
                                'deskripsi', 'kategori', 'created_at')
                        ->orderBy('pengumuman.id', 'DESC')->get();

        return view('pages.contents.admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.contents.admin.pengumuman.create');
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
        return redirect('/pengumuman')->with('status', 'Pengumuman beru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $pengumuman = Pengumuman::find($id);

        if(!$pengumuman) {
            return redirect('/pengumuman')->with('error', 'Pengumuman tidak ditemukan');
        }

        return view('pages.contents.admin.pengumuman.edit', compact('pengumuman'));
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
            return redirect('/pengumuman')->with('error', 'Pengumuman tidak ditemukan');
        }

        $pengumuman->update([
            'judul'         => $validatedData['judul'],
            'deskripsi'     => $validatedData['desc'],
            'kategori'      => $validatedData['cat'],
            'created_by'    => $validatedData['creator'],
            'created_at'    => $validatedData['date_created']
        ]);

        return redirect('/pengumuman')->with('status', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $pengumuman  = DB::table('pengumuman')->where('id', $id)->first();

        if ($pengumuman) {
            $pengumuman  = DB::table('pengumuman')->where('id', $id)->delete();

            return redirect('/pengumuman')->with('status'. 'Data berhasil dihapus.');
        }

        return redirect('/pengumuman')->with('error', 'Pengumuman tidak ditemukan');
    }
}
