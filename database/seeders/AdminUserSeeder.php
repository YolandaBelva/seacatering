<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@seacatering.com'],
            [
                'fullname' => 'admin',
                'email' => 'admin@seacatering.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );
    }
}
