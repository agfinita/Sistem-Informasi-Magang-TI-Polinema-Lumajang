<?php

namespace App\Http\Controllers;
use App\Http\Controllers\HomeController;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengumumanDosenSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pengumuman = Pengumuman::select('id', 'created_by', 'judul', 'deskripsi', 'kategori', 'created_at')
                ->orderBy('id', 'DESC')
                ->get();

        // Menghitung total pengumuman
        $totalPengumuman    = Pengumuman::count();

        // Membuat instance dari HomeController
        $homeController = new HomeController();
        // Panggil method untuk menghitung total bimbingan dosen
        $totalBimbingan = $homeController->statistikDashboardDosen()['total_bimbingan'];
        $totalSelesai = $homeController->statistikDashboardDosen()['total_selesai'];

        return view('pages.contents.dosen.index', compact('pengumuman', 'totalPengumuman', 'totalBimbingan', 'totalSelesai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pages.contents.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validatedData  = Validator::make($request->all(), [
            'judul'         => 'required',
            'desc'          => 'required',
            'cat'           => 'required',
            'creator'       => 'required',
            'date_created'  => 'required|date'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                    'status'    => 'error',
                    'errors'    => $validatedData->errors()
            ], 422);
        }

        // Menyimpan hasil validasi yang sukses
        $validated  = $validatedData->validated();

        // Menyimpan ke dalam database
        DB::table('pengumuman')->insert([
            'judul'         => $validated['judul'],
            'deskripsi'     => strip_tags($validated['desc'], '<a><b><u>'),
            'kategori'      => $validated['cat'],
            'created_by'    => $validated['creator'],
            'created_at'    => $validated['date_created']
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status'  => 'success']);

        // Redirect halaman
        //return redirect('/dosen/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $pengumuman = Pengumuman::find($id);

        if(!$pengumuman) {
            return redirect('/dosen/dashboard')->with('error', 'Data tidak ditemukan');
        }

        return view('pages.contents.dosen.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validatedData  = $request->validate([
            'judul'         => 'required',
            'desc'          => 'required',
            'cat'           => 'required',
            'creator'       => 'required',
            'date_created'  => 'required|date'
        ]);

        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Data tidak ditemukan'
            ], 404);
        }

        $pengumuman->update([
            'judul'         => $validatedData['judul'],
            'deskripsi'     => $validatedData['desc'],
            'kategori'      => $validatedData['cat'],
            'created_by'    => $validatedData['creator'],
            'created_at'    => $validatedData['date_created']
        ]);

        // Mengembalikan respon sukses
        return response()->json(['status'  =>  'success']);

        //return redirect('/dosen/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $pengumuman = DB::table('pengumuman')->where('id', $id)->first();

        if ($pengumuman) {
            $pengumuman = DB::table('pengumuman')->where('id', $id)->delete();

            return redirect('/dosen/dashboard');
        }

        return redirect('/dosen/dashboard')->with('error', 'Data tidak ditemukan');
    }
}
