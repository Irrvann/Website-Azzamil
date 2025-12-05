<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['username' => 'azzamil01'],
            [
                'password' => '01spdazzamil01',
                'status' => 'aktif'
            ]
        );

        $superAdmin->assignRole('super_admin');
    }
}
