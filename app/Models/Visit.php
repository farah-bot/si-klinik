<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'patient_id', 'tanggal_kunjungan', 'poli_tujuan', 'jenis_kunjungan',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
