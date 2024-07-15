<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanGigi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'kunjungan_id',
        'user_id',
        'diagnosa_id',
        'resep_obat_id',
        'subject_keluhan',
        'riwayat_alergi',
        'catatan_assessment',
        'rencana_tindaklanjut',
        'tindakan',
        'rujukan',
        'tanda_tangan',
        'catatan_resep',
        'file_support',
        'odontogram_notes',
    ];

    public function obat()
    {
        return $this->hasMany(PemeriksaanGigiObat::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }
}
