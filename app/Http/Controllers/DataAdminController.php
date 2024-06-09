<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin  = Admin::select(
            'id', 'nip', 'nama', 'email', 'telp', 'alamat', 'role'
        )
        ->where('is_active', 1)
        ->orderBy('nama', 'asc')->get();

        return view('pages.contents.admin.data-admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contents.admin.data-admin.create');
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
            // Menyimpan data ke database admin
            DB::transaction(function () use ($validated) {
                // Tambah data admin baru
                $admin = Admin::create([
                    'nip'       => $validated['nip'],
                    'nama'      => $validated['nama'],
                    'email'     => $validated['email'],
                    'telp'      => $validated['telp'],
                    'alamat'    => $validated['alamat'],
                    'role'      => 'Admin',
                    'is_active' => 1,
                ]);

                // Tambah secara atomik di tabel user admin
                User::create([
                    'username'  => $admin->nip,
                    'nama'      => $admin->nama,
                    'password'  => Hash::make($admin->nip),
                    'email'     => $admin->email,
                    'role'      => $admin->role,
                    'is_active' => $admin->is_active,
                    'admin_id'  => $admin->id,
                ]);
            });

            // Mengembalikan respon sukses
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Gagal menambahkan admin baru: ' . $e->getMessage());

            // Mengembalikan respon error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan admin baru'
            ], 500);
        }

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success' ]);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        //return redirect('/data-pengguna/admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = DB::table('admin')->where('id', $id)->first();
        return view('pages.contents.admin.data-admin.edit', compact('admin'));
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

        // Mencari admin berdasarkan id
        $admin  = Admin::find($id);
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($validatedData, $admin) {
            // Update data admin
            $admin->update([
                'nip'       => $validatedData['nip'],
                'nama'      => $validatedData['nama'],
                'email'     => $validatedData['email'],
                'telp'      => $validatedData['telp'],
                'alamat'    => $validatedData['alamat'],
            ]);

            // Update secara atomik di tabel user admin
            $user   = User::where('admin_id', $admin->id)->first();
            if ($user) {
                $user->update([
                    'username'  => $admin->nip,
                    'nama'      => $admin->nama,
                    'email'     => $admin->email,
                ]);
            }
        });

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        // return redirect('/data-pengguna/admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari admin berdasar id
        $admin  = Admin::find($id);
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($admin) {
            // Hapus secara atomik di tabel user admin
            $user   = User::where('admin_id', $admin->id)->first();
            if ($user) {
                $user->delete();
            }

            // Hapus data admin
            $admin->delete();
        });

        return redirect('/data-pengguna/admin');
    }
}
