<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id', 'user_id', 'tanggal_kunjungan', 'poli_tujuan', 'jenis_kunjungan', 'status', 'status_antrian',
        'nomor_antrian',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
