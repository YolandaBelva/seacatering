<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk admin
        User::updateOrCreate(
            ['email' => 'admin@seacatering.com'],
            [
                'fullname' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN',
            ]
        );
    }
}
