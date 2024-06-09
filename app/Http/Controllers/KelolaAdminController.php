<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class KelolaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users  = DB::table('users')
                    ->select('id', 'nama', 'username', 'email', 'role', 'is_active', 'created_at', 'updated_at')
                    ->orderBy('users.nama', 'asc')
                    ->where('role', 'admin')->get();

        return view('pages.contents.admin.kelola-admin.index', compact('users'));
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
        $validatedData  = Validator::make($request->all(), [
            'username'      => 'required',
            'email'         => 'required|email',
            'password'      => 'required|min:8',
            'gridRadios'    => 'required|in:Admin,Mahasiswa,Dosen',
            'date_created'  => 'date'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status'    => 'error',
                'errors'    => $validatedData->errors()
            ], 422);
        }

        $validatedData      = $validatedData->validated();

        DB::transaction( function () use ($validatedData) {
            // Menyimpan data user baru
            $users   = User::create([
                'username'      => $validatedData['username'],
                'email'         => $validatedData['email'],
                'password'      => $validatedData['password'],
                'role'          => $validatedData['gridRadios'],
                'created_at'    => $validatedData['date_ceated']
            ]);

            // Menyimpan data admin baru terkait user
            Admin::create([
                'nip'       => $users->username,
                'nama'      => $users->nama,
                'email'     => $users->email,
                'role'      => $users->role
            ]);
        });

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        //return redirect('/tableUserAdmin')->with('status', 'Data added!');
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
        return view('pages.contents.admin.kelola-admin.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData  = $request->validate([
            'username'          => 'required',
            'email'             => 'required|email',
            'gridRadios-status' => 'required|boolean',
            'date_created'      => 'date',
            'updated_at'        => 'date'
        ]);

        // Mencari user berdasarkan id
        $users  = User::find($id);
        if (!$users) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Data tidak ditemukan'
            ], 404);
        }

        DB::transaction( function () use ($validatedData, $users) {
            // Update data user
            $users->update([
                'username'      => $validatedData['username'],
                'email'         => $validatedData['email'],
                'is_active'     => $validatedData['gridRadios-status'],
                'created_at'    => $validatedData['date_created'],
                'updated_at'    => $validatedData['date_updated']
            ]);

            // Update data admin terkait user
            $admin  = Admin::where('nip', $users->username)->first();
            if ($admin) {
                $admin->update([
                    'nip'       => $users->username,
                    'email'     => $users->email,
                    'is_active' => $users->is_active
                ]);
            }
        });

        // Mengembalikan respon sukses
        return response()->json(['status' => 'success']);

        // Redirect halaman: sudah ada di modules.sweetalert.js
        //return redirect('/kelola-pengguna/admin');
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
            // Hapus data admin terkait user
            $admin  = Admin::where('nip', $users->username)->first();
            if ($admin) {
                $admin->delete();
            }

            // Hapus data user
            $users->delete();
        });

        return redirect('/kelola-pengguna/admin');
        // Mengembalikan respon sukses
        // return response()->json([
        //     'status' => 'success'
        // ]);
    }
}
