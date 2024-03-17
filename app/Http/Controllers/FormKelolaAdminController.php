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
    public function index() {
        return view('pages.contents.form-kelola-admin');
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
            'date_created'  => 'required|date',
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
        return redirect('/kelolaAdmin')->with('status');
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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
