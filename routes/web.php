<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::group(['middleware' => 'auth'], function () {
    // Menampilkan index simmag
    Route::get('/', function() {
        return view('pages.index');
    });
    // Menampilkan pengumuman simmag
    Route::get('/pengumuman', function() {
        return view('pages.contents.pengumuman');
    });
    // Menampilkan persuratan simmag
    Route::get('/persuratan', function() {
        return view('pages.contents.persuratan');
    });
    // Menampilkan data-magang
    Route::get('/data-magang', function() {
        return view('pages.contents.data-magang');
    });

    //Kelola pengguna
    Route::get('/kelolaAdmin', [FormKelolaAdminController::class, 'index'])->name('indexKelolaAdmin');
    Route::post('/kelolaAdmin', [FormKelolaAdminController::class, 'store'])->name('storeKelolaAdmin');

    Route::get('/kelolaDosen', [FormKelolaDosenController::class, 'index'])->name('indexKelolaDosen');
    Route::post('/kelolaDosen', [FormKelolaDosenController::class, 'store'])->name('storeKelolaDosen');

    Route::get('/kelolaMahasiswa', [FormKelolaMahasiswaController::class, 'index'])->name('indexKelolaMahasiswa');
    Route::post('/kelolaMahasiswa', [FormKelolaAdminController::class, 'store'])->name('storeKelolaMahasiswa');
});

// Login
Route::get('/login', [HomeController::class, 'masuk'])->name('login')->middleware('guest');
Route::post('/prosesLogin', [HomeController::class, 'prosesMasuk']);

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
