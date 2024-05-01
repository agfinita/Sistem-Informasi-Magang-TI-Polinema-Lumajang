<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\FormKelolaAdminController;
use App\Http\Controllers\FormKelolaDosenController;
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
    // Menampilkan index simmag admin
    Route::get('/', function() {
        return view('pages.contents.admin.index');
    });
    // Menampilkan persuratan simmag
    Route::get('/persuratan', function() {
        return view('pages.contents.admin.persuratan');
    });
    // Menampilkan data-magang
    Route::get('/data-magang', function() {
        return view('pages.contents.admin.data-magang');
    });

    //Kelola pengguna
    Route::get('/tableUserAdmin', [FormKelolaAdminController::class, 'show']);
    // Route::get('/kelolaAdmin', [FormKelolaAdminController::class, 'index']);
    // Route::post('/tableUserAdmin', [FormKelolaAdminController::class, 'store']);
    Route::delete('/tableUserAdmin/{id}', [FormKelolaAdminController::class, 'destroy']);
    Route::get('/updateUserAdmin/{id}', [FormKelolaAdminController::class, 'edit']);
    Route::patch('/updateUserAdmin/{id}', [FormKelolaAdminController::class, 'update']);

    Route::get('/tableUserDosen', [FormKelolaDosenController::class, 'show']);
    // Route::get('/kelolaDosen', [FormKelolaDosenController::class, 'index']);
    // Route::post('/tableUserDosen', [FormKelolaDosenController::class, 'store']);
    Route::delete('/tableUserDosen/{id}', [FormKelolaDosenController::class, 'destroy']);
    Route::get('/updateUserDosen/{id}', [FormKelolaDosenController::class, 'edit']);
    Route::patch('/updateUserDosen/{id}', [FormKelolaDosenController::class, 'update']);

    Route::get('/tableUserMahasiswa', [FormKelolaMahasiswaController::class, 'show']);
    // Route::get('/kelolaMahasiswa', [FormKelolaMahasiswaController::class, 'index']);
    // Route::post('/tableUserMahasiswa', [FormKelolaMahasiswaController::class, 'store']);
    Route::delete('/tableUserMahasiswa/{id}', [FormKelolaMahasiswaController::class, 'destroy']);
    Route::get('/updateUserMahasiswa/{id}', [FormKelolaMahasiswaController::class,'edit']);
    Route::patch('/updateUserMahasiswa/{id}', [FormKelolaMahasiswaController::class, 'update']);

    // Data
    Route::get('/dataMahasiswa', [DataMahasiswaController::class,'show']);
    Route::post('/dataMahasiswa', [DataMahasiswaController::class,'store']);
    Route::get('/formDataMahasiswa', [DataMahasiswaController::class,'create']);
    Route::delete('/dataMahasiswa/{id}', [DataMahasiswaController::class, 'destroy']);
    Route::get('/updateDataMahasiswa/{id}', [DataMahasiswaController::class,'edit']);
    Route::patch('/updateDataMahasiswa/{id}', [DataMahasiswaController::class, 'update']);

    Route::get('/dataDosen', [DataDosenController::class,'show']);
    Route::post('/dataDosen', [DataDosenController::class,'store']);
    Route::get('/formDataDosen', [DataDosenController::class,'create']);
    Route::delete('/dataDosen/{id}', [DataDosenController::class, 'destroy']);
    Route::get('/updateDataDosen/{id}', [DataDosenController::class,'edit']);
    Route::patch('/updateDataDosen/{id}', [DataDosenController::class, 'update']);

    Route::get('/dataAdmin', [DataAdminController::class,'show']);
    Route::post('/dataAdmin', [DataAdminController::class,'store']);
    Route::get('/formDataAdmin', [DataAdminController::class,'create']);
    Route::delete('/dataAdmin/{id}', [DataAdminController::class, 'destroy']);
    Route::get('/updateDataAdmin/{id}', [DataAdminController::class,'edit']);
    Route::patch('/updateDataAdmin/{id}', [DataAdminController::class, 'update']);

    Route::get('/pengumuman', [PengumumanController::class,'show']);
    Route::get('/formPengumuman', [PengumumanController::class,'create']);
    Route::post('/pengumuman', [PengumumanController::class,'store']);
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy']);

    // Auth Mahasiswa
    // Menampilkan index simmag mahasiswa
    Route::get('/mahasiswa/dashboard', function() {
        return view('pages.contents.mahasiswa.index');
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
