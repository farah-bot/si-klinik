<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\User;

class PemeriksaanController extends Controller
{
    public function showFormulirPoliGigi($nomorAntrian)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)->first();

        if (!$kunjungan) {
            abort(404, 'Nomor antrian tidak valid.');
        }

        $pasien = Pasien::find($kunjungan->pasien_id);

        $dokter = User::find($kunjungan->user_id);

        return view('pemeriksaan.poligigi', [
            'no_rm' => $pasien->no_rm,
            'tanggal_kunjungan' => $kunjungan->tanggal_kunjungan,
            'nama_pasien' => $pasien->nama,
            'name' => $dokter->name,
        ]);
    }

    public function showFormulirPoliUmum($nomorAntrian)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)->first();

        if (!$kunjungan) {
            abort(404, 'Nomor antrian tidak valid.');
        }

        $pasien = Pasien::find($kunjungan->pasien_id);

        $dokter = User::find($kunjungan->user_id);

        return view('pemeriksaan.poliumum', [
            'no_rm' => $pasien->no_rm,
            'tanggal_kunjungan' => $kunjungan->tanggal_kunjungan,
            'nama_pasien' => $pasien->nama,
            'name' => $dokter->name,
        ]);
    }

    public function showFormulirPoliKIA($nomorAntrian)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)->first();

        if (!$kunjungan) {
            abort(404, 'Nomor antrian tidak valid.');
        }

        $pasien = Pasien::find($kunjungan->pasien_id);

        $dokter = User::find($kunjungan->user_id);

        return view('pemeriksaan.polikia', [
            'no_rm' => $pasien->no_rm,
            'tanggal_kunjungan' => $kunjungan->tanggal_kunjungan,
            'nama_pasien' => $pasien->nama,
            'name' => $dokter->name,
        ]);
    }
}
