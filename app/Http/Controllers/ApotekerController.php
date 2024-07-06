<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;

class ApotekerController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('pasien')
        ->where('status','Sudah Terlayani')
        ->paginate(10);
        return view('apoteker.apotek.dataapotek', compact('kunjungans'));
    }
}
