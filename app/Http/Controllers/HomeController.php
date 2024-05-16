<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class HomeController extends Controller {

    // Menampilkan halaman login
    public function masuk() {
        return view('pages.contents.auth-login');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'username'  => 'required',
            'password'  => ['required', Password::min(8)]
        ]);

        // Save input ketika berhasil divalidasi
        $credentials   = [
            'username'  => $request->username,
            'password'  => $request->password
        ];

        //proses pengecekan login
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role pengguna setelah login
            $role   = Auth::user()->role;
            switch ($role) {
                case 'Admin':
                    return redirect()->intended('/');
                case 'Mahasiswa':
                    return redirect('/mahasiswa/dashboard');
                case 'Dosen':
                    return redirect('/dosen/dashboard');
                default:
                abort(403, 'Unauthorized action.');
            }
        }

        return back()->with('error', 'Username atau password salah!');
    }

    //Logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();  //menghapus sesi

        $request->session()->regenerateToken(); //generate token baru

        return redirect('/');
    }
}