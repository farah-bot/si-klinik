<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\PemeriksaanUmum;

class RiwayatPelayanan extends Controller
{

    public function riwayatPelayananPasien()
    {
        $riwayatPelayanan = Kunjungan::where('status', 'Sudah Terlayani')
            ->with(['user', 'pasien'])
            ->paginate(10);
        return view('rekammedis.riwayatpelayanan', [
            'riwayatPelayanan' => $riwayatPelayanan,
        ]);
    }
}
