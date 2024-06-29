<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\LaporanController;

// lOGIN

Route::group(['middleware' => ['auth']], function () {

    // HANYA ADMIN
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/datapengguna', [UserController::class, 'index'])->name('datapengguna');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/datadiagnosa', function () {
            return view('admin.datamaster.datadiagnosa');
        })->name('datadiagnosa');
        Route::get('/dataobat', function () {
            return view('admin.datamaster.dataobat');
        })->name('dataobat');
        Route::get('/datapasien', function () {
            return view('admin.datamaster.datapasien');
        })->name('datapasien');
    });

    // ADMIN DAN DOKTER
    Route::group(['middleware' => ['role:Dokter|Admin']], function () {
        Route::get('/poliumum', function () {
            return view('pemeriksaan.poliumum');
        })->name('poliumum');
        Route::get('/poligigi', function () {
            return view('pemeriksaan.poligigi');
        })->name('poligigi');
        Route::get('/datapoligigi', function () {
            return view('pemeriksaan.datapoligigi');
        })->name('datapoligigi');
    });

    // REKAM MEDIS DAN ADMIN
    Route::group(['middleware' => ['role:Rekam Medis|Admin']], function () {
        Route::get('/dataantrian', [PendaftaranController::class, 'index'])->name('dataantrian');
        Route::post('/daftar_pasien', [PendaftaranController::class, 'daftarPasien'])->name('daftar_pasien');
        Route::get('/formpendaftaran', function () {
            return view('pendaftaran.formpendaftaran');
        })->name('formpendaftaran');
    });

    // APOTEKER DAN ADMIN
    Route::group(['middleware' => ['role:Apoteker|Admin']], function () {
        Route::get('/dataapotek', function () {
            return view('apoteker.apotek.dataapotek');
        })->name('dataapotek');
    });

    // BIDAN DAN ADMIN
    Route::group(['middleware' => ['role:Bidan|Admin']], function () {
        Route::get('/datapolikia', function () {
            return view('pemeriksaan.datapolikia');
        })->name('datapolikia');
    });

    // DOKTER, PERAWAT, REKAM MEDIS, DAN ADMIN
    Route::group(['middleware' =>  ['role:Dokter|Perawat|Rekam Medis|Admin']], function () {
        Route::get('/riwayatpelayananpasien', function () {
            return view('rekammedis.riwayatpelayanan');
        })->name('riwayatpelayananpasien');
    });

    // DOKTER, PERAWAT, DAN ADMIN
    Route::group(['middleware' =>  ['role:Dokter|Perawat|Admin']], function () {
        Route::get('/datapoliumum', function () {
            return view('pemeriksaan.datapoliumum');
        })->name('datapoliumum');
    });

    // KEPALA KLINIK, REKAM MEDIS, DAN ADMIN
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis|Admin']], function () {
        Route::get('/laporan10besarpenyakit', function () {
            return view('rekammedis.laporanpenyakit');
        })->name('laporan10besarpenyakit');
        Route::get('/laporankunjungan', function () {
            return view('rekammedis.laporankunjungan');
        })->name('laporankunjungan');
        Route::get('/laporankunjungan', [LaporanController::class, 'index'])->name('laporankunjungan');
        Route::get('/laporanjumlahjasapelayanandokter', function () {
            return view('rekammedis.laporanjasa');
        })->name('laporanjumlahjasapelayanandokter');
    });

    // SEMUA ROLE
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis|Admin|Dokter|Perawat|Bidan|Apoteker']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});

// GUEST

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/formpoliumum', function () {
    return view('pemeriksaan.poliumum');
})->name('poliumum');

Route::get('/formpolikia', function () {
    return view('pemeriksaan.polikia');
})->name('polikia');
