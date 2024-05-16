<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class FormKelolaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user) {
        $users = DB::table('users')
                    ->select('id','nama', 'username', 'email', 'role', 'is_active', 'created_at', 'updated_at')
                    ->orderBy('users.nama', 'ASC')
                    ->where('role', 'admin')->get();
        return view ('pages.contents.admin.kelola-admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.contents.admin.form-kelola-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData  = $request->validate([
            'username'      => 'required',
            'email'         => 'required|email',
            'password'      => ['required', Password::min(8)],
            'gridRadios'    => 'required|in:Admin,Mahasiswa,Dosen',
            'date_created'  => 'date',
        ]);

        // menyimpan data ke database
        DB::table('users')->insert([
            'username'      => $validatedData['username'],
            'email'         => $validatedData['email'],
            'password'      => bcrypt($validatedData['password']),
            'role'          => $validatedData['gridRadios'],
            'created_at'    => $validatedData['date_created']
        ]);

        // redirect ke halaman
        return redirect('/tableUserAdmin')->with('status', 'Data added!');
    }

    /**
     * Display the specified resource.
     */
    public function show() {
        return view('pages.contents.admin.form-kelola-admin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $users  = DB::table('users')->where('id', $id)->first();
        return view('pages.contents.admin.kelola-admin.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {

        $validatedData  = $request->validate([
            'username'              => 'required',
            'email'                 => 'required',
            'gridRadios-status'     => 'required',
            'gridRadios'            => 'required',
            'date_created'          => 'date',
            // 'date_updated'          => 'date',
        ]);

        $users      = DB::table('users')->where('id', $id)->first();
        $is_active  = $users->is_active;

        if($is_active === 1 && $validatedData['gridRadios-status'] === 0) {
            //jika user diubah non-active
            $validatedData['gridRadios-status'] = 0;
        }

        $users  = DB::table('users')->where('id', $id)->update([
            'username'      => $validatedData['username'],
            'email'         => $validatedData['email'],
            'is_active'     => $validatedData['gridRadios-status'],
            'role'          => $validatedData['gridRadios'],
            'created_at'    => $validatedData['date_created'],
            // 'updated_at'    => $validatedData['date_updated']
        ]);

        if ($users) {
            return redirect('/kelola-pengguna/admin')->with('status', 'Data updated successfully.');
        } else {
            return redirect('/kelola-pengguna/admin')->with('error', 'Failed to updated data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $users  = DB::table('users')->where('id', $id)->first();

        if($users) {
            $users  = DB::table('users')->where('id', $id)->delete();

            return redirect('/kelola-pengguna/admin')->with('status', 'Data berhasil dihapus.');
        }

        return redirect('/kelola-pengguna/admin')->with('error', 'Data tidak ditemukan.');
    }
}
