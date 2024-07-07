<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\PemeriksaanGigi;
use App\Models\PemeriksaanGigiObat;
use App\Models\PemeriksaanKia;
use App\Models\PemeriksaanKiaObat;
use App\Models\PemeriksaanUmum;
use App\Models\PemeriksaanUmumObat;

class ApotekerController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('pasien')
        ->where('status','Sudah Terlayani')
        ->paginate(10);
        return view('apoteker.apotek.dataapotek', compact('kunjungans'));
    }

    public function showDetailPoliGigi($id)
    {
        $pemeriksaan = PemeriksaanGigi::with(['diagnosa', 'pasien', 'kunjungan', 'user', 'obat'])->where('kunjungan_id', $id)
            ->firstOrFail();
        $kunjungan = Kunjungan::find($pemeriksaan->kunjungan_id);
        $obat = PemeriksaanGigiObat::where('pemeriksaan_gigi_id', $pemeriksaan->id)->get();

        if (!$pemeriksaan || !$kunjungan) {
            abort(404, 'Data pemeriksaan atau kunjungan tidak ditemukan.');
        }

        $tandaTangan = null;
        if ($pemeriksaan->tanda_tangan) {
            $tandaTangan = asset('storage/' . $pemeriksaan->tanda_tangan);
        }

        return view('apoteker.apotek.detailpoligigi', [
            'pemeriksaan' => $pemeriksaan,
            'kunjungan' => $kunjungan,
            'tanda_tangan' => $tandaTangan,
            'obat' => $obat
        ]);
    }

    public function showDetailPoliUmum($id)
    {
        $pemeriksaan = PemeriksaanUmum::with(['diagnosa', 'pasien', 'kunjungan', 'user', 'obat'])->where('kunjungan_id', $id)
            ->firstOrFail();
        $kunjungan = Kunjungan::find($pemeriksaan->kunjungan_id);
        $obat = PemeriksaanUmumObat::where('pemeriksaan_umum_id', $pemeriksaan->id)->get();

        if (!$pemeriksaan || !$kunjungan) {
            abort(404, 'Data pemeriksaan atau kunjungan tidak ditemukan.');
        }

        $tandaTangan = null;
        if ($pemeriksaan->tanda_tangan) {
            $tandaTangan = asset('storage/' . $pemeriksaan->tanda_tangan);
        }

        return view('apoteker.apotek.detailpoliumum', [
            'pemeriksaan' => $pemeriksaan,
            'kunjungan' => $kunjungan,
            'tanda_tangan' => $tandaTangan,
            'obat' => $obat,
        ]);
    }

    public function showDetailPoliKia($id)
    {
        $pemeriksaan = PemeriksaanKia::with(['diagnosa', 'pasien', 'kunjungan', 'user', 'obat'])->where('kunjungan_id', $id)
            ->firstOrFail();
        $kunjungan = Kunjungan::find($pemeriksaan->kunjungan_id);
        $obat = PemeriksaanKiaObat::where('pemeriksaan_kia_id', $pemeriksaan->id)->get();

        if (!$pemeriksaan || !$kunjungan) {
            abort(404, 'Data pemeriksaan atau kunjungan tidak ditemukan.');
        }

        $tandaTangan = null;
        if ($pemeriksaan->tanda_tangan) {
            $tandaTangan = asset('storage/' . $pemeriksaan->tanda_tangan);
        }

        return view('apoteker.apotek.detailpolikia', [
            'pemeriksaan' => $pemeriksaan,
            'kunjungan' => $kunjungan,
            'tanda_tangan' => $tandaTangan,
            'obat' => $obat
        ]);
    }

}
