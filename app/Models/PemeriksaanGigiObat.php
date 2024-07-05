<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanGigiObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_gigi_id',
        'resep_obat_id',
        'nama_obat',
        'satuan',
        'jumlah_obat',
    ];

    public function pemeriksaanGigi()
    {
        return $this->belongsTo(PemeriksaanGigi::class);
    }
    
    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class);
    }
}
