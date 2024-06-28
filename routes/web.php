<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/datapengguna', function () {
        return view('admin.datamaster.datapengguna');
    })->name('datapengguna');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

Route::group(['middleware' => ['role:dokter']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/poligigi', function () {
        return view('pemeriksaan.poligigi');
    })->name('poligigi');
    Route::get('/poliumum', function () {
        return view('pemeriksaan.datapoliumum');
    })->name('datapoliumum');
    Route::get('/riwayatpelayanan', function () {
        return view('rekammedis.riwayatpelayanan');
    })->name('riwayatpelayanan');
});

Route::group(['middleware' => ['role:rekam medis']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dataantrian', function () {
        return view('pendaftaran.dataantrian');
    })->name('dataantrian');
    Route::get('/formpendaftaran', function () {
        return view('pendaftaran.formpendaftaran');
    })->name('formpendaftaran');
    Route::get('/riwayatpelayanan', function () {
        return view('rekammedis.riwayatpelayanan');
    })->name('riwayatpelayanan');
    Route::get('/laporankunjungan', function () {
        return view('rekammedis.laporankunjungan');
    })->name('laporankunjungan');
    Route::get('/laporanpenyakit', function () {
        return view('rekammedis.laporanpenyakit');
    })->name('laporanpenyakit');
    Route::get('/laporanjasa', function () {
        return view('rekammedis.laporanjasa');
    })->name('laporanjasa');
});

Route::group(['middleware' => ['role:apoteker']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dataapotek', function () {
        return view('apotek.dataapotek');
    })->name('dataapotek');
});

Route::group(['middleware' => ['role:bidan']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/polikia', function () {
        return view('pemeriksaan.polikia');
    })->name('polikia');
});

Route::group(['middleware' => ['role:perawat']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/poliumum', function () {
        return view('pemeriksaan.datapoliumum');
    })->name('datapoliumum');
    Route::get('/riwayatpelayanan', function () {
        return view('rekammedis.riwayatpelayanan');
    })->name('riwayatpelayanan');
});

Route::group(['middleware' => ['role:kepala klinik']], function () {
    Route::get('/riwayatpelayanan', function () {
        return view('rekammedis.riwayatpelayanan');
    })->name('riwayatpelayanan');
    Route::get('/laporankunjungan', function () {
        return view('rekammedis.laporankunjungan');
    })->name('laporankunjungan');
    Route::get('/laporanpenyakit', function () {
        return view('rekammedis.laporanpenyakit');
    })->name('laporanpenyakit');
    Route::get('/laporanjasa', function () {
        return view('rekammedis.laporanjasa');
    })->name('laporanjasa');
});

// General routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    return view('login');
})->name('login.submit');
