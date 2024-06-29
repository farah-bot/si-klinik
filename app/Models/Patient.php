<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'no_rm', 'jenis_kelamin', 'nama_lengkap', 'tanggal_lahir',
        'alamat', 'nomor_telepon', 'nik', 'jenis_pasien', 'nomor_bpjs',
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
