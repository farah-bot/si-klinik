<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('/datapengguna', function () {
    return view('admin.datamaster.datapengguna');
})->name('datapengguna'); 

Route::get('/datapasien', function () {
    return view('admin.datamaster.datapasien');
})->name('datapasien'); 

Route::get('/datadiagnosa', function () {
    return view('admin.datamaster.datadiagnosa');
})->name('datadiagnosa'); 

Route::get('/dataobat', function () {
    return view('admin.datamaster.dataobat');
})->name('dataobat'); 

Route::get('/dataantrian', function () {
    return view('pendaftaran.dataantrian');
})->name('dataantrian'); 

Route::get('/formpendaftaran', function () {
    return view('pendaftaran.formpendaftaran');
})->name('formpendaftaran'); 

Route::get('/poliumum', function () {
    return view('pemeriksaan.datapoliumum');
})->name('datapoliumum');

Route::get('/poligigi', function () {
    return view('pemeriksaan.datapoligigi');
})->name('datapoligigi'); 

Route::get('/polikia', function () {
    return view('pemeriksaan.datapolikia');
})->name('datapolikia');

Route::get('/riwayatpelayanan', function () {
    return view('rekammedis.riwayatpelayanan');
})->name('riwayatpelayanan'); 

Route::get('/laporankunjungan', function () {
    return view('rekammedis.laporankunjungan');
})->name('laporankunjungan'); 

Route::get('/laporanjasa', function () {
    return view('rekammedis.laporanjasa');
})->name('laporanjasa'); 

Route::get('/laporanpenyakit', function () {
    return view('rekammedis.laporanpenyakit');
})->name('laporanpenyakit'); 

Route::get('/dataapotek', function () {
    return view('apotek.dataapotek');
})->name('dataapotek'); 


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); 

Route::get('/login', function () {
    return view('login');
})->name('login'); 

Route::post('/login', function () {
    return view('login');
})->name('login.submit'); 


Route::post('/users', [UserController::class, 'store'])->name('users.store');
