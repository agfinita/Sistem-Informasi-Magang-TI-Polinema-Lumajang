<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
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
        $credentials   = $request->only('username', 'password');

        // Proses pengecekan login
        if(Auth::attempt($credentials)) {
            $user   = Auth::user();

            // Cek apakah pengguna aktif
            if ($user->is_active != 1) {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun sudah tidak aktif.');
            }

            // Pemeriksaan session
            $request->session()->regenerate();

            // Cek role pengguna setelah login
            $role   = $user->role;
            switch ($role) {
                case 'Admin':
                    return redirect()->intended('/');
                case 'Mahasiswa':
                    return redirect('mahasiswa/dashboard');
                case 'Dosen':
                    return redirect('dosen/dashboard');
                default:
                    abort(403, 'Unauthorized action');
            }
        }
        return back()
        ->withInput($request->only('username'))
        ->withErrors(['username'  => 'Username atau password salah!']);
    }

    //Logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();  //menghapus sesi

        $request->session()->regenerateToken(); //generate token baru

        return redirect('/');
    }

    // Dashboard mahasiswa
    public function index() {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('pages.contents.mahasiswa.index', compact('pengumuman'));
    }

    public function showPengumumanMhs($id) {
        $pengumuman = Pengumuman::find($id);

        if ($pengumuman) {
            return response()->json($pengumuman);
        } else {
            return response()->json(['error'], 404);
        }
    }
}
