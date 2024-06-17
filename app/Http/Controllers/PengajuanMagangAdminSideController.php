<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanMagangAdminSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pengajuanMagang = DB::table('pengajuan_magang')
                    ->select('id','mahasiswa_id', 'instansi_magang', 'alamat_magang', 'status')
                    ->whereIn('status', ['diproses', 'selesai'])
                    ->orderByRaw("CASE WHEN status = 'diproses' THEN 0 ELSE 1 END")
                    ->orderBy('status')
                    ->get();
        return view ('pages.contents.admin.pengajuan-magang.index', compact('pengajuanMagang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id) {
        $pengajuanMagang = PengajuanMagang::findOrFail($id);
        return view ('pages.contents.admin.pengajuan-magang.create', compact('pengajuanMagang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id) {
        // Validasi input
        $validatedData = $request->validate([
            'file'   => 'required|file|mimes:doc,docx,pdf',
            'status' => 'required|in:diproses,selesai'
        ]);

        // Mencari data pengajuan magang berdasarkan id
        $pengajuanMagang = PengajuanMagang::findOrFail($id);

        // Jika ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate nama file unik
            $originalname   = $file->getClientOriginalName();
            $filename       = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path = $file->storeAs('uploads', $filename, 'public');

            // Hapus file lama jika ada
            if ($pengajuanMagang->files) {
                $oldFilePath = public_path('storage/' . $pengajuanMagang->files);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Simpan path ke dalam database
            $pengajuanMagang->files = $path;
        }

        // Menyimpan ke database
        $pengajuanMagang->status = $validatedData['status'];
        $pengajuanMagang->save();

        // Mengambil data pengajuan magang berdasarkan $id
        $pengajuanMagang = PengajuanMagang::find($id);
        // Jika pengajuan magang ditemukan
        if ($pengajuanMagang) {
            // Mengambil data mahasiswa berdasarkan nim dari pengajuan magang
            $mahasiswa = Mahasiswa::where('nim', $pengajuanMagang->nim)->first();
            // Jika mahasiswa ditemukan
            if ($mahasiswa) {
                // Buat notifikasi untuk mahasiswa
                Notification::create([
                    'user_id'   => $mahasiswa->id, // Menggunakan id mahasiswa
                    'type'      => 'respon_pengajuan',
                    'message'   => 'Pengajuan magang Anda telah direspon oleh admin.',
                ]);
            }
        }


        // Mengembalikan respon sukses
        return response()->json([ 'status'  => 'success' ]);

        // return redirect('/admin/mahasiswa/pengajuan-magang')->with('success', 'Success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanMagang $pengajuanMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanMagang $pengajuanMagang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanMagang $pengajuanMagang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $pengajuanMagang    = PengajuanMagang::find($id);

        if($pengajuanMagang) {
            $filepath           = $pengajuanMagang->files; //path file yang akan dihapus

            // Hapus file dari local storage
            if ($filepath && Storage::disk('public')->exists($filepath)) {
                Storage::disk('public')->delete($filepath);
            }
            // if (Storage::disk('public')->exists($filepath)) {
            //     Storage::disk('public')->delete($filepath);
            // }

            // Hapus data
            $pengajuanMagang->delete();

            return redirect ('/admin/mahasiswa/pengajuan-magang')->with('status', 'Data deleted successfully!');
        }

        return redirect('/admin/mahasiswa/pengajuan-magang')->with('error', 'Data gagal dihapus.');
    }
}
