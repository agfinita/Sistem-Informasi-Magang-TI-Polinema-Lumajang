<?php

namespace App\Http\Controllers;

use App\Models\LaporanMagang;
use Illuminate\Http\Request;

class LaporanMagangAdminSideController extends Controller
{
    // Menampilkan status laporan magang mahasiswa
    public function index() {
        $laporanMagang  = LaporanMagang::select('mahasiswa_id','status_laporan')
                            ->with('mahasiswa')
                            ->orderBy('status_laporan', 'asc')
                            ->get();

        return view('pages.contents.admin.laporan-magang.index', compact('laporanMagang'));
    }
}
