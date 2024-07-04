<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = ResepObat::all();

        return view('admin.datamaster.dataobat', compact('obat'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required|string|max:255',
            'nama_obat' => 'required|string',
            'stok' => 'required|integer',
            'harga' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $obat = new ResepObat();
        $obat->kode_obat = $request->kode_obat;
        $obat->nama_obat = $request->nama_obat;
        $obat->stok = $request->stok;
        $obat->harga = $request->harga;
        $obat->tanggal_masuk = $request->tanggal_masuk;
        $obat->save();

        return response()->json(['message' => 'Obat berhasil ditambahkan'], 201);
    }
}
