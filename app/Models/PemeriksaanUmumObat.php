<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanUmumObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_umum_id',
        'nama_obat',
        'satuan',
        'jumlah_obat',
    ];

    public function pemeriksaanUmum()
    {
        return $this->belongsTo(PemeriksaanUmum::class);
    }

}
