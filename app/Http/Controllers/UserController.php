<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengguna' => 'required|string|max:255',
            'nama_pengguna' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jabatan' => 'required|string',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        try {
            $user = User::create([
                'name' => $validated['nama_pengguna'],
                'email' => $validated['username'] . '@example.com', 
                'password' => bcrypt($validated['password']),
            ]);

            $role = Role::where('name', $validated['jabatan'])->first();
            if ($role) {
                $user->assignRole($role);
            }

            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan pengguna.');
        }
    }
}
