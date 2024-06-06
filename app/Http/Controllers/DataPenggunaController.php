<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DataPenggunaController extends Controller
{
    // // Menampilkan daftar pengguna
    // public function index()
    // {
    //     $users = User::all();
    //     return view('datapengguna', compact('users'));
    // }

    // // Menyimpan pengguna baru
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_pengguna' => 'required|unique:users,id',
    //         'jenis_kelamin' => 'required',
    //         'nama_pengguna' => 'required',
    //         'jabatan' => 'required',
    //         'tanggal_lahir' => 'required|date',
    //         'username' => 'required|unique:users,username',
    //         'alamat' => 'required',
    //         'password' => 'required|min:8',
    //     ]);

    //     User::create([
    //         'id' => $request->id_pengguna,
    //         'name' => $request->nama_pengguna,
    //         'jenis_kelamin' => $request->jenis_kelamin,
    //         'jabatan' => $request->jabatan,
    //         'tanggal_lahir' => $request->tanggal_lahir,
    //         'username' => $request->username,
    //         'alamat' => $request->alamat,
    //         'password' => bcrypt($request->password),
    //     ]);

    //     return redirect()->route('datapengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    // }

    // // Menampilkan form edit pengguna
    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('editdatapengguna', compact('user'));
    // }

    // // Mengupdate data pengguna
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_pengguna' => 'required|unique:users,id,'.$id,
    //         'jenis_kelamin' => 'required',
    //         'nama_pengguna' => 'required',
    //         'jabatan' => 'required',
    //         'tanggal_lahir' => 'required|date',
    //         'username' => 'required|unique:users,username,'.$id,
    //         'alamat' => 'required',
    //         'password' => 'nullable|min:8',
    //     ]);

    //     $user = User::findOrFail($id);
    //     $user->update([
    //         'id' => $request->id_pengguna,
    //         'name' => $request->nama_pengguna,
    //         'jenis_kelamin' => $request->jenis_kelamin,
    //         'jabatan' => $request->jabatan,
    //         'tanggal_lahir' => $request->tanggal_lahir,
    //         'username' => $request->username,
    //         'alamat' => $request->alamat,
    //         'password' => $request->password ? bcrypt($request->password) : $user->password,
    //     ]);

    //     return redirect()->route('datapengguna.index')->with('success', 'Pengguna berhasil diupdate.');
    // }

    // // Menghapus pengguna
    // public function destroy($id)
    // {
    //     User::destroy($id);
    //     return redirect()->route('datapengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    // }
}
