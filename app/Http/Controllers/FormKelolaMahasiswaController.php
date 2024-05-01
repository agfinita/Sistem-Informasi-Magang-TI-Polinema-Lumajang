<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class FormKelolaMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // return view('pages.contents.form-kelola-mahasiswa');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // $validatedData = $request->validate([
        //     'username'      => 'required',
        //     'email'         => 'required|email',
        //     'password'      => ['required', Password::min(8)],
        //     'gridRadios'    => 'required|in:Admin,Mahasiswa,Dosen',
        //     'date_created'  => 'required|date',
        // ]);

        // // menyimpan data ke database
        // DB::table('users')->insert([
        //     'username'      => $validatedData['username'],
        //     'email'         => $validatedData['email'],
        //     'password'      => bcrypt($validatedData['password']),
        //     'role'          => $validatedData['gridRadios'],
        //     'created_at'    => $validatedData['date_created']
        // ]);

        // // redirect halaman
        // return redirect('/tableUserMahasiswa')->with('status');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        $users = DB::table('users')
                    ->select('id','username', 'nama', 'email', 'role', 'is_active', 'created_at', 'updated_at')
                    ->orderBy('users.nama', 'ASC')
                    ->where('role', 'mahasiswa')->get();
        return view('pages.contents.admin.table-user-mahasiswa', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $users  = DB::table('users')->where('id', $id)->first();
        return view('pages.contents.admin.update-user-mahasiswa', compact('users'));
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

        // Update data user
        $user = User::findOrFail($id);
        $user->username     = $validatedData['username'];
        $user->email        = $validatedData['email'];
        $user->role         = $validatedData['gridRadios'];
        $user->is_active    = $validatedData['gridRadios-status'];
        $user->save();

        // Update is_active di tabel Mahasiswa jika perlu
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();
        if ($mahasiswa) {
            $mahasiswa->updateIsActive($validatedData['gridRadios-status']);
        }

        return redirect('/tableUserMahasiswa')->with('status', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $users  = DB::table('users')->where('id', $id)->first();

        if ($users) {
            DB::table('users')->where('id', $id)->delete();

            return redirect('/tableUserMahasiswa')->with('status', 'Data deleted successfully.');
        }
        return redirect('/tableUserMahasiswa')->with('error', 'Data not found.');
    }
}
