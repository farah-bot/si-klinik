<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;

class RiwayatPelayanan extends Controller
{

    public function riwayatPelayananPasien()
    {
        $riwayatPelayanan = Kunjungan::where('status', 'Sudah Terlayani')
            ->with(['user', 'pasien'])
            ->get();

        return view('rekammedis.riwayatpelayanan', [
            'riwayatPelayanan' => $riwayatPelayanan
        ]);
    }
}
