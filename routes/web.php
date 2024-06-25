<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/datapengguna', function () {
    return view('admin.datapengguna');
})->name('datapengguna'); 

Route::get('/datapasien', function () {
    return view('admin.datapasien');
})->name('datapasien'); 

Route::get('/datadiagnosa', function () {
    return view('admin.datadiagnosa');
})->name('datadiagnosa'); 

Route::get('/dataobat', function () {
    return view('admin.dataobat');
})->name('dataobat'); 

Route::get('/dataantrian', function () {
    return view('pendaftaran.dataantrian');
})->name('dataantrian'); 

Route::get('/formpemeriksaan', function () {
    return view('pendaftaran.formpemeriksaan');
})->name('formpemeriksaan'); 

Route::get('/poligigi', function () {
    return view('pemeriksaan.poligigi');
})->name('poligigi'); 

Route::get('/riwayatpelayanan', function () {
    return view('rekammedis.riwayatpelayanan');
})->name('riwayatpelayanan'); 

Route::get('/laporankunjungan', function () {
    return view('rekammedis.laporankunjungan');
})->name('laporankunjungan'); 

Route::get('/laporanjasa', function () {
    return view('rekammedis.laporanjasa');
})->name('laporanjasa'); 

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
