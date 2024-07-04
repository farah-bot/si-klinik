<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kode_obat', 'nama_obat', 'stok', 'harga', 'tanggal_masuk'
    ];
}
