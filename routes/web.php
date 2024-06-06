<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPenggunaController;

Route::get('/datapengguna', function () {
    return view('admin.datapengguna');
})->name('datapengguna'); 


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); 
Route::post('/', function () {
    return view('welcome');
})->name('welcome'); 


Route::get('/login', function () {
    return view('login');
})->name('login'); 
Route::post('/login', function () {
    return view('login');
})->name('login'); 
