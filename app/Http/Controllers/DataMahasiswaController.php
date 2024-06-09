<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa  = Mahasiswa::select(
            'id', 'nim', 'nama', 'kelas', 'jurusan', 'email', 'telp', 'alamat', 'role'
        )->where('is_active', 1)
        ->orderBy('nama', 'asc')->get();

        return view('pages.contents.admin.data-mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contents.admin.data-mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nim'               => 'required',
            'nama'              => 'required',
            'control-kelas'     => 'required',
            'control-jurusan'   => 'required',
            'email'             => 'required|email',
            'telp'              => 'required',
            'alamat'            => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validatedData->errors()
            ], 422);
        }

        // Menyimpan hasil validasi yang sukses
        $validated = $validatedData->validated();

        try {
            // Menyimpan data ke database
            DB::transaction(function () use ($validated) {
                // Tambah data mahasiswa baru
                $mahasiswa  = Mahasiswa::create([
                    'nim'       => $validated['nim'],
                    'nama'      => $validated['nama'],
                    'kelas'     => $validated['control-kelas'],
                    'jurusan'   => $validated['control-jurusan'],
                    'email'     => $validated['email'],
                    'telp'      => $validated['telp'],
                    'alamat'    => $validated['alamat'],
                    'role'      => 'Mahasiswa',
                    'is_active' => 1,
                ]);

                // Tambah secara atomik di tabel user mahasiswa
                User::create([
                    'username'      => $mahasiswa->nim,
                    'nama'          => $mahasiswa->nama,
                    'password'      => Hash::make($mahasiswa->nim),
                    'email'         => $mahasiswa->email,
                    'role'          => $mahasiswa->role,
                    'is_active'     => $mahasiswa->is_active,
                    'mahasiswa_id'  => $mahasiswa->id,
                ]);
            });

            // Mengembalikan respon sukses
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Gagal menambahkan mahasiswa baru: ' . $e->getMessage());

            // Mengembalikan respon error
            return response()->json([
                'status'    => 'error',
                'message'   => 'Gagal menambahkan admin baru'
            ], 500);
        }

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        //return redirect('/data-pengguna/mahasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa  = DB::table('mahasiswa')->where('id', $id)->first();
        return view('pages.contents.admin.data-mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData  = $request->validate([
            'nim'               => 'required',
            'nama'              => 'required',
            'control-kelas'     => 'required',
            'control-jurusan'   => 'required',
            'email'             => 'required|email',
            'telp'              => 'required',
            'alamat'            => 'required'
        ]);

        // Mencari mahasiswa berdasarkan id
        $mahasiswa  = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json([
                'status'    => 'error',
                'message'   =>  'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($validatedData, $mahasiswa) {
            // Update data mahasiswa
            $mahasiswa->update([
                'nim'       => $validatedData['nim'],
                'nama'      => $validatedData['nama'],
                'kelas'     => $validatedData['control-kelas'],
                'jurusan'   => $validatedData['control-jurusan'],
                'email'     => $validatedData['email'],
                'telp'      => $validatedData['telp'],
                'alamat'    => $validatedData['alamat'],
            ]);

            // Update secara atomik di tabel user mahasiswa
            $user   = User::where('mahasiswa_id', $mahasiswa->id)->first();
            if ($user) {
                $user->update([
                    'username'  => $mahasiswa->nip,
                    'nama'      => $mahasiswa->nama,
                    'email'     => $mahasiswa->email,
                ]);
            }
        });

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        // return redirect('/data-pengguna/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari mahasiswa berdasarkan id
        $mahasiswa  = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json([
                'status'    => 'error',
                'message'   =>  'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($mahasiswa) {
            // Hapus secara atomik di tabel user mahasiswa
            $user   = User::where('mahasiswa_id', $mahasiswa->id)->first();
            if ($user) {
                $user->delete();
            }

            // Hapus data mahasiswa
            $mahasiswa->delete();
        });

        return redirect('/data-pengguna/mahasiswa');
    }
}
