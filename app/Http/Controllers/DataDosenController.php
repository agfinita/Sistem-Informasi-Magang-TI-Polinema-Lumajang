<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen  = Dosen::select(
            'id', 'nip', 'nama', 'email', 'telp', 'alamat', 'role'
        )
        ->where('is_active', 1)
        ->orderBy('nama', 'asc')->get();

        return view('pages.contents.admin.data-dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contents.admin.data-dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nip'       => 'required',
            'nama'      => 'required',
            'email'     => 'required|email',
            'telp'      => 'required',
            'alamat'    => 'required',
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
                // Tambah data dosen baru
                $dosen  = Dosen::create([
                    'nip'       => $validated['nip'],
                    'nama'      => $validated['nama'],
                    'email'     => $validated['email'],
                    'telp'      => $validated['telp'],
                    'alamat'    => $validated['alamat'],
                    'role'      => 'Dosen',
                    'is_active' => 1,
                ]);

                // Tambah secara atomik di tabel user dosen
                User::create([
                    'username'  => $dosen->nip,
                    'nama'      => $dosen->nama,
                    'password'  => Hash::make($dosen->nip),
                    'email'     => $dosen->email,
                    'role'      => $dosen->role,
                    'is_active' => $dosen->is_active,
                    'dosen_id'  => $dosen->id,
                ]);
            });

            // Mengembalikan respon sukses
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Gagal menambahkan dosen baru: ' . $e->getMessage());

            // Mengembalikan respon error
            return response()->json([
                'status'    => 'error',
                'message'   => 'Gagal menambahkan dosen baru'
            ], 500);
        }

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        //return redirect('/data-pengguna/dosen');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dosen  = DB::table('dosen')->where('id', $id)->first();
        return view('pages.contents.admin.data-dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData  = $request->validate([
            'nip'       => 'required',
            'nama'      => 'required',
            'email'     => 'required|email',
            'telp'      => 'required',
            'alamat'    => 'required'
        ]);

        // Mencari dosen berdasarkan id
        $dosen  = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($validatedData, $dosen) {
            // Update data dosen
            $dosen->update([
                'nip'       => $validatedData['nip'],
                'nama'      => $validatedData['nama'],
                'email'     => $validatedData['email'],
                'telp'      => $validatedData['telp'],
                'alamat'    => $validatedData['alamat'],
            ]);

            // Update secara atomik di tabel user dosen
            $user   = User::where('dosen_id', $dosen->id)->first();
            if ($user) {
                $user->update([
                    'username'  => $dosen->nip,
                    'nama'      => $dosen->nama,
                    'email'     => $dosen->email,
                ]);
            }
        });

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        // return redirect('/data-pengguna/dosen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Mencari dosen berdasar id
        $dosen  = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($dosen) {
            // Hapus secara atomik di tabel user dosen
            $user   = User::where('dosen_id', $dosen->id)->first();
            if ($user) {
                $user->delete();
            }

            // Hapus data dosen
            $dosen->delete();
        });

        return redirect('/data-pengguna/dosen');
    }
}
