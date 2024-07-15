<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use App\Models\Kunjungan;
use Carbon\Carbon;


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($request->has('filter_tanggal')) {
            $filterTanggal = $request->filter_tanggal;
            $query->whereDate('tanggal_kunjungan', $filterTanggal);
        }

        if ($request->has('filter_poli')) {
            $filterPoli = $request->filter_poli;
            if ($filterPoli !== 'Semua') {
                $query->where('jenis_pasien', $filterPoli);
            }
        }

        $dataPasien = $query->paginate(10);

        return view('rekammedis.laporankunjungan', compact('dataPasien'));
    }

    public function laporan10BesarPenyakit()
    {
        $laporanPenyakit = DB::table('diagnosas')
            ->select(
                'diagnosas.diagnosis',
                'diagnosas.kode_icd',
                DB::raw('SUM(COALESCE(pkias.jumlah, 0) + COALESCE(pgigis.jumlah, 0) + COALESCE(pumums.jumlah, 0)) as total_jumlah')
            )
            ->leftJoin(DB::raw('(SELECT diagnosa_id, COUNT(*) as jumlah FROM pemeriksaan_kias GROUP BY diagnosa_id) as pkias'), 'diagnosas.id', '=', 'pkias.diagnosa_id')
            ->leftJoin(DB::raw('(SELECT diagnosa_id, COUNT(*) as jumlah FROM pemeriksaan_gigis GROUP BY diagnosa_id) as pgigis'), 'diagnosas.id', '=', 'pgigis.diagnosa_id')
            ->leftJoin(DB::raw('(SELECT diagnosa_id, COUNT(*) as jumlah FROM pemeriksaan_umums GROUP BY diagnosa_id) as pumums'), 'diagnosas.id', '=', 'pumums.diagnosa_id')
            ->groupBy('diagnosas.id', 'diagnosas.diagnosis', 'diagnosas.kode_icd')
            ->orderByDesc('total_jumlah')
            ->take(10)
            ->get();


        return view('rekammedis.laporanpenyakit', [
            'laporanPenyakit' => $laporanPenyakit
        ]);
    }

    public function laporanJasa(Request $request)
    {
        $query = Kunjungan::with('user', 'pasien');

        if ($request->has('filterTanggal') && $request->filterTanggal != '') {
            $query->whereDate('tanggal_kunjungan', $request->filterTanggal);
        }

        if ($request->has('filterPoli') && $request->filterPoli != '') {
            $query->where('poli_tujuan', $request->filterPoli);
        }

        if ($request->has('filterWaktu') && $request->filterWaktu != '') {
            if ($request->filterWaktu == 'Pagi') {
                $query->whereTime('updated_at', '>=', '08:00:00')
                ->whereTime('updated_at', '<=', '14:00:00');
            } else {
                $query->whereTime('updated_at', '>=', '15:00:00')
                ->whereTime('updated_at', '<=', '20:00:00');
            }
        }

        if ($request->has('filterDokter') && $request->filterDokter != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filterDokter . '%');
            });
        }

        $data = $query->where('status', 'Sudah Terlayani')
        ->get()
            ->groupBy(['tanggal_kunjungan', function ($item) {
                return Carbon::parse($item->updated_at)->format('H:i') < '15:00' ? 'Pagi' : 'Sore';
            }, 'poli_tujuan', 'user_id']);

        $results = [];
        foreach ($data as $tanggal => $waktuGroups) {
            foreach ($waktuGroups as $waktu => $poliGroups) {
                foreach ($poliGroups as $poli => $dokterGroups) {
                    foreach ($dokterGroups as $dokterId => $kunjungans) {
                        $dokterName = $kunjungans->first()->user->name;
                        $bpjsCount = $kunjungans->where('pasien.jenis_pasien', 'BPJS')->count();
                        $umumCount = $kunjungans->where('pasien.jenis_pasien', 'Umum')->count();
                        $totalCount = $kunjungans->count();

                        $results[] = [
                            'tanggal' => Carbon::parse($tanggal)->format('d/m/Y'),
                            'waktu' => $waktu,
                            'poli' => $poli,
                            'dokter' => $dokterName,
                            'bpjs' => $bpjsCount,
                            'umum' => $umumCount,
                            'total' => $totalCount,
                        ];
                    }
                }
            }
        }

        return view('rekammedis.laporanjasa', compact('results'));
    }
}
