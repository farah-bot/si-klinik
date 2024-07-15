<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.datamaster.datapengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
                'jabatan' => $validated['jabatan'],
                'username' => $validated['username'],
                'email' => $validated['username'] . '@example.com',
                'password' => bcrypt($validated['password']),
            ]);

            $role = Role::where('name', $validated['jabatan'])->first();
            if ($role) {
                $user->assignRole($role);

                $this->assignDefaultPermissions($user, $role->name);
            }

            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan pengguna.');
        }
    }

    private function assignDefaultPermissions($user, $roleName)
    {
        $permissions = [];

        switch ($roleName) {
            case 'Admin':
                $permissions = [
                    'Poli Gigi', 'Poli Umum', 'Riwayat Pelayanan Pasien', 'Data Poli Umum', 'Dashboard', 'Data Antrian Poli', 'Form Pendaftaran',
                    'Laporan Kunjungan', 'Laporan Surveilens Mingguan', 'Laporan Surveilens Bulanan',
                    'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter', 'Register', 'Data Diagnosa', 'Data Obat', 'Data Pasien',
                ];
                break;
            case 'Dokter Umum':
                $permissions = ['Dashboard', 'Poli Umum', 'Riwayat Pelayanan Pasien', 'Data Poli Umum'];
                break;
            case 'Dokter Gigi':
                $permissions = ['Dashboard', 'Poli Gigi', 'Riwayat Pelayanan Pasien', 'Data Poli Gigi'];
                break;
            case 'Rekam Medis':
                $permissions = [
                    'Dashboard', 'Data Antrian Poli', 'Form Pendaftaran', 'Riwayat Pelayanan Pasien',
                    'Laporan Kunjungan', 'Laporan Surveilens Mingguan', 'Laporan Surveilens Bulanan',
                    'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter', 'Register'
                ];
                break;
            case 'Apoteker':
                $permissions = ['Dashboard', 'Data Antrian Apotek'];
                break;
            case 'Bidan':
                $permissions = ['Dashboard', 'Poli KIA'];
                break;
            case 'Perawat':
                $permissions = ['Dashboard', 'Poli Umum', 'Riwayat Pelayanan Pasien'];
                break;
            case 'Kepala Klinik':
                $permissions = [
                    'Riwayat Pelayanan Pasien', 'Laporan Kunjungan', 'Laporan Surveilens Mingguan',
                    'Laporan Surveilens Bulanan', 'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter'
                ];
                break;
        }

        if (!empty($permissions)) {
            $user->givePermissionTo($permissions);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jabatan' => 'required|string',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $validated['nama_pengguna'];
            $user->alamat = $validated['alamat'];
            $user->jenis_kelamin = $validated['jenis_kelamin'];
            $user->tanggal_lahir = $validated['tanggal_lahir'];
            $user->jabatan = $validated['jabatan'];
            $user->username = $validated['username'];
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }
            $user->save();

            $role = Role::where('name', $validated['jabatan'])->first();
            if ($role) {
                $user->syncRoles($role);
                $this->assignDefaultPermissions($user, $role->name);
            }

            return redirect()->back()->with('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui pengguna.');
        }
    }
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->roles()->detach();
            $user->permissions()->detach();

            $user->delete();

            return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pengguna.');
        }
    }
}
