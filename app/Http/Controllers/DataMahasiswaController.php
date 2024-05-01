<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataMahasiswaController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view ('pages.contents.admin.data-mahasiswa');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view ('pages.contents.admin.form-data-mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData  = $request->validate([
            'nim'               => 'required',
            'nama'              => 'required',
            'control-kelas'     => 'required',
            'control-jurusan'   => 'required',
            'email'             => 'required|email',
            'telp'              => 'required',
            'alamat'            => 'required'
        ]);

        // Menyimpan data ke database
        $mahasiswa  = new Mahasiswa([
            'nim'       => $validatedData['nim'],
            'nama'      => $validatedData['nama'],
            'kelas'     => $validatedData['control-kelas'],
            'jurusan'   => $validatedData['control-jurusan'],
            'email'     => $validatedData['email'],
            'telp'      => $validatedData['telp'],
            'alamat'    => $validatedData['alamat'],
        ]);

        $mahasiswa->save();

        // Membuat entri pengguna baru (user)
        $userExists  = DB::table('users')->where('username', $mahasiswa->nim)->exists();
        if (!$userExists) {
            User::create([
                'username'  => $mahasiswa->nim,
                'password'  => $mahasiswa->nim,
                'nama'      => $mahasiswa->nama,
                'email'     => $mahasiswa->email,
                'role'      => 'Mahasiswa',
                'is_active' => '1',
            ]);
        }
        // Redirect halaman
        return redirect('/dataMahasiswa')->with('status', 'Data added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa) {
        $mahasiswa  = DB::table('mahasiswa')
                        ->select('id', 'nim', 'nama', 'kelas',
                                'jurusan', 'email', 'telp', 'alamat', 'role')
                        ->where('is_active', 1)
                        ->orderBy('mahasiswa.nama', 'ASC')->get();
        return view('pages.contents.admin.data-mahasiswa', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $mahasiswa  = DB::table('mahasiswa')->where('id', $id)->first();
        return view('pages.contents.admin.update-data-mahasiswa', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validatedData  = $request->validate([
            'nim'               => 'required',
            'nama'              => 'required',
            'control-kelas'     => 'required',
            'control-jurusan'   => 'required',
            'email'             => 'required|email',
            'telp'              => 'required',
            'alamat'            => 'required'
        ]);

        $mahasiswa  = DB::table('mahasiswa')->where('id', $id)->update([
            'nim'       => $validatedData['nim'],
            'nama'      => $validatedData['nama'],
            'kelas'     => $validatedData['control-kelas'],
            'jurusan'   => $validatedData['control-jurusan'],
            'email'     => $validatedData['email'],
            'telp'      => $validatedData['telp'],
            'alamat'    => $validatedData['alamat'],
        ]);

        if ($mahasiswa) {
            return redirect('/dataMahasiswa')->with('status', 'Data berhasil diupdate!');
        } else {
            return redirect('/dataMahasiswa')->with('error', 'Gagal update data.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $mahasiswa  = DB::table('mahasiswa')->where('id', $id)->first();

        if ($mahasiswa) {
            $mahasiswa  = DB::table('mahasiswa')->where('id', $id)->delete();

            return redirect('/dataMahasiswa')->with('status'. 'Data berhasil dihapus.');
        }

        return redirect('/dataMahasiswa')->with('error', 'Data tidak ditemukan');
    }
}
