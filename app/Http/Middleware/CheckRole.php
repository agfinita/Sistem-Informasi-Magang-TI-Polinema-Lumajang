<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Cek apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Jika pengguna sudah berada pada rute yang sesuai, lanjutkan permintaan
        if ($request->is('mahasiswa/*') && auth()->user()->role == 'Mahasiswa') {
            return $next($request);
        }

        if ($request->is('dosen/*') && auth()->user()->role == 'Dosen') {
            return $next($request);
        }

        // Authorization
        $role   = auth()->user()->role;
        switch ($role) {
            case 'Admin':
                return $next($request);
            case 'Mahasiswa':
                return redirect('/mahasiswa/dashboard');
            case 'Dosen':
                return redirect('/dosen/dashboard');
            default:
            abort(403, 'Unauthorized action.');
        }
    }
}
