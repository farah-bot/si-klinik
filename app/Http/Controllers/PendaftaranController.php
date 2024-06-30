<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('pendaftaran.dataantrian', compact('pasien'));
    }

    public function dataAntrianPoli()
    {
        $kunjungans = Kunjungan::with('pasien')
        ->get();

        return view('pendaftaran.dataantrianpoli', compact('kunjungans'));
    }

    public function daftarPasien(Request $request)
    {
        $request->validate([
            'no_rm' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'nik' => 'required|string|max:20',
            'jenis_pasien' => 'required|string|in:Umum,BPJS',
            'nomor_bpjs' => $request->jenis_pasien === 'BPJS' ? 'required|string|max:255' : '',
            'tanggal_kunjungan' => 'required|date',
            'poli_tujuan' => 'required|string',
            'jenis_kunjungan' => 'required|string|in:Baru,Lama',
        ]);

        $pasien = Pasien::create([
            'no_rm' => $request->no_rm,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'nik' => $request->nik,
            'jenis_pasien' => $request->jenis_pasien,
            'nomor_bpjs' => $request->nomor_bpjs ?? null,
        ]);

        // Menghitung nomor antrian berikutnya
        $nomor_antrian_terakhir = Kunjungan::whereDate('tanggal_kunjungan', $request->tanggal_kunjungan)
            ->where('poli_tujuan', $request->poli_tujuan)
            ->max('nomor_antrian');

        $nomor_antrian_baru = $nomor_antrian_terakhir ? $nomor_antrian_terakhir + 1 : 1;

        $kunjungan = Kunjungan::create([
            'pasien_id' => $pasien->id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'poli_tujuan' => $request->poli_tujuan,
            'jenis_kunjungan' => $request->jenis_kunjungan,
            'status' => 'Belum Terlayani',
            'nomor_antrian' => $nomor_antrian_baru,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran pasien berhasil.');
    }

    public function dataPoliGigi()
    {
        $kunjungans = Kunjungan::with('pasien')
            ->where('poli_tujuan', 'Poli Gigi')
            ->get();

        return view('pemeriksaan.datapoligigi', compact('kunjungans'));
    }
    public function dataPoliKia()
    {
        $kunjungans = Kunjungan::with('pasien')
            ->where('poli_tujuan', 'Poli KIA')
            ->get();

        return view('pemeriksaan.datapolikia', compact('kunjungans'));
    }
    public function dataPoliUmum()
    {
        $kunjungans = Kunjungan::with('pasien')
            ->where('poli_tujuan', 'Poli Umum')
            ->get();

        return view('pemeriksaan.datapoliumum', compact('kunjungans'));
    }
}
