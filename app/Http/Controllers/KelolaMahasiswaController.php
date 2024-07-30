<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users  = DB::table('users')
                    ->select('id', 'username', 'nama', 'email', 'role', 'is_active', 'created_at', 'updated_at')
                    ->orderBy('users.nama', 'asc')
                    ->where('role', 'mahasiswa')->get();

        return view('pages.contents.admin.kelola-mahasiswa.index', compact('users'));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users  = DB::table('users')->where('id', $id)->first();
        return view('pages.contents.admin.kelola-mahasiswa.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData  = $request->validate([
            'username'              => 'required',
            'email'                 => 'required|email',
            'gridRadios-status'     => 'required|boolean',
            'date_created'          => 'required|date',
            'date_updated'          => 'required|date'
        ]);

        // Mencari user berdasarkan id
        $users  = User::find($id);
        if (!$users) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($validatedData, $users, $request) {
            // Update data user
            $users->update([
                'username'      => $validatedData['username'],
                'email'         => $validatedData['email'],
                'is_active'     => $validatedData['gridRadios-status'],
                'created_at'    => $validatedData['date_created'],
                'updated_at'    => $validatedData['date_updated']
            ]);

            // Update data mahasiswa terkait user
            $mahasiswa  = Mahasiswa::where('nim', $users->username)->first();
            if ($mahasiswa) {
                $mahasiswa->update([
                    'nim'       => $users->username,
                    'email'     => $users->email,
                    'is_active' => $users->is_active
                ]);
            }
        });

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        // return redirect('/kelola-pengguna/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari user berdasarkan id
        $users  = User::find($id);
        if (!$users) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($users) {
            // Hapus data mahasiswa terkait user
            $mahasiswa  = Mahasiswa::where('nim', $users->username)->first();
            if ($mahasiswa) {
                $mahasiswa->delete();
            }

            // Hapus data user
            $users->delete();
        });

        return redirect('/kelola-pengguna/mahasiswa');

        // Mengembalikan respon sukses
        //return response()->json()(['status' => 'success']);
    }
}
