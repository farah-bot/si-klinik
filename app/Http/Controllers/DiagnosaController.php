<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosa;

class DiagnosaController extends Controller
{
    public function index()
    {
        $diagnosas = Diagnosa::paginate(10);

        return view('admin.datamaster.datadiagnosa', compact('diagnosas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeICD' => 'required|string|max:255',
            'diagnosis' => 'required|string',
        ]);

        $diagnosis = new Diagnosa();
        $diagnosis->kode_icd = $request->kodeICD;
        $diagnosis->diagnosis = $request->diagnosis;
        $diagnosis->save();

        return response()->json(['message' => 'Diagnosis berhasil ditambahkan'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kodeICD' => 'required|string|max:255',
            'diagnosis' => 'required|string',
        ]);

        $diagnosis = Diagnosa::findOrFail($id);
        $diagnosis->kode_icd = $request->kodeICD;
        $diagnosis->diagnosis = $request->diagnosis;
        $diagnosis->save();

        return response()->json(['message' => 'Diagnosis berhasil diperbarui'], 200);
    }

    public function delete($id)
    {
        $diagnosis = Diagnosa::findOrFail($id);
        $diagnosis->delete();

        return response()->json(['message' => 'Diagnosis berhasil dihapus'], 200);
    }
}
