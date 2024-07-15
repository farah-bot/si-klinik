<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanUmum extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id' ,
        'kunjungan_id' ,
        'user_id' ,
        'diagnosa_id' ,
        'subject_keluhan' ,
        'riwayat_alergi' ,
        'tekanan_darah' ,
        'suhu_tubuh' ,
        'berat_badan' ,
        'nadi' ,
        'respiratory_rate' ,
        'keadaan_umum' ,
        'sakit_kepala_leher' ,
        'limfadenopati_leher' ,
        'anemis_mata' ,
        'hiperemia_mata' ,
        'fungsi_pendengaran' ,
        'simetris_hidung' ,
        'konka_hidung' ,
        'normal_gigi_mulut' ,
        'hiperemia_faring' ,
        'normal_urogenital' ,
        'pemeriksaan_penunjang' ,
        'lainnya' ,
        'catatan_assessment' ,
        'rencana_tindaklanjut' ,
        'tindakan' ,
        'rujukan' ,
        'tanda_tangan',
        'catatan_resep'
    ];

    public function obat()
    {
        return $this->hasMany(PemeriksaanUmumObat::class);
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
