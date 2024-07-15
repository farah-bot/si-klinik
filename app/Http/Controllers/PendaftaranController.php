<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\User;
use Illuminate\Support\Carbon;

class PendaftaranController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('pasien')->paginate(10);
        return view('pendaftaran.dataantrian', compact('kunjungans'));
    }

    public function dataAntrianPoli()
    {
        $today = Carbon::today();
        $kunjungans = Kunjungan::with('pasien')
            ->whereDate('tanggal_kunjungan', $today)
            ->paginate(10);

        return view('pendaftaran.dataantrianpoli', compact('kunjungans'));
    }

    public function dataPasien()
    {
        $kunjungans = Kunjungan::with('pasien')->get();
        return view('admin.datamaster.datapasien', compact('kunjungans'));
    }

    public function daftarPasien(Request $request)
    {
        $request->validate([
            'no_rm' => 'required|string|max:255|unique:pasiens,no_rm',
            'jenis_kelamin' => 'required|string',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'nik' => 'required|string|max:20|unique:pasiens,nik',
            'jenis_pasien' => 'required|string|in:Umum,BPJS',
            'nomor_bpjs' => $request->jenis_pasien === 'BPJS' ? 'required|string|max:255' : '',
            'tanggal_kunjungan' => 'required|date',
            'poli_tujuan' => 'required|string',
            'jenis_kunjungan' => 'required|string|in:Baru,Lama',
            'nama_dokter' => 'required|string|exists:users,name',
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

        $nomor_antrian_terakhir = Kunjungan::whereDate('tanggal_kunjungan', $request->tanggal_kunjungan)
            ->where('poli_tujuan', $request->poli_tujuan)
            ->max('nomor_antrian');

        $nomor_antrian_baru = $nomor_antrian_terakhir ? $nomor_antrian_terakhir + 1 : 1;

        $dokter = User::where('name', $request->nama_dokter)
            ->where(function ($query) {
                $query->where('jabatan', 'Dokter Gigi')
                    ->orWhere('jabatan', 'Dokter Umum')
                    ->orWhere('jabatan', 'Bidan');
            })
            ->first();
        $user_id = $dokter ? $dokter->id : null;

        $kunjungan = Kunjungan::create([
            'pasien_id' => $pasien->id,
            'user_id' => $user_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'poli_tujuan' => $request->poli_tujuan,
            'jenis_kunjungan' => $request->jenis_kunjungan,
            'status' => 'Belum Terlayani',
            'status_antrian' => 'Dalam Antrian',
            'nomor_antrian' => $nomor_antrian_baru,
        ]);

        return redirect()->route('datapasien')->with('success', 'Pendaftaran pasien berhasil.');
    }

    public function daftarPasienLama(Request $request)
    {
        $request->validate([
            'no_rm' => 'required|string|max:255|unique:pasiens,no_rm',
            'jenis_kelamin' => 'required|string',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'nik' => 'required|string|max:20|unique:pasiens,nik',
            'jenis_pasien' => 'required|string|in:Umum,BPJS',
            'nomor_bpjs' => $request->jenis_pasien === 'BPJS' ? 'required|string|max:255' : '',
            'tanggal_kunjungan' => 'required|date',
            'poli_tujuan' => 'required|string',
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

        $nomor_antrian_terakhir = Kunjungan::whereDate('tanggal_kunjungan', $request->tanggal_kunjungan)
            ->where('poli_tujuan', $request->poli_tujuan)
            ->max('nomor_antrian');

        $nomor_antrian_baru = $nomor_antrian_terakhir ? $nomor_antrian_terakhir + 1 : 1;

        $dokter = User::where('name', $request->nama_dokter)
            ->where(function ($query) {
                $query->where('jabatan', 'Dokter Gigi')
                    ->orWhere('jabatan', 'Dokter Umum')
                    ->orWhere('jabatan', 'Bidan');
            })
            ->first();
        $user_id = $dokter ? $dokter->id : null;

        $kunjungan = Kunjungan::create([
            'pasien_id' => $pasien->id,
            'user_id' => $user_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'poli_tujuan' => $request->poli_tujuan,
            'jenis_kunjungan' => 'Lama',
            'status' => 'Sudah Terlayani',
            'status_antrian' => 'Dalam Antrian',
            'nomor_antrian' => $nomor_antrian_baru,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran pasien berhasil.');
    }

    public function edit($id)
    {
        $pasien = Pasien::with('kunjungans.user')->findOrFail($id);
        $dokters = User::whereHas('roles', function ($query) {
            $query->where('name', 'Dokter Umum')
                ->orWhere('name', 'Dokter Gigi')
                ->orWhere('name', 'Bidan')
                ->orWhere('name', 'Kepala Klinik');
        })->get();
        return view('pendaftaran.editpasien', compact('pasien', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_pasien' => 'required',
            'kunjungans.*.tanggal_kunjungan' => 'required|date',
            'kunjungans.*.poli_tujuan' => 'required',
            'kunjungans.*.jenis_kunjungan' => 'required',
            'kunjungans.*.user_id' => 'required|exists:users,id',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->only(['nama', 'alamat', 'jenis_kelamin', 'tanggal_lahir', 'jenis_pasien', 'nomor_bpjs']));

        foreach ($request->kunjungans as $index => $kunjunganData) {
            $nomor_antrian_terakhir = Kunjungan::whereDate('tanggal_kunjungan', $kunjunganData['tanggal_kunjungan'])
                ->where('poli_tujuan', $kunjunganData['poli_tujuan'])
                ->max('nomor_antrian');

            $nomor_antrian_baru = $nomor_antrian_terakhir ? $nomor_antrian_terakhir + 1 : 1;

            if (isset($kunjunganData['id'])) {
                $kunjungan = Kunjungan::findOrFail($kunjunganData['id']);
                $kunjungan->update([
                    'tanggal_kunjungan' => $kunjunganData['tanggal_kunjungan'],
                    'poli_tujuan' => $kunjunganData['poli_tujuan'],
                    'jenis_kunjungan' => $kunjunganData['jenis_kunjungan'],
                    'user_id' => $kunjunganData['user_id'],
                    'nomor_antrian' => $nomor_antrian_baru,
                ]);
            } else {
                $kunjungan = new Kunjungan([
                    'tanggal_kunjungan' => $kunjunganData['tanggal_kunjungan'],
                    'poli_tujuan' => $kunjunganData['poli_tujuan'],
                    'jenis_kunjungan' => $kunjunganData['jenis_kunjungan'],
                    'user_id' => $kunjunganData['user_id'],
                    'nomor_antrian' => $nomor_antrian_baru,
                ]);
                $kunjungan->pasien()->associate($pasien);
                $kunjungan->save();
            }
        }

        return redirect()->route('dataantrian')->with('success', 'Data pasien dan kunjungan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->kunjungans()->delete();
        $pasien->delete();

        return redirect()->route('dataantrian')->with('success', 'Data pasien dan kunjungannya berhasil dihapus');
    }

    public function dataPoliGigi()
    {
        $today = now()->format('Y-m-d');

        $kunjungans = Kunjungan::with('pasien')
            ->where('poli_tujuan', 'Poli Gigi')
            ->whereDate('tanggal_kunjungan', $today)
            ->get();

        return view('pemeriksaan.datapoligigi', compact('kunjungans'));
    }

    public function dataPoliKia()
    {
        $today = now()->format('Y-m-d');

        $kunjungans = Kunjungan::with('pasien')
            ->where('poli_tujuan', 'Poli KIA')
            ->whereDate('tanggal_kunjungan', $today)
            ->get();

        return view('pemeriksaan.datapolikia', compact('kunjungans'));
    }

    public function dataPoliUmum()
    {
        $today = now()->format('Y-m-d');

        $kunjungans = Kunjungan::with('pasien')
            ->where('poli_tujuan', 'Poli Umum')
            ->whereDate('tanggal_kunjungan', $today)
            ->get();

        return view('pemeriksaan.datapoliumum', compact('kunjungans'));
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

    public function skipStatus($id, Request $request)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status = 'Belum Terlayani';
        if ($kunjungan->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function deleteKunjungan($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        if ($kunjungan->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
