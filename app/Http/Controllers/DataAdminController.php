<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAdminController extends Controller
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
        return view('pages.contents.admin.form-data-admin');
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
        $admin  = new Admin([
            'nip'       => $validatedData['nip'],
            'nama'      => $validatedData['nama'],
            'email'     => $validatedData['email'],
            'telp'      => $validatedData['telp'],
            'alamat'    => $validatedData['alamat'],
        ]);

        $admin->save();

        // Redirect halaman
        return redirect('/dataAdmin')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin) {
        $admin  = DB::table('admin')
                    ->select('id', 'nip', 'nama',
                    'email', 'telp', 'alamat', 'role')
                    ->where('is_active', 1)
                    ->orderBy('admin.nama', 'ASC')->get();
        return view('pages.contents.admin.data-admin', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $admin = DB::table('admin')->where('id', $id)->first();
        return view('pages.contents.admin.update-data-admin', compact('admin'));
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

        $admin  = DB::table('admin')->where('id', $id)->update([
            'nip'       => $validatedData['nip'],
            'nama'      => $validatedData['nama'],
            'email'     => $validatedData['email'],
            'telp'      => $validatedData['telp'],
            'alamat'    => $validatedData['alamat'],
        ]);

        if ($admin) {
            return redirect('/dataAdmin')->with('status', 'Data berhasil diupdate!');
        } else {
            return redirect('/dataAdmin')->with('error', 'Gagal update data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $admin  = DB::table('admin')->where('id', $id)->first();

        if ($admin) {
            $admin  =    DB::table('admin')->where('id', $id)->delete();

            return redirect('/dataAdmin')->with('status', 'Data berhasil dihapus.');
        }

        return redirect('/dataAdmin')->with('error', 'Data gagal dihapus.');
    }
}
