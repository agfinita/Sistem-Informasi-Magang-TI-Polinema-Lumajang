<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Models\DataBimbingan;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataMagangMahasiswaSideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data milik mahasiswa yang sedang login
        $mahasiswa_id = auth()->user()->username;

        // Cek apakah data magang untuk mahasiswa ini sudah ada
        $dataMagangExists = DataMagang::where('mahasiswa_id', $mahasiswa_id)->exists();

        // Kemudian cari mahasiswa yang login di tabel data magang dan relasinya dengan tabel mahasiswa dan tabel pengajuan_magang
        $dataMagang = DataMagang::where('mahasiswa_id', $mahasiswa_id)
            ->with('mahasiswa', 'pengajuanMagang')
            ->get();

        // Ambil bimbingan berdasarkan mahasiswa yang login
        $dataBimbingan  = DataBimbingan::where('mahasiswa_id', $mahasiswa_id)
                            ->with('dosen')
                            ->first();
        // Jika data bimbingan tidak ada, buat objek kosong untuk menghindari error
        if (!$dataBimbingan) {
            $dataBimbingan          = new \stdclass();
            $dataBimbingan->dosen   = null;
        }

        return view('pages.contents.mahasiswa.data-magang.index', compact('dataMagang', 'dataBimbingan', 'dataMagangExists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil user yang sedang login
        $user   = Auth::user();

        // Cari data mahasiswa berdasarkan username yang login
        $mahasiswa          = Mahasiswa::where('nim', $user->username)->first();
        // Jika mahasiswa ditemukan ambil data pengajuan magangnya
        if ($mahasiswa) {
            $pengajuanMagang    = PengajuanMagang::where('mahasiswa_id', $mahasiswa->nim)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
        } else {
            $pengajuanMagang    = null;
        }

        return view('pages.contents.mahasiswa.data-magang.create', compact('mahasiswa', 'pengajuanMagang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData  = $request->validate([
            'nim'               => 'required|exists:mahasiswa,nim',
            'kategori'          => 'required',
            'period'            => 'required',
            'tm'                => 'required',
            'ts'                => 'required',
            'file'              => 'required|file|mimes:docx,doc,pdf'
        ]);

        // Handle upload file
        if ($request->hasFile('file')) {
            $file           = $request->file('file');

            // Generate nama file unik
            $originalname   = $file->getClientOriginalName();
            $filename   = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path       = $file->storeAs('uploads', $filename, 'public');

            // Simpan path ke dalam database
            $validatedData['file']  = $path;
        }

        // Ambil pengajuan magang terbaru berdasarkan nim
        $pengajuanMagang = PengajuanMagang::where('mahasiswa_id', $validatedData['nim'])
            ->orderBy('created_at', 'desc')
            ->first();

        DB::transaction(function () use ($validatedData, $pengajuanMagang) {
            // Buat data magang
            $dataMagang = DataMagang::create([
                'mahasiswa_id'          => $validatedData['nim'],
                'pengajuan_magang_id'   => $pengajuanMagang ? $pengajuanMagang->id : null,
                'kategori_magang'       => $validatedData['kategori'],
                'periode'               => $validatedData['period'],
                'tanggal_mulai'         => $validatedData['tm'],
                'tanggal_selesai'       => $validatedData['ts'],
                'status_magang'         => 'belum dimulai',
                'files'                 => $validatedData['file']
            ]);

            // Buat data bimbingan mahasiswa berdasarkan data magang yang dibuat
            DataBimbingan::updateOrCreate([
                'mahasiswa_id'      => $dataMagang->mahasiswa_id,
                'data_magang_id'    => $dataMagang->id,
            ]);
        });

        // Mengembalikan respon sukses
        return response()->json([ 'status'    => 'success' ]);

        // Redirect halaman
        //return redirect('/mahasiswa/data-magang')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataMagang $dataMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dm = DataMagang::with('mahasiswa', 'pengajuanMagang')->findOrFail($id);
        return view('pages.contents.mahasiswa.data-magang.edit', compact('dm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nim'               => 'required|exists:mahasiswa,nim',
            'kategori'          => 'required',
            'status_magang'     => 'required',
            'period'            => 'required',
            'tm'                => 'required|date',
            'ts'                => 'required|date',
            'file'              => 'nullable|file|mimes:docx,doc,pdf',
            'instansi_magang'   => 'required|max:255',
            'alamat_magang'     => 'required|max:255'
        ]);

        $dataMagang = DataMagang::findOrFail($id);  // cari data magang berdasar id

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Generate nama file unik
            $originalname = $file->getClientOriginalName();
            $filename = uniqid() . '_' . $originalname;

            // Menentukan lokasi penyimpanan
            $path = $file->storeAs('uploads', $filename, 'public');

            // Simpan path ke dalam database
            $validatedData['files'] = $path;

            // Hapus file lama jika ada
            if ($dataMagang->files) {
                $oldFilePath = public_path('storage/' . $dataMagang->files);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        } else {
            // Jika tidak ada file baru yang di-upload, jangan ubah field file
            unset($validatedData['files']);
        }

        DB::transaction( function () use ($validatedData, $dataMagang) {
            // Updata data magang
            $dataMagang->update([
                'kategori_magang'    => $validatedData['kategori'],
                'status_magang'      => $validatedData['status_magang'],
                'periode'            => $validatedData['period'],
                'tanggal_mulai'      => $validatedData['tm'],
                'tanggal_selesai'    => $validatedData['ts']
            ]);

            // Update pengajuan magang mahasiswa tersebut
            $pengajuanMagang    = PengajuanMagang::where('id', $dataMagang->pengajuan_magang_id)->first();
            if ($pengajuanMagang) {
                $pengajuanMagang->update([
                    'instansi_magang'   => $validatedData['instansi_magang'],
                    'alamat_magang'     => $validatedData['alamat_magang']
                ]);
            }
        });

        // Mengembalikan respon sukses
        return response()->json([ 'status' => 'success']);

        // return redirect('/mahasiswa/data-magang')->with('status', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataMagang $dataMagang)
    {
        //
    }
}
