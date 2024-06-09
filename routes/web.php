<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\KelolaDosenController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\KelolaMahasiswaController;
use App\Http\Controllers\DataMagangAdminSideController;
use App\Http\Controllers\PengumumanAdminSideController;
use App\Http\Controllers\PengumumanDosenSideController;
use App\Http\Controllers\DataMagangMahasiswaSideController;
use App\Http\Controllers\PengajuanMagangAdminSideController;
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

    // Pengajuan Magang - Admin Side
    Route::resource('/admin/mahasiswa/pengajuan-magang', PengajuanMagangAdminSideController::class)->except('show', 'update', 'edit');
    Route::get('/admin/mahasiswa/pengajuan-magang/create/{id}', [PengajuanMagangAdminSideController::class,'create']);
    Route::post('/admin/mahasiswa/pengajuan-magang/store/{id}', [PengajuanMagangAdminSideController::class,'store']);


    // AUTH MAHASISWA
    // Menampilkan dashboard simag mahasiswa
    Route::get('/mahasiswa/dashboard', [HomeController::class, 'index']);

    // Pengajuan Magang
    Route::resource('/mahasiswa/pengajuan-magang', PengajuanMagangMahasiswaSideController::class)->except('show', 'update', 'destroy', 'edit');
    // Data Magang - Mahasiswa Side
    Route::resource('/mahasiswa/data-magang', DataMagangMahasiswaSideController::class)->except('show', 'destroy');
    Route::get('/mahasiswa/data-magang/edit/{id}', [DataMagangMahasiswaSideController::class, 'edit']);
    Route::patch('/mahasiswa/data-magang/edit/{id}', [DataMagangMahasiswaSideController::class, 'update']);


    // Auth Dosen
    // Menampilkan dashboard simag dosen

    // Pengumuman
    Route::resource('/dosen/dashboard', PengumumanDosenSideController::class)->except('show');
    Route::get('/dosen/dashboard/edit/{id}', [PengumumanDosenSideController::class,'edit']);
    Route::patch('/dosen/dashboard/edit/{id}', [PengumumanDosenSideController::class,'update']);

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
