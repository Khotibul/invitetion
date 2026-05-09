<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Developer / super admin
        User::updateOrCreate(
            ['email' => 'admin@risadigital.com'],
            [
                'name'     => 'Admin Risa',
                'password' => Hash::make('Admin@2025!'),
                'role'     => 'admin',
            ]
        );

        // Developer (akses penuh)
        User::updateOrCreate(
            ['email' => 'dev@risadigital.com'],
            [
                'name'     => 'Developer',
                'password' => Hash::make('Dev@2025!'),
                'role'     => 'developer',
            ]
        );
    }
}
