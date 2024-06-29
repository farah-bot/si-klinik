<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetugasRekamMedis;
use Illuminate\Support\Facades\Hash;

class PetugasRekamMedisSeeder extends Seeder
{
    public function run()
    {
        PetugasRekamMedis::create([
            'name' => 'rekammedis',
            'email' => 'rekam@rekam.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
