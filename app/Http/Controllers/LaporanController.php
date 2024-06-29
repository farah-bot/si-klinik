<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

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
}
