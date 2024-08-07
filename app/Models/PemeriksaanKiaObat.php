<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanKiaObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_kia_id',
        'nama_obat',
        'satuan',
        'jumlah_obat',
    ];

    public function pemeriksaanKia()
    {
        return $this->belongsTo(PemeriksaanKia::class);
    }

}
