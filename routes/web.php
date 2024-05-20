<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataMagangController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\FormKelolaAdminController;
use App\Http\Controllers\FormKelolaDosenController;
use App\Http\Controllers\PengajuanMagangController;
use App\Http\Controllers\DataMagangAdminSideController;
use App\Http\Controllers\FormKelolaMahasiswaController;

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

    // Auth Admin
    // Menampilkan index simmag admin
    Route::get('/', function() {
        return view('pages.contents.admin.index');
    });
    // Menampilkan persuratan simmag
    Route::get('/persuratan', function() {
        return view('pages.contents.admin.persuratan');
    });

    //Kelola pengguna
    // Admin
    Route::resource('/kelola-pengguna/admin', FormKelolaAdminController::class)->except('show', 'store', 'create');
    Route::get('/kelola-pengguna/admin/edit/{id}', [FormKelolaAdminController::class, 'edit']);
    Route::patch('/kelola-pengguna/admin/edit/{id}', [FormKelolaAdminController::class, 'update']);
    // Mahasiswa
    Route::resource('/kelola-pengguna/mahasiswa', FormKelolaMahasiswaController::class)->except('show', 'create' ,'store');
    Route::get('/kelola-pengguna/mahasiswa/edit/{id}', [FormKelolaMahasiswaController::class, 'edit']);
    Route::patch('/kelola-pengguna/mahasiswa/edit/{id}', [FormKelolaMahasiswaController::class, 'update']);
    // Dosen
    Route::resource('/kelola-pengguna/dosen', FormKelolaDosenController::class)->except('show', 'create', 'store');
    Route::get('/kelola-pengguna/dosen/edit/{id}', [FormKelolaDosenController::class,'edit']);
    Route::patch('/kelola-pengguna/dosen/edit/{id}', [FormKelolaDosenController::class, 'update']);

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
    Route::get('/pengumuman', [PengumumanController::class,'show']);
    Route::get('/formPengumuman', [PengumumanController::class,'create']);
    Route::post('/pengumuman', [PengumumanController::class,'store']);
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy']);

    // Data Magang - Admin Side
    Route::resource('/admin/data-magang', DataMagangAdminSideController::class)->except('create','show','store', 'update', 'destroy', 'edit');

    // Auth Mahasiswa
    // Menampilkan index simmag mahasiswa
    Route::get('/mahasiswa/dashboard', function() {
        return view('pages.contents.mahasiswa.index');
    });

    // Pengajuan Magang
    Route::resource('/mahasiswa/pengajuan-magang', PengajuanMagangController::class)->except('show','store', 'update', 'destroy', 'edit');
    // Data Magang - Mahasiswa Side
    Route::resource('/mahasiswa/data-magang', DataMagangController::class)->except('create','show','store', 'update', 'destroy', 'edit');

    // Auth Dosen
    // Menampilkan index simmag dosen
    Route::get('/dosen/dashboard', function() {
        return view('pages.contents.dosen.index');
    });
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
