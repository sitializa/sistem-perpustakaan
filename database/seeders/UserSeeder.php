<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@perpustakaan.test'],
            [
                'name' => 'Admin',
                'password' => 'password123',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@perpustakaan.test'],
            [
                'name' => 'Petugas',
                'password' => 'password123',
                'role' => 'petugas',
            ]
        );
    }
}