<?php

use App\Http\Controllers\BimbinganAdminSideController;
use App\Http\Controllers\BimbinganDosenSideController;
use App\Http\Controllers\BimbinganMahasiswaSideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\KelolaDosenController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\KelolaMahasiswaController;
use App\Http\Controllers\LogbookDosenSideController;
use App\Http\Controllers\LogbookAdminSideController;
use App\Http\Controllers\DataMagangAdminSideController;
use App\Http\Controllers\DataMagangDosenSideController;
use App\Http\Controllers\PengumumanAdminSideController;
use App\Http\Controllers\PengumumanDosenSideController;
use App\Http\Controllers\LogbookMahasiswaSideController;
use App\Http\Controllers\DataBimbinganAdminSideController;
use App\Http\Controllers\DataBimbinganDosenSideController;
use App\Http\Controllers\LaporanMagangDosenSideController;
use App\Http\Controllers\DataMagangMahasiswaSideController;
use App\Http\Controllers\LaporanMagangAdminSideController;
use App\Http\Controllers\PengajuanMagangAdminSideController;
use App\Http\Controllers\LaporanMagangMahasiswaSideController;
use App\Http\Controllers\PengajuanMagangMahasiswaSideController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Middleware
Route::group(['middleware' => 'role'], function () {

    Route::get('/notifications/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    // AUTH ADMIN
    // Menampilkan dashboard simag admin
    Route::get('/', [HomeController::class, 'statistikDashboardAdmin']);

    //KELOLA PENGGUNA
    // Admin
    Route::resource('/kelola-pengguna/admin', KelolaAdminController::class)->except('show', 'store', 'create');
    Route::get('/kelola-pengguna/admin/edit/{id}', [KelolaAdminController::class, 'edit']);
    Route::patch('/kelola-pengguna/admin/edit/{id}', [KelolaAdminController::class, 'update']);
    // Mahasiswa
    Route::resource('/kelola-pengguna/mahasiswa', KelolaMahasiswaController::class)->except('show', 'create' ,'store');
    Route::get('/kelola-pengguna/mahasiswa/edit/{id}', [KelolaMahasiswaController::class, 'edit']);
    Route::patch('/kelola-pengguna/mahasiswa/edit/{id}', [KelolaMahasiswaController::class, 'update']);
    // Dosen
    Route::resource('/kelola-pengguna/dosen', KelolaDosenController::class)->except('show', 'create', 'store');
    Route::get('/kelola-pengguna/dosen/edit/{id}', [KelolaDosenController::class,'edit']);
    Route::patch('/kelola-pengguna/dosen/edit/{id}', [KelolaDosenController::class, 'update']);

    // DATA PENGGUNA
    // Admin
    Route::resource('/data-pengguna/admin', DataAdminController::class)->except('show');
    Route::get('/data-pengguna/admin/edit/{id}', [DataAdminController::class,'edit']);
    Route::patch('/data-pengguna/admin/edit/{id}', [DataAdminController::class, 'update']);
    // Mahasiswa
    Route::resource('/data-pengguna/mahasiswa', DataMahasiswaController::class)->except('show');
    Route::get('/data-pengguna/mahasiswa/edit/{id}', [DataMahasiswaController::class,'edit']);
    Route::patch('/data-pengguna/mahasiswa/edit/{id}', [DataMahasiswaController::class, 'update']);
    // Dosen
    Route::resource('/data-pengguna/dosen', DataDosenController::class)->except('show');
    Route::get('/data-pengguna/dosen/edit/{id}', [DataDosenController::class,'edit']);
    Route::patch('/data-pengguna/dosen/edit/{id}', [DataDosenController::class, 'update']);

    // PENGUMUMAN
    Route::resource('/pengumuman', PengumumanAdminSideController::class)->except('show');
    Route::get('/pengumuman/edit/{id}', [PengumumanAdminSideController::class,'edit']);
    Route::patch('/pengumuman/edit/{id}', [PengumumanAdminSideController::class,'update']);

    // DATA MAGANG - Admin Side
    Route::resource('/admin/data-magang', DataMagangAdminSideController::class)->except('create', 'edit', 'update', 'store');
    Route::get('/admin/data-magang/show/{id}', [DataMagangAdminSideController::class, 'show']);

    // PENGAJUAN MAGANG - Admin Side
    Route::resource('/admin/mahasiswa/pengajuan-magang', PengajuanMagangAdminSideController::class)->except('show', 'update', 'edit');
    Route::get('/admin/mahasiswa/pengajuan-magang/create/{id}', [PengajuanMagangAdminSideController::class,'create']);
    Route::post('/admin/mahasiswa/pengajuan-magang/store/{id}', [PengajuanMagangAdminSideController::class,'store']);

    // DATA BIMBINGAN MAHASISWA -Admin Side
    Route::resource('/admin/data-bimbingan-mahasiswa', DataBimbinganAdminSideController::class)->except('create', 'store', 'show', 'destroy');
    Route::get('/admin/data-bimbingan-mahasiswa/edit/{id}', [DataBimbinganAdminSideController::class, 'edit']);
    Route::patch('/admin/data-bimbingan-mahasiswa/edit/{id}', [DataBimbinganAdminSideController::class, 'update']);

    // LAPORAN MAGANG - Admin Side
    Route::get('/admin/laporan-magang-mahasiswa', [LaporanMagangAdminSideController::class, 'index']);

    // LOGBOOK - Admin Side
    Route::resource('/admin/logbook', LogbookAdminSideController::class)->except('create', 'store', 'edit', 'update', 'destroy');
    Route::get('/admin/logbook/show/{id}', [LogbookAdminSideController::class, 'show']);

    // BIMBINGAN - Admin Side
    Route::resource('/admin/bimbingan', BimbinganAdminSideController::class)->except('create', 'store', 'edit', 'update', 'destroy');
    Route::get('/admin/bimbingan/show/{id}', [BimbinganAdminSideController::class, 'show']);


    // AUTH MAHASISWA
    // Menampilkan dashboard simag mahasiswa
    Route::get('/mahasiswa/dashboard', [HomeController::class, 'index']);
    Route::get('/mahasiswa/dashboard/{id}', [HomeController::class, 'showPengumumanMhs']);

    // PENGAJUAN MAGANG - Mahasiswa Side
    Route::resource('/mahasiswa/pengajuan-magang', PengajuanMagangMahasiswaSideController::class)->except('show', 'update', 'destroy', 'edit');

    // DDATA MAGANG - Mahasiswa Side
    Route::resource('/mahasiswa/data-magang', DataMagangMahasiswaSideController::class)->except('show', 'destroy');
    Route::get('/mahasiswa/data-magang/edit/{id}', [DataMagangMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/data-magang/edit/{id}', [DataMagangMahasiswaSideController::class, 'update']);

    // LAPORAN MAGANG - Mahasiswa Side
    Route::resource('/mahasiswa/laporan-magang', LaporanMagangMahasiswaSideController::class)->except('show', 'create', 'store', 'destroy');
    Route::get('/mahasiswa/laporan-magang/edit/{id}', [LaporanMagangMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/laporan-magang/edit/{id}', [LaporanMagangMahasiswaSideController::class, 'update']);

    // LOGBOOK - Mahasiswa Side
    Route::resource('/mahasiswa/logbook', LogbookMahasiswaSideController::class)->except('show');
    Route::get('/mahasiswa/logbook/edit/{id}', [LogbookMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/logbook/edit/{id}', [LogbookMahasiswaSideController::class, 'update']);

    // BIMBINGAN- Mahasiswa Side
    Route::resource('/mahasiswa/bimbingan', BimbinganMahasiswaSideController::class)->except('show');
    Route::get('/mahasiswa/bimbingan/edit/{id}', [BimbinganMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/bimbingan/edit/{id}', [BimbinganMahasiswaSideController::class, 'update'])->name('mahasiswa.bimbingan.update');


    // Auth DOSEN
    // Menampilkan dashboard simag dosen
    Route::resource('/dosen/dashboard', PengumumanDosenSideController::class)->except('show');
    Route::get('/dosen/dashboard/edit/{id}', [PengumumanDosenSideController::class,'edit']);
    Route::patch('/dosen/dashboard/edit/{id}', [PengumumanDosenSideController::class,'update']);

    // DATA MAGANG MAHASISWA - Dosen Side
    Route::get('/dosen/data-magang-mahasiswa', [DataMagangDosenSideController::class, 'index']);
    // Modal
    Route::get('/dosen/data-magang-mahasiswa/{id}', [DataMagangDosenSideController::class, 'showDataMagangMhs']);

    // LAPORAN MAGANG - Dosen Side
    Route::resource('/dosen/laporan-magang-mahasiswa', LaporanMagangDosenSideController::class)->except('create', 'store', 'destroy');
    Route::get('/dosen/laporan-magang-mahasiswa/edit/{id}', [LaporanMagangDosenSideController::class, 'edit']);
    Route::patch('/dosen/laporan-magang-mahasiswa/edit/{id}', [LaporanMagangDosenSideController::class, 'update']);
    Route::get('/dosen/laporan-magang-mahasiswa/show/{id}', [LaporanMagangDosenSideController::class, 'show']);

    // lOGBOOK - Dosen Side
    Route::resource('/dosen/logbook-mahasiswa', LogbookDosenSideController::class)->except('create', 'store', 'destroy', 'edit', 'update');
    Route::get('/dosen/logbook-mahasiswa/show/{data_magang_id}', [LogbookDosenSideController::class, 'show']);
    //Route::get('/dosen/logbook-mahasiswa/edit/{id}', [LogbookDosenSideController::class, 'edit']);
    Route::patch('/dosen/logbook-mahasiswa/edit/{id}', [LogbookDosenSideController::class, 'update']);
    Route::post('dosen/logbook-mahasiswa/validasi', [LogbookDosenSideController::class, 'validasi']);

    // BIMBINGAN - Dosen Side
    Route::resource('/dosen/bimbingan-mahasiswa', BimbinganDosenSideController::class)->except('create', 'store', 'destroy', 'edit', 'update');
    Route::get('/dosen/bimbingan-mahasiswa/show/{data_magang_id}', [BimbinganDosenSideController::class, 'show']);
    //Route::get('/dosen/bimbingan-mahasiswa/edit/{id}', [BimbinganDosenSideController::class, 'edit']);
    Route::patch('/dosen/bimbingan-mahasiswa/edit/{id}', [BimbinganDosenSideController::class, 'update']);
    Route::post('/dosen/bimbingan-mahasiswa/validasi', [BimbinganDosenSideController::class, 'validasi']);
});

// Login
Route::get('/login', [HomeController::class, 'masuk'])->name('login')->middleware('guest');
Route::post('/prosesLogin', [HomeController::class, 'authenticate']);

//Logout
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// Menampilkan lupa password
Route::get('/forgot', function() {
    return view('pages.contents.auth-forgot-password');
});

// Menampilkan reset password
Route::get('/reset', function() {
    return view('pages.contents.auth-reset-password');
});
