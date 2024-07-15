<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\RiwayatPelayanan;

// lOGIN

// Route::get('/datapengguna', [UserController::class, 'index'])->name('datapengguna');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::group(['middleware' => ['auth']], function () {

    // HANYA ADMIN
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/datapengguna', [UserController::class, 'index'])->name('datapengguna');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/datapasien/delete/{id}', [PendaftaranController::class, 'destroy'])->name('deleteDataPasien');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/datadiagnosa', [DiagnosaController::class, 'index'])->name('datadiagnosa');
        Route::put('/diagnosis/{id}', [DiagnosaController::class, 'update']);
        Route::delete('/diagnosis/{id}', [DiagnosaController::class, 'delete']);
        Route::post('/diagnosis', [DiagnosaController::class, 'store'])->name('diagnosis.store');
        Route::get('/datapasien', [PendaftaranController::class, 'dataPasien'])->name('datapasien');
        Route::post('/daftar_pasien_lama', [PendaftaranController::class, 'daftarPasienLama'])->name('daftar_pasien_lama');
    });

    // ADMIN DAN DOKTER GIGI
    Route::group(['middleware' => ['role:Dokter Gigi|Admin']], function () {
        Route::post('/updatestatusgigi/{id}', [PendaftaranController::class, 'updateStatus'])->name('update-status');
        Route::post('/skipstatusgigi/{id}', [PendaftaranController::class, 'skipStatus'])->name('skip-status');
        Route::delete('/deletekunjungangigi/{id}', [PendaftaranController::class, 'deleteKunjungan'])->name('delete-kunjungan');
        Route::post('/pemeriksaangigi', [PemeriksaanController::class, 'storePoliGigi'])->name('pemeriksaan.storePoliGigi');
        Route::get('/formpoligigi/{nomorAntrian}/{tanggalPeriksa}/{pasien_id}', [PemeriksaanController::class, 'showFormulirPoliGigi'])->name('formulirpoligigi');
        Route::get('/datapoligigi', [PendaftaranController::class, 'dataPoliGigi'])->name('datapoligigi');
        Route::put('/updatestatusgigi/{id}', [PemeriksaanController::class, 'updateStatus'])->name('updateStatusGigi');
    });

    // ADMIN, KEPALA KLINIK DAN DOKTER UMUM 
    Route::group(['middleware' => ['role:Dokter Umum|Admin|Kepala Klinik']], function () {
        Route::post('/updatestatusumum/{id}', [PendaftaranController::class, 'updateStatus'])->name('update-status');
        Route::post('/skipstatusumum/{id}', [PendaftaranController::class, 'skipStatus'])->name('skip-status');
        Route::delete('/deletekunjunganumum/{id}', [PendaftaranController::class, 'deleteKunjungan'])->name('delete-kunjungan');
        Route::post('/pemeriksaanumum', [PemeriksaanController::class, 'storePoliUmum'])->name('pemeriksaan.storePoliUmum');
        Route::get('/formpoliumum/{nomorAntrian}/{tanggalPeriksa}/{pasien_id}', [PemeriksaanController::class, 'showFormulirPoliUmum'])->name('formulirpoliumum');
        Route::get('/datapoliumum', [PendaftaranController::class, 'dataPoliUmum'])->name('datapoliumum');
        Route::put('/updatestatusumum/{id}', [PemeriksaanController::class, 'updateStatus'])->name('updateStatusUmum');
    });

    // REKAM MEDIS DAN ADMIN
    Route::group(['middleware' => ['role:Rekam Medis|Admin']], function () {
        Route::get('/dataantrian', [PendaftaranController::class, 'index'])->name('dataantrian');
        Route::get('/dataantrianpoli', [PendaftaranController::class, 'dataAntrianPoli'])->name('dataantrianpoli');
        Route::post('/daftar_pasien', [PendaftaranController::class, 'daftarPasien'])->name('daftar_pasien');
        Route::get('/formpendaftaran', function () {
            return view('pendaftaran.formpendaftaran');
        })->name('formpendaftaran');
        Route::get('/editpasien/{id}', [PendaftaranController::class, 'edit'])->name('editpasien');
        Route::post('/editpasien/{id}', [PendaftaranController::class, 'update'])->name('updatepasien');
        Route::delete('/deletepasien/{id}', [PendaftaranController::class, 'destroy'])->name('deletePasien');
    });

    // APOTEKER DAN ADMIN
    Route::group(['middleware' => ['role:Apoteker|Admin']], function () {
        Route::get('/dataapotek', [ApotekerController::class, 'index'])->name('dataapotek');
        Route::get('/detailpoliumumapotek/{id}', [ApotekerController::class, 'showDetailPoliUmum'])->name('showDetailPoliUmum');
        Route::get('/detailpoligigiapotek/{id}', [ApotekerController::class, 'showDetailPoliGigi'])->name('showDetailPoliGigi');
        Route::get('/detailpolikiaapotek/{id}', [ApotekerController::class, 'showDetailPoliKia'])->name('showDetailPoliKia');
        Route::put('/updatestatusgigiantrian/{id}', [PemeriksaanController::class, 'updateStatusAntrian'])->name('updateStatusGigiAntrian');
        Route::put('/updatestatuskiaantrian/{id}', [PemeriksaanController::class, 'updateStatusAntrian'])->name('updateStatusKiaAntrian');
        Route::put('/updatestatusumumantrian/{id}', [PemeriksaanController::class, 'updateStatusAntrian'])->name('updateStatusUmumAntrian');
    });

    // BIDAN DAN ADMIN
    Route::group(['middleware' => ['role:Bidan|Admin']], function () {
        Route::post('/updatestatuskia/{id}', [PendaftaranController::class, 'updateStatus'])->name('update-status');
        Route::post('/skipstatuskia/{id}', [PendaftaranController::class, 'skipStatus'])->name('skip-status');
        Route::delete('/deletekunjungankia/{id}', [PendaftaranController::class, 'deleteKunjungan'])->name('delete-kunjungan');
        Route::put('/updatestatuskia/{id}', [PemeriksaanController::class, 'updateStatus'])->name('updateStatusKia');
        Route::post('/pemeriksaankia', [PemeriksaanController::class, 'storePoliKia'])->name('pemeriksaan.storePoliKia');
        Route::get('/formpolikia/{nomorAntrian}/{tanggalPeriksa}/{pasien_id}', [PemeriksaanController::class, 'showFormulirPoliKIA'])->name('formulirpolikia');
        Route::get('/datapolikia', [PendaftaranController::class, 'dataPoliKia'])->name('datapolikia');
    });

    // DOKTER UMUM, KEPALA KLINIK, PERAWAT, REKAM MEDIS, DAN ADMIN
    Route::group(['middleware' =>  ['role:Dokter Umum|Kepala Klinik|Perawat|Rekam Medis|Admin']], function () {
        Route::get('/riwayatpelayananpasien', [RiwayatPelayanan::class, 'riwayatPelayananPasien'])->name('riwayatpelayananpasien');
        Route::get('/detailpoliumum/{id}/{poli}', [PemeriksaanController::class, 'showDetailPoliUmum'])->name('showDetailPoliUmum');
        Route::get('/detailpoligigi/{id}/{poli}', [PemeriksaanController::class, 'showDetailPoliGigi'])->name('showDetailPoliGigi');
        Route::get('/detailpolikia/{id}/{poli}', [PemeriksaanController::class, 'showDetailPoliKia'])->name('showDetailPoliKia');
    });

    // DOKTER UMUM, DOKTER GIGI, PERAWAT, BIDAN, DAN ADMIN
    Route::group(['middleware' =>  ['role:Dokter Umum|Dokter Gigi|Perawat|Admin|Bidan']], function () {
        Route::get('/fetch-diagnosa', [PemeriksaanController::class, 'fetchDiagnosa']);
    });

    // KEPALA KLINIK, REKAM MEDIS, DAN ADMIN
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis|Admin']], function () {
        Route::get('/laporan10besarpenyakit', [LaporanController::class, 'laporan10BesarPenyakit'])->name('laporan10besarpenyakit');
        Route::get('/laporankunjungan', [LaporanController::class, 'index'])->name('laporankunjungan');
        Route::get('/laporanjumlahjasapelayanandokter', [LaporanController::class, 'laporanJasa'])->name('laporanjumlahjasapelayanandokter');
    });

    // SEMUA ROLE
    Route::group(['middleware' =>  ['role:Kepala Klinik|Rekam Medis|Admin|Dokter Umum|Dokter Gigi|Perawat|Bidan|Apoteker']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/delete-unattended-visits', [PemeriksaanController::class, 'deleteUnattendedVisits']);
    });
});

// GUEST

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/detailpoliumum', function () {
    return view('pemeriksaan.detailpoliumum');
})->name('detailpoliumum');

Route::get('/detailpoligigi', function () {
    return view('pemeriksaan.detailpoligigi');
})->name('detailpoligigi');

Route::get('/detailpolikia', function () {
    return view('pemeriksaan.detailpolikia');
})->name('detailpolikia');
