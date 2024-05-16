<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class FormKelolaDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $users = DB::table('users')
            ->select('id', 'nama', 'username', 'email', 'role', 'is_active', 'created_at', 'updated_at')
            ->orderBy('users.nama', 'ASC')
            ->where('role', 'dosen')->get();
        return view('pages.contents.admin.kelola-dosen.index', compact('users'));
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
        $validatedData  = $request->validate([
            'username'      => 'required',
            'email'         => 'required|email',
            'password'      => ['required', Password::min(8)],
            'gridRadios'    => 'required|in:Admin,Mahasiswa,Dosen',
            'date_created'  => 'required:date',
        ]);

        // menyimpan data ke database
        DB::table('users')->insert([
            'username'      => $validatedData['username'],
            'email'         => $validatedData['email'],
            'password'      => bcrypt($validatedData['password']),
            'role'          => $validatedData['gridRadios'],
            'created_at'    => $validatedData['date_created']
        ]);

        // redirect halaman
        return redirect('/tableUserDosen')->with('status');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        return view('pages.contents.admin.form-kelola-dosen');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $users  = DB::table('users')->where('id', $id)->first();
        return view('pages.contents.admin.kelola-dosen.edit', compact('users'));
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

        // Update is_active di tabel Dosen jika perlu
        $dosen = Dosen::where('nip', $user->username)->first();
        if ($dosen) {
            $dosen->updateIsActive($validatedData['gridRadios-status']);
        }

        return redirect('/kelola-pengguna/dosen')->with('status', 'Data updated successfully.');

        // $users      = DB::table('users')->where('id', $id)->first();
        // $is_active  = $users->is_active;

        // if($is_active===1 && $validatedData['gridRadios-status'] === 0){
        //     //jika diubah non-active
        //     $validatedData['gridRadios-status'] = 0;

        // }

        // $users  = DB::table('users')->where('id', $id)->update([
        //     'username'      => $validatedData['username'],
        //     'email'         => $validatedData['email'],
        //     'is_active'     => $validatedData['gridRadios-status'],
        //     'role'          => $validatedData['gridRadios'],
        //     'created_at'    => $validatedData['date_created'],
        //     // 'updated_at'    => $validatedData['date_updated']
        // ]);

        // if ($users) {
        //     return redirect('/kelola-pengguna/dosen')->with('status', 'Data updated successfully.');
        // } else {
        //     return redirect('/kelola-pengguna/dosen')->with('error', 'Failed to updated data.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $users = DB::table('users')->where('id', $id)->first();

        if ($users) {
            DB::table('users')->where('id', $id)->delete();

            return redirect('/kelola-pengguna/dosen')->with('status', 'Data deleted successfully.');
        }

        return redirect('/kelola-pengguna/dosen')->with('error', 'Data not found.');
    }
}
