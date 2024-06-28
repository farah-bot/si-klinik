<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::info('Starting AdminSeeder');
        Log::info('Admin role created or retrieved');

        // Create admin user
        $adminUser = User::create([
            'name' => 'Dokter User',
            'jenis_kelamin' => 'Laki-Laki',
            'tanggal_lahir' => '22-02-2024 00:00:00',
            'jabatan' => 'Dokter',
            'alamat' => 'tes',
            'username' => 'dokter',
            'email' => 'dokter@admin.com',
            'password' => bcrypt('password'),
        ]);

        Log::info('Admin user created: ' . $adminUser->id);
        $role = Role::where('name','Admin')->first();
        if ($role) {
            $adminUser->assignRole($role);

            $this->assignDefaultPermissions($adminUser, $role->name);
        }

        Log::info('Admin role assigned to admin user');
    }

    private function assignDefaultPermissions($user, $roleName)
    {
        $permissions = [];

        switch ($roleName) {
            case 'Admin':
                $permissions = [
                    'Poli Gigi', 'Poli Umum', 'Riwayat Pelayanan Pasien', 'Data Poli Umum', 'Dashboard', 'Data Antrian Poli', 'Form Pendaftaran',
                    'Laporan Kunjungan', 'Laporan Surveilens Mingguan', 'Laporan Surveilens Bulanan',
                    'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter'
                ];
                break;
            case 'Dokter':
                $permissions = ['Dashboard', 'Poli Gigi', 'Poli Umum', 'Riwayat Pelayanan Pasien', 'Data Poli Umum'];
                break;
            case 'Rekam Medis':
                $permissions = [
                    'Dashboard', 'Data Antrian Poli', 'Form Pendaftaran', 'Riwayat Pelayanan Pasien',
                    'Laporan Kunjungan', 'Laporan Surveilens Mingguan', 'Laporan Surveilens Bulanan',
                    'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter'
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
            Log::info('Permissions assigned to user: ' . implode(', ', $permissions));
        }
    }
}
