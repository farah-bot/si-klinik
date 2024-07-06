<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

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

        $dataPasien = $query->get();

        return view('rekammedis.laporankunjungan', compact('dataPasien'));
    }

    public function laporan10BesarPenyakit()
    {
        $laporanPenyakit = DB::table('diagnosas')
            ->select(
                'diagnosas.diagnosis',
                'diagnosas.kode_icd',
                DB::raw('SUM(COALESCE(pkias.jumlah, 0) + COALESCE(pgigis.jumlah, 0)) as total_jumlah')
            )
            ->leftJoin(DB::raw('(SELECT diagnosa_id, COUNT(*) as jumlah FROM pemeriksaan_kias GROUP BY diagnosa_id) as pkias'), 'diagnosas.id', '=', 'pkias.diagnosa_id')
            ->leftJoin(DB::raw('(SELECT diagnosa_id, COUNT(*) as jumlah FROM pemeriksaan_gigis GROUP BY diagnosa_id) as pgigis'), 'diagnosas.id', '=', 'pgigis.diagnosa_id')
            // ->leftJoin(DB::raw('(SELECT diagnosa_id, COUNT(*) as jumlah FROM pemeriksaan_umums GROUP BY diagnosa_id) as pumums'), 'diagnosas.id', '=', 'pumums.diagnosa_id')
            ->groupBy('diagnosas.id', 'diagnosas.diagnosis', 'diagnosas.kode_icd')
            ->orderByDesc('total_jumlah')
            ->take(10)
            ->get();


        return view('rekammedis.laporanpenyakit', [
            'laporanPenyakit' => $laporanPenyakit
        ]);
    }
}
