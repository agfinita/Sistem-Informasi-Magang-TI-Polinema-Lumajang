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

    //Kelola pengguna
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

    // Data Pengguna
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

    // Pengumuman
    Route::resource('/pengumuman', PengumumanAdminSideController::class)->except('show');
    Route::get('/pengumuman/edit/{id}', [PengumumanAdminSideController::class,'edit']);
    Route::patch('/pengumuman/edit/{id}', [PengumumanAdminSideController::class,'update']);

    // Data Magang - Admin Side
    Route::resource('/admin/data-magang', DataMagangAdminSideController::class)->except('show', 'create', 'edit', 'update', 'store');
    Route::get('/admin/data-magang/{id}', [DataMagangAdminSideController::class, 'showDataMagangMhs']);

    // Pengajuan Magang - Admin Side
    Route::resource('/admin/mahasiswa/pengajuan-magang', PengajuanMagangAdminSideController::class)->except('show', 'update', 'edit');
    Route::get('/admin/mahasiswa/pengajuan-magang/create/{id}', [PengajuanMagangAdminSideController::class,'create']);
    Route::post('/admin/mahasiswa/pengajuan-magang/store/{id}', [PengajuanMagangAdminSideController::class,'store']);

    // Data Bimbingan Mahasiswa -Admin Side
    Route::resource('/admin/data-bimbingan-mahasiswa', DataBimbinganAdminSideController::class)->except('create', 'store', 'show', 'destroy');
    Route::get('/admin/data-bimbingan-mahasiswa/edit/{id}', [DataBimbinganAdminSideController::class, 'edit']);
    Route::patch('/admin/data-bimbingan-mahasiswa/edit/{id}', [DataBimbinganAdminSideController::class, 'update']);

    // Laporan Magang - Admin Side
    Route::get('/admin/laporan-magang-mahasiswa', [LaporanMagangAdminSideController::class, 'index']);

    // Logbook - Admin Side
    Route::resource('/admin/logbook', LogbookAdminSideController::class)->except('create', 'store', 'edit', 'update', 'destroy');
    Route::get('/admin/logbook/show/{id}', [LogbookAdminSideController::class, 'show']);

    // Bimbingan - Admin Side
    Route::resource('/admin/bimbingan', BimbinganAdminSideController::class)->except('create', 'store', 'edit', 'update', 'destroy');
    Route::get('/admin/bimbingan/show/{id}', [BimbinganAdminSideController::class, 'show']);


    // AUTH MAHASISWA
    // Menampilkan dashboard simag mahasiswa
    Route::get('/mahasiswa/dashboard', [HomeController::class, 'index']);
    Route::get('/mahasiswa/dashboard/{id}', [HomeController::class, 'showPengumumanMhs']);

    // Pengajuan Magang
    Route::resource('/mahasiswa/pengajuan-magang', PengajuanMagangMahasiswaSideController::class)->except('show', 'update', 'destroy', 'edit');

    // Data Magang - Mahasiswa Side
    Route::resource('/mahasiswa/data-magang', DataMagangMahasiswaSideController::class)->except('show', 'destroy');
    Route::get('/mahasiswa/data-magang/edit/{id}', [DataMagangMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/data-magang/edit/{id}', [DataMagangMahasiswaSideController::class, 'update']);

    // Laporan Magang - Mahasiswa Side
    Route::resource('/mahasiswa/laporan-magang', LaporanMagangMahasiswaSideController::class)->except('show', 'create', 'store', 'destroy');
    Route::get('/mahasiswa/laporan-magang/edit/{id}', [LaporanMagangMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/laporan-magang/edit/{id}', [LaporanMagangMahasiswaSideController::class, 'update']);

    // Logbook - Mahasiswa Side
    Route::resource('/mahasiswa/logbook', LogbookMahasiswaSideController::class)->except('show');
    Route::get('/mahasiswa/logbook/edit/{id}', [LogbookMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/logbook/edit/{id}', [LogbookMahasiswaSideController::class, 'update']);

    // Bimbingan - Mahasiswa Side
    Route::resource('/mahasiswa/bimbingan', BimbinganMahasiswaSideController::class)->except('show');
    Route::get('/mahasiswa/bimbingan/edit/{id}', [BimbinganMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/bimbingan/edit/{id}', [BimbinganMahasiswaSideController::class, 'update'])->name('mahasiswa.bimbingan.update');


    // Auth DOSEN
    // Menampilkan dashboard simag dosen
    Route::resource('/dosen/dashboard', PengumumanDosenSideController::class)->except('show');
    Route::get('/dosen/dashboard/edit/{id}', [PengumumanDosenSideController::class,'edit']);
    Route::patch('/dosen/dashboard/edit/{id}', [PengumumanDosenSideController::class,'update']);

    // Data Bimbingan Mahasiswa - Dosen Side
    Route::resource('/dosen/data-bimbingan-mahasiswa', DataBimbinganDosenSideController::class)->except('create', 'store', 'show', 'edit', 'update', 'destroy');

    // Data Magang Mahasiswa - Dosen Side
    Route::get('/dosen/data-magang-mahasiswa', [DataMagangDosenSideController::class, 'index']);

    // Laporan Magang - Dosen Side
    Route::resource('/dosen/laporan-magang-mahasiswa', LaporanMagangDosenSideController::class)->except('create', 'show', 'store', 'destroy');
    Route::get('/dosen/laporan-magang-mahasiswa/edit/{id}', [LaporanMagangDosenSideController::class, 'edit']);
    Route::patch('/dosen/laporan-magang-mahasiswa/edit/{id}', [LaporanMagangDosenSideController::class, 'update']);

    // Logbook - Dosen Side
    Route::resource('/dosen/logbook-mahasiswa', LogbookDosenSideController::class)->except('create', 'store', 'destroy');
    Route::get('/dosen/logbook-mahasiswa/show/{data_magang_id}', [LogbookDosenSideController::class, 'show']);
    Route::get('/dosen/logbook-mahasiswa/edit/{id}', [LogbookDosenSideController::class, 'edit']);
    Route::patch('/dosen/logbook-mahasiswa/edit/{id}', [LogbookDosenSideController::class, 'update']);

    // Bimbingan - Dosen Side
    Route::resource('/dosen/bimbingan-mahasiswa', BimbinganDosenSideController::class)->except('destroy');
    Route::get('/dosen/bimbingan-mahasiswa/show/{data_magang_id}', [BimbinganDosenSideController::class, 'show']);
    Route::get('/dosen/bimbingan-mahasiswa/edit/{id}', [BimbinganDosenSideController::class, 'edit']);
    Route::patch('/dosen/bimbingan-mahasiswa/edit/{id}', [BimbinganDosenSideController::class, 'update']);

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
