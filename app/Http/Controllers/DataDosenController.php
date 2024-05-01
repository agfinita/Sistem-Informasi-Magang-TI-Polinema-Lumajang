<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.contents.admin.form-data-dosen');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData  = $request->validate([
            'nip'       => 'required',
            'nama'      => 'required',
            'email'     => 'required|email',
            'telp'      => 'required',
            'alamat'    => 'required'
        ]);

        // Menyimpan data ke database
        $dosen  = new Dosen([
            'nip'       => $validatedData['nip'],
            'nama'      => $validatedData['nama'],
            'email'     => $validatedData['email'],
            'telp'      => $validatedData['telp'],
            'alamat'    => $validatedData['alamat'],
        ]);

        $dosen->save();

        // Redirect halaman
        return redirect('/dataDosen')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen) {
        $dosen  = DB::table('dosen')
                    ->select('id', 'nip', 'nama', 'email', 'telp', 'alamat', 'role')
                    ->where('is_active', 1)
                    ->orderBy('dosen.nama', 'ASC')->get();
        return view('pages.contents.admin.data-dosen', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $dosen  = DB::table('dosen')->where('id', $id)->first();
        return view('pages.contents.admin.update-data-dosen', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validatedData  = $request->validate([
            'nip'       => 'required',
            'nama'      => 'required',
            'email'     => 'required|email',
            'telp'      => 'required',
            'alamat'    => 'required'
        ]);

        $dosen  = DB::table('dosen')->where('id', $id)->update([
            'nip'       => $validatedData['nip'],
            'nama'      => $validatedData['nama'],
            'email'     => $validatedData['email'],
            'telp'      => $validatedData['telp'],
            'alamat'    => $validatedData['alamat'],
        ]);

        if ($dosen) {
            return redirect('/dataDosen')->with('status', 'Data berhasil diupdate!');
        } else {
            return redirect('/dataDosen')->with('error', 'Gagal update data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $dosen  = DB::table('dosen')->where('id', $id)->first();

        if ($dosen) {
            $dosen  =    DB::table('dosen')->where('id', $id)->delete();

            return redirect('/dataDosen')->with('status', 'Data berhasil dihapus.');
        }

        return redirect('/dataDosen')->with('error', 'Data gagal dihapus.');
    }
}
