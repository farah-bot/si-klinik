<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionController extends Controller
{
    public function addPermission(Request $request){
        $permissions = [
            'Data Pengguna',
            'Data Pasien',
            'Data Diagnosa',
            'Data Obat',
            'Dashboard',
            'Data Antrian Poli',
            'Form Pendaftaran',
            'Poli Gigi',
            'Poli KIA',
            'Riwayat Pelayanan Pasien',
            'Laporan Kunjungan',
            'Laporan Surveilens Mingguan',
            'Laporan Surveilens Bulanan',
            'Laporan 10 Besar Penyakit',
            'Laporan Jumlah Jasa Pelayanan Dokter',
            'Laporan Pasien Tuberkulosis',
            'Data Antrian Apotek',
        ];

        foreach($permissions as $permission){
            Permission::create(['name'=> $permission]);
        }
    }
}
