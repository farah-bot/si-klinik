<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\User;
use App\Models\PemeriksaanGigi;
use App\Models\PemeriksaanKia;
use App\Models\PemeriksaanGigiObat;
use App\Models\PemeriksaanKiaObat;
use App\Models\Diagnosa;
use App\Models\ResepObat;
use Illuminate\Support\Facades\Storage;

class PemeriksaanController extends Controller
{
    public function showFormulirPoliGigi($nomorAntrian, $tanggalPeriksa)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)
            ->where('tanggal_kunjungan', $tanggalPeriksa)
            ->first();

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
            'kunjungan' => $kunjungan,
        ]);
    }

    public function updateStatus($id, Request $request)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status = $request->input('status');
        if ($kunjungan->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function fetchDiagnosa(Request $request)
    {
        $kodeIcd = $request->input('kode_icd10');
        $diagnosa = Diagnosa::where('kode_icd', $kodeIcd)->first();

        if ($diagnosa) {
            return response()->json($diagnosa->diagnosis);
        }

        return response()->json('Diagnosa not found', 404);
    }

    public function storePoliGigi(Request $request)
    {
        $request->validate([
            'keluhan_pasien' => 'required|string',
            'kode_icd10' => 'required|string|exists:diagnosas,kode_icd',
            'rencana_tindaklanjut' => 'required|string',
            'tanda_tangan' => 'required',
            'nama_obat' => 'required|array',
            'nama_obat.*' => 'required|string',
            'satuan.*' => 'nullable|string',
            'jumlah_obat.*' => 'nullable|integer',
            'catatan_resep' => 'nullable|string',
        ]);

        foreach ($request->nama_obat as $nama_obat) {
            $exists = ResepObat::where('nama_obat', $nama_obat)->exists();
            if (!$exists) {
                return redirect()->back()->with('error', 'Obat dengan nama ' . $nama_obat . ' tidak tersedia dalam daftar resep obat.');
            }
        }

        if ($request->has('tanda_tangan')) {
            $signature = $request->input('tanda_tangan');
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $signatureData = base64_decode($signature);

            $fileName = 'signatures/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $signatureData);
        }

        $diagnosa = Diagnosa::where('kode_icd', $request->kode_icd10)->first();
        $pasien = Pasien::where('no_rm', $request->no_rm)->first();
        $kunjungan = Kunjungan::where('tanggal_kunjungan', $request->tanggal_kunjungan)->first();
        $user = User::where('name', $request->name)->first();

        $pemeriksaan = PemeriksaanGigi::create([
            'pasien_id' => $pasien->id,
            'kunjungan_id' => $kunjungan->id,
            'user_id' => $user->id,
            'diagnosa_id' => $diagnosa->id,
            'subject_keluhan' => $request->keluhan_pasien,
            'riwayat_alergi' => $request->riwayat_alergi,
            'catatan_assessment' => $request->catatan_assessment,
            'rencana_tindaklanjut' => $request->rencana_tindaklanjut,
            'tindakan' => $request->tindakan,
            'rujukan' => $request->rujukan,
            'tanda_tangan' => $fileName,
            'catatan_resep' => $request->catatan_resep,
        ]);

        $obatData = [];
        foreach ($request->nama_obat as $key => $nama_obat) {
            $resepObat = ResepObat::where('nama_obat', $nama_obat)->first();
            $obatData[] = [
                'pemeriksaan_gigi_id' => $pemeriksaan->id,
                'resep_obat_id' => $resepObat->id,
                'nama_obat' => $nama_obat,
                'satuan' => $request->satuan[$key],
                'jumlah_obat' => $request->jumlah_obat[$key],
            ];
        }

        PemeriksaanGigiObat::insert($obatData);
        $kunjungan = Kunjungan::findOrFail($request->kunjungan_id);
        $kunjungan->status = 'Sudah Terlayani';
        $kunjungan->save();

        return redirect()->back()->with('success', 'Pemeriksaan berhasil disimpan.');
    }


    public function showFormulirPoliUmum($nomorAntrian, $tanggalPeriksa)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)
            ->where('tanggal_kunjungan', $tanggalPeriksa)
            ->first();

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
            'kunjungan' => $kunjungan,
        ]);
    }

    public function showFormulirPoliKIA($nomorAntrian, $tanggalPeriksa)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)
            ->where('tanggal_kunjungan', $tanggalPeriksa)
            ->first();

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
            'kunjungan' => $kunjungan,
        ]);
    }

    public function storePoliKia(Request $request)
    {
        $request->validate([
            'keluhan_pasien' => 'required|string',
            'kode_icd10' => 'required|string|exists:diagnosas,kode_icd',
            'rencana_tindaklanjut' => 'required|string',
            'tanda_tangan' => 'required',
            'nama_obat' => 'required|array',
            'nama_obat.*' => 'required|string',
            'satuan.*' => 'nullable|string',
            'jumlah_obat.*' => 'nullable|integer',
            'catatan_resep' => 'nullable|string',
        ]);

        foreach ($request->nama_obat as $nama_obat) {
            $exists = ResepObat::where('nama_obat', $nama_obat)->exists();
            if (!$exists) {
                return redirect()->back()->with('error', 'Obat dengan nama ' . $nama_obat . ' tidak tersedia dalam daftar resep obat.');
            }
        }

        if ($request->has('tanda_tangan')) {
            $signature = $request->input('tanda_tangan');
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $signatureData = base64_decode($signature);

            $fileName = 'signatures/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $signatureData);
        }

        $diagnosa = Diagnosa::where('kode_icd', $request->kode_icd10)->first();
        $pasien = Pasien::where('no_rm', $request->no_rm)->first();
        $kunjungan = Kunjungan::where('tanggal_kunjungan', $request->tanggal_kunjungan)->first();
        $user = User::where('name', $request->name)->first();

        $pemeriksaan = PemeriksaanKia::create([
            'pasien_id' => $pasien->id,
            'kunjungan_id' => $kunjungan->id,
            'user_id' => $user->id,
            'diagnosa_id' => $diagnosa->id,
            'subject_keluhan' => $request->keluhan_pasien,
            'riwayat_alergi' => $request->riwayat_alergi,
            'catatan_assessment' => $request->catatan_assessment,
            'rencana_tindaklanjut' => $request->rencana_tindaklanjut,
            'tindakan' => $request->tindakan,
            'rujukan' => $request->rujukan,
            'tanda_tangan' => $fileName,
            'catatan_resep' => $request->catatan_resep,
        ]);

        $obatData = [];
        foreach ($request->nama_obat as $key => $nama_obat) {
            $resepObat = ResepObat::where('nama_obat', $nama_obat)->first();
            $obatData[] = [
                'pemeriksaan_kia_id' => $pemeriksaan->id,
                'resep_obat_id' => $resepObat->id,
                'nama_obat' => $nama_obat,
                'satuan' => $request->satuan[$key],
                'jumlah_obat' => $request->jumlah_obat[$key],
            ];
        }

        PemeriksaanKiaObat::insert($obatData);

        $kunjungan = Kunjungan::findOrFail($request->kunjungan_id);
        $kunjungan->status = 'Sudah Terlayani';
        $kunjungan->save();

        return redirect()->back()->with('success', 'Pemeriksaan berhasil disimpan.');
    }
}
