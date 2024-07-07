<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Http\Controllers\PemeriksaanController;

class DashboardController extends Controller
{
    public function index()
    {
        PemeriksaanController::deleteUnattendedVisits();

        $poliUmumCount = Kunjungan::where('poli_tujuan', 'Poli Umum')->count();
        $poliGigiCount = Kunjungan::where('poli_tujuan', 'Poli Gigi')->count();
        $poliKIACount = Kunjungan::where('poli_tujuan', 'Poli KIA')->count();
        $kunjunganUmumCount = Pasien::where('jenis_pasien', 'Umum')->count();
        $kunjunganBPJSCount = Pasien::where('jenis_pasien', 'BPJS')->count();
        return view('dashboard', compact('poliUmumCount', 'poliGigiCount', 'poliKIACount', 'kunjunganUmumCount', 'kunjunganBPJSCount'));
    }
}
