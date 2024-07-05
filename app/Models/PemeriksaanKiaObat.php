<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanKiaObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_kia_id',
        'resep_obat_id',
        'nama_obat',
        'satuan',
        'jumlah_obat',
    ];

    public function pemeriksaanGigi()
    {
        return $this->belongsTo(PemeriksaanKia::class);
    }

    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class);
    }
}
