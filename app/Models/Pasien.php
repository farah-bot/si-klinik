<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm', 'jenis_kelamin', 'nama', 'tanggal_lahir', 'alamat',
        'nomor_telepon', 'nik', 'jenis_pasien', 'nomor_bpjs'
    ];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
