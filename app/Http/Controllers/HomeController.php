<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class HomeController extends Controller {
    //login
    public function masuk() {
        return view('pages.contents.auth-login');
    }

    public function prosesMasuk(Request $request) {
        $request->validate([
            'username'  => 'required',
            'password'  => ['required', Password::min(8)]
        ]);

        //save input ketika berhasil divalidasi
        $data   = [
            'username'  => $request->username,
            'password'  => $request->password
        ];

        //proses pengecekan login
        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'username atau password salah!');
    }

    //logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();  //menghapus sesi

        $request->session()->regenerateToken(); //generate token baru

        return redirect('/');
    }
}
