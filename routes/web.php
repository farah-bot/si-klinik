<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPenggunaController;

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


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); 
// Route::post('/', function () {
//     return view('welcome');
// })->name('welcome'); 


Route::get('/login', function () {
    return view('login');
})->name('login'); 

Route::post('/login', function () {
    return view('login');
})->name('login.submit'); 
