<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'jenis_kelamin' => 'Laki-Laki',
            'tanggal_lahir' => '22-02-2024 00:00:00',
            'jabatan' => 'admin',
            'alamat' => 'tes',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Assign admin role to the admin user
        $adminUser->assignRole($adminRole);

        // You can add more fields or customize the admin user creation as needed
    }
}
