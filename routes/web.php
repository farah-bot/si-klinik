<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => ['auth']], function () {

    // Admin-only routes
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/datapengguna', function () {
            return view('admin.datamaster.datapengguna');
        })->name('datapengguna');

        Route::post('/users', [UserController::class, 'store'])->name('users.store');

    });

    // Dokter routes
    Route::group(['middleware' => ['role:Dokter']], function () {
        // Route::get('/datapengguna', function () {
        //     return view('admin.datamaster.datapengguna');
        // })->name('datapengguna'); //testing
        // Route::post('/users', [UserController::class, 'store'])->name('users.store'); //testing
        Route::get('/poliumum', function () {
            return view('pemeriksaan.poliumum');
        })->name('poliumum'); //aman
        Route::get('/poligigi', function () {
            return view('pemeriksaan.poligigi');
        })->name('poligigi'); //aman
        Route::get('/datapoligigi', function () {
            return view('pemeriksaan.datapoligigi');
        })->name('datapoligigi'); //aman
    });

    // Rekam Medis routes
    Route::group(['middleware' => ['role:Rekam Medis']], function () {
        Route::get('/dataantrian', function () {
            return view('pendaftaran.dataantrian');
        })->name('dataantrian'); //aman
        Route::get('/formpendaftaran', function () {
            return view('pendaftaran.formpendaftaran');
        })->name('formpendaftaran'); //aman

    });

    // Apoteker routes
    Route::group(['middleware' => ['role:Apoteker']], function () {
        Route::get('/dataapotek', function () {
            return view('apotek.dataapotek');
        })->name('dataapotek');
    });

    // Bidan routes
    Route::group(['middleware' => ['role:Bidan']], function () {
        Route::get('/datapolikia', function () {
            return view('pemeriksaan.datapolikia');
        })->name('datapolikia');
    });

    Route::group(['middleware' =>  ['role:Dokter|Perawat|Rekam Medis']], function () {
        Route::get('/riwayatpelayananpasien', function () {
            return view('rekammedis.riwayatpelayanan');
        })->name('riwayatpelayananpasien'); //aman
    });
    Route::group(['middleware' =>  ['role:Dokter|Perawat']], function () {
        Route::get('/datapoliumum', function () {
            return view('pemeriksaan.datapoliumum');
        })->name('datapoliumum'); //aman
    });
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis']], function () {
        Route::get('/laporan10besarpenyakit', function () {
            return view('rekammedis.laporanpenyakit');
        })->name('laporan10besarpenyakit');
    });
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis']], function () {
        Route::get('/laporankunjungan', function () {
            return view('rekammedis.laporankunjungan');
        })->name('laporankunjungan');
        Route::get('/laporanjumlahjasapelayanandokter', function () {
            return view('rekammedis.laporanjasa');
        })->name('laporanjumlahjasapelayanandokter'); //aman
    });
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/datapengguna', function () {
//     return view('admin.datamaster.datapengguna');
// })->name('datapengguna');

// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

