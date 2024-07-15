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
use App\Models\PemeriksaanUmum;
use App\Models\PemeriksaanUmumObat;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PemeriksaanController extends Controller
{
    public function showFormulirPoliGigi($nomorAntrian, $tanggalPeriksa, $pasien_id)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)
            ->where('tanggal_kunjungan', $tanggalPeriksa)
            ->where('pasien_id', $pasien_id)
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

    public static function deleteUnattendedVisits()
    {
        $today = Carbon::now()->format('d-m-Y');

        $unattendedVisits = Kunjungan::where('status', 'Belum Terlayani')
            ->whereDate('tanggal_kunjungan', '<', Carbon::createFromFormat('d-m-Y', $today))
            ->get();

        foreach ($unattendedVisits as $visit) {
            $visit->delete();
        }

        return response()->json(['success' => true, 'message' => 'Kunjungan yang belum terlayani hari ini telah dihapus.']);
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

    public function updateStatusAntrian($id, Request $request)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_antrian = $request->input('status_antrian');
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

        return view('pemeriksaan.detailpoligigi', [
            'pemeriksaan' => $pemeriksaan,
            'kunjungan' => $kunjungan,
            'tanda_tangan' => $tandaTangan,
            'obat' => $obat
        ]);
    }

    public function storePoliGigi(Request $request)
    {
        $request->validate([
            'keluhan_pasien' => 'required|string',
            'kode_icd10' => 'required|string|exists:diagnosas,kode_icd',
            'rencana_tindaklanjut' => 'required|string',
            'odontogram_notes' => 'required|string',
            'tanda_tangan' => 'required',
            'nama_obat' => 'required|array',
            'nama_obat.*' => 'required|string',
            'satuan.*' => 'nullable|string',
            'jumlah_obat.*' => 'nullable|integer',
            'catatan_resep' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        if ($request->has('tanda_tangan')) {
            $signature = $request->input('tanda_tangan');
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $signatureData = base64_decode($signature);

            $fileName = 'signatures/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $signatureData);
        }

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('file_support_tooth', $fileName, 'public');
        } else {
            $filePath = null;
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
            'odontogram_notes' => $request->odontogram_notes,
            'tindakan' => $request->tindakan,
            'rujukan' => $request->rujukan,
            'tanda_tangan' => $fileName,
            'catatan_resep' => $request->catatan_resep,
            'file_upload' => $filePath,
        ]);

        $obatData = [];
        foreach ($request->nama_obat as $key => $nama_obat) {
            $obatData[] = [
                'pemeriksaan_gigi_id' => $pemeriksaan->id,
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


    public function showFormulirPoliUmum($nomorAntrian, $tanggalPeriksa, $pasien_id)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)
            ->where('tanggal_kunjungan', $tanggalPeriksa)
            ->where('pasien_id', $pasien_id)
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

        return view('pemeriksaan.detailpoliumum', [
            'pemeriksaan' => $pemeriksaan,
            'kunjungan' => $kunjungan,
            'tanda_tangan' => $tandaTangan,
            'obat' => $obat,
        ]);
    }

    public function storePoliUmum(Request $request)
    {
        $request->validate([
            'keluhan_pasien' => 'required|string',
            'riwayat_alergi' => 'nullable',
            'tekanan_darah' => 'required',
            'suhu_tubuh' => 'required',
            'bb' => 'required',
            'nadi' => 'required',
            'rr' => 'required',
            'ku' => 'required',
            'sakit_kepala_leher' => 'required',
            'limfadenopati_leher' => 'required',
            'anemis_mata' => 'required',
            'hiperemia_mata' => 'required',
            'fungsi_pendengaran' => 'required',
            'simetris_hidung' => 'required',
            'konka_hidung' => 'required',
            'normal_gigi_mulut' => 'required',
            'hiperemia_faring' => 'required',
            'normal_urogenital' => 'required',
            'pemeriksaan_penunjang' => 'nullable|file|mimes:pdf,doc,docx',
            'lainnya' => 'nullable',
            'kode_icd10' => 'required|string|exists:diagnosas,kode_icd',
            'rencana_tindaklanjut' => 'required|string',
            'tanda_tangan' => 'required',
            'nama_obat' => 'required|array',
            'nama_obat.*' => 'required|string',
            'satuan.*' => 'nullable|string',
            'jumlah_obat.*' => 'nullable|integer',
            'catatan_resep' => 'nullable|string',
        ]);

        if ($request->has('tanda_tangan')) {
            $signature = $request->input('tanda_tangan');
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $signatureData = base64_decode($signature);

            $fileName = 'signatures/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $signatureData);
        }

        if ($request->hasFile('pemeriksaan_penunjang')) {
            $file = $request->file('pemeriksaan_penunjang');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('file_support', $fileName, 'public');
        } else {
            $filePath = null;
        }

        $diagnosa = Diagnosa::where('kode_icd', $request->kode_icd10)->first();
        $pasien = Pasien::where('no_rm', $request->no_rm)->first();
        $kunjungan = Kunjungan::where('id', $request->kunjungan_id)->first();
        $user = User::where('name', $request->name)->first();

        $pemeriksaan = PemeriksaanUmum::create([
            'pasien_id' => $pasien->id,
            'kunjungan_id' => $kunjungan->id,
            'user_id' => $user->id,
            'diagnosa_id' => $diagnosa->id,
            'subject_keluhan' => $request->keluhan_pasien,
            'riwayat_alergi' => $request->riwayat_alergi,
            'tekanan_darah' => $request->tekanan_darah,
            'suhu_tubuh' => $request->suhu_tubuh,
            'berat_badan' => $request->bb,
            'nadi' => $request->nadi,
            'respiratory_rate' => $request->rr,
            'keadaan_umum' => $request->ku,
            'sakit_kepala_leher' => $request->sakit_kepala_leher,
            'limfadenopati_leher' => $request->limfadenopati_leher,
            'anemis_mata' => $request->anemis_mata,
            'hiperemia_mata' => $request->hiperemia_mata,
            'fungsi_pendengaran' => $request->fungsi_pendengaran,
            'simetris_hidung' => $request->simetris_hidung,
            'konka_hidung' => $request->konka_hidung,
            'normal_gigi_mulut' => $request->normal_gigi_mulut,
            'hiperemia_faring' => $request->hiperemia_faring,
            'normal_urogenital' => $request->normal_urogenital,
            'pemeriksaan_penunjang' => $filePath,
            'lainnya' => $request->lainnya,
            'catatan_assessment' => $request->catatan_assessment,
            'rencana_tindaklanjut' => $request->rencana_tindaklanjut,
            'tindakan' => $request->tindakan,
            'rujukan' => $request->rujukan,
            'tanda_tangan' => $fileName,
            'catatan_resep' => $request->catatan_resep,
        ]);

        $obatData = [];
        foreach ($request->nama_obat as $key => $nama_obat) {
            $obatData[] = [
                'pemeriksaan_umum_id' => $pemeriksaan->id,
                'nama_obat' => $nama_obat,
                'satuan' => $request->satuan[$key],
                'jumlah_obat' => $request->jumlah_obat[$key],
            ];
        }

        PemeriksaanUmumObat::insert($obatData);
        $kunjungan = Kunjungan::findOrFail($request->kunjungan_id);
        $kunjungan->status = 'Sudah Terlayani';
        $kunjungan->save();

        return redirect()->back()->with('success', 'Pemeriksaan berhasil disimpan.');
    }
    public function showFormulirPoliKIA($nomorAntrian, $tanggalPeriksa, $pasien_id)
    {
        $kunjungan = Kunjungan::where('nomor_antrian', $nomorAntrian)
            ->where('tanggal_kunjungan', $tanggalPeriksa)
            ->where('pasien_id', $pasien_id)
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

        return view('pemeriksaan.detailpolikia', [
            'pemeriksaan' => $pemeriksaan,
            'kunjungan' => $kunjungan,
            'tanda_tangan' => $tandaTangan,
            'obat' => $obat
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
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        if ($request->has('tanda_tangan')) {
            $signature = $request->input('tanda_tangan');
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $signatureData = base64_decode($signature);

            $fileName = 'signatures/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $signatureData);
        }

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('file_support_kia', $fileName, 'public');
        } else {
            $filePath = null;
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
            'file_upload' => $filePath,
        ]);

        $obatData = [];
        foreach ($request->nama_obat as $key => $nama_obat) {
            $obatData[] = [
                'pemeriksaan_kia_id' => $pemeriksaan->id,
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
