<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;

class PatientRegistrationController extends Controller
{
    public function patientRegister(Request $request)
    {
        $validated = $request->validate([
            'no_rm' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
            'nik' => 'required|string|max:255',
            'jenis_pasien' => 'required|string',
            'nomor_bpjs' => $request->jenis_pasien === 'BPJS' ? 'nullable|string|max:255' : '',
            'tanggal_kunjungan' => 'nullable|date',
            'poli_tujuan' => 'nullable|string',
            'jenis_kunjungan' => 'nullable|string',
        ]);

        try {
            $patientData = [
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'nama_lengkap' => $validated['nama'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'nik' => $validated['nik'],
                'jenis_pasien' => $validated['jenis_pasien'],
                'alamat' => $validated['alamat'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'nomor_bpjs' => $validated['nomor_bpjs'],
            ];

            $patient = Patient::updateOrCreate(
                ['no_rm' => $validated['no_rm']],
                $patientData
            );

            if (!empty($validated['tanggal_kunjungan']) && !empty($validated['poli_tujuan']) && !empty($validated['jenis_kunjungan'])) {
                $visitData = [
                    'patient_id' => $patient->id,
                    'tanggal_kunjungan' => $validated['tanggal_kunjungan'],
                    'poli_tujuan' => $validated['poli_tujuan'],
                    'jenis_kunjungan' => $validated['jenis_kunjungan'],
                ];

                Visit::create($visitData);
            }

            return redirect()->back()->with('success', 'Pendaftaran pasien berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mendaftarkan pasien.');
        }
    }
}
