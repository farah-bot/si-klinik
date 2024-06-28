<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'Dashboard',
            'Poli Gigi',
            'Poli Umum',
            'Data Poli Umum',
            'Riwayat Pelayanan Pasien',
            'Data Antrian Poli',
            'Form Pendaftaran',
            'Laporan Kunjungan',
            'Laporan Surveilens Mingguan',
            'Laporan Surveilens Bulanan',
            'Laporan 10 Besar Penyakit',
            'Laporan Jumlah Jasa Pelayanan Dokter',
            'Data Antrian Apotek',
            'Poli KIA',
        ];

        foreach ($permissions as $permission) {
            // Check if the permission already exists
            $existingPermission = Permission::where('name', $permission)->first();
            if (!$existingPermission) {
                Permission::create(['name' => $permission]);
            }
        }

        $roles = [
            'Dokter' => ['Dashboard', 'Poli Gigi', 'Poli Umum', 'Riwayat Pelayanan Pasien', 'Data Poli Umum'],
            'Admin' => [
                'Dashboard',
                'Poli Gigi',
                'Poli Umum',
                'Data Poli Umum',
                'Riwayat Pelayanan Pasien',
                'Data Antrian Poli',
                'Form Pendaftaran',
                'Laporan Kunjungan',
                'Laporan Surveilens Mingguan',
                'Laporan Surveilens Bulanan',
                'Laporan 10 Besar Penyakit',
                'Laporan Jumlah Jasa Pelayanan Dokter',
                'Data Antrian Apotek',
                'Poli KIA',
            ],
            'Rekam Medis' => ['Dashboard', 'Data Antrian Poli', 'Form Pendaftaran', 'Riwayat Pelayanan Pasien', 'Laporan Kunjungan', 'Laporan Surveilens Mingguan', 'Laporan Surveilens Bulanan', 'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter'],
            'Apoteker' => ['Dashboard', 'Data Antrian Apotek'],
            'Bidan' => ['Dashboard', 'Poli KIA'],
            'Perawat' => ['Dashboard', 'Poli Umum', 'Riwayat Pelayanan Pasien'],
            'Kepala Klinik' => ['Riwayat Pelayanan Pasien', 'Laporan Kunjungan', 'Laporan Surveilens Mingguan', 'Laporan Surveilens Bulanan', 'Laporan 10 Besar Penyakit', 'Laporan Jumlah Jasa Pelayanan Dokter'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            // Check if the role already exists
            $existingRole = Role::where('name', $roleName)->first();
            if (!$existingRole) {
                $role = Role::create(['name' => $roleName]);
                // Assign permissions to role only if they exist
                foreach ($rolePermissions as $permissionName) {
                    $permission = Permission::where('name', $permissionName)->first();
                    if ($permission) {
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
