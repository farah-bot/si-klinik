<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/datapengguna', [UserController::class, 'index'])->name('datapengguna');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });

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

    Route::group(['middleware' => ['role:Rekam Medis|Admin']], function () {
        Route::get('/dataantrian', [PendaftaranController::class, 'index'])->name('dataantrian');
        Route::post('/daftar_pasien', [PendaftaranController::class, 'daftarPasien'])->name('daftar_pasien');
        Route::get('/formpendaftaran', function () {
            return view('pendaftaran.formpendaftaran');
        })->name('formpendaftaran');
    });

    Route::group(['middleware' => ['role:Apoteker|Admin']], function () {
        Route::get('/dataapotek', function () {
            return view('apoteker.apotek.dataapotek');
        })->name('dataapotek');
    });

    Route::group(['middleware' => ['role:Bidan|Admin']], function () {
        Route::get('/datapolikia', function () {
            return view('pemeriksaan.datapolikia');
        })->name('datapolikia');
    });

    Route::group(['middleware' =>  ['role:Dokter|Perawat|Rekam Medis|Admin']], function () {
        Route::get('/riwayatpelayananpasien', function () {
            return view('rekammedis.riwayatpelayanan');
        })->name('riwayatpelayananpasien');
    });
    Route::group(['middleware' =>  ['role:Dokter|Perawat|Admin']], function () {
        Route::get('/datapoliumum', function () {
            return view('pemeriksaan.datapoliumum');
        })->name('datapoliumum');
    });
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis|Admin']], function () {
        Route::get('/laporan10besarpenyakit', function () {
            return view('rekammedis.laporanpenyakit');
        })->name('laporan10besarpenyakit');
        Route::get('/laporankunjungan', function () {
            return view('rekammedis.laporankunjungan');
        })->name('laporankunjungan');
        Route::get('/laporanjumlahjasapelayanandokter', function () {
            return view('rekammedis.laporanjasa');
        })->name('laporanjumlahjasapelayanandokter');
    });
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis|Admin|Dokter|Perawat|Bidan|Apoteker']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
