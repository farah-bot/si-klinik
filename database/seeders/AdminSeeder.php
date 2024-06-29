<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
        ]);
    }
}
