<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Check if admin exists
        $admin = User::where('email', 'admin@seacatering.com')->first();

        if ($admin) {
            // Force update password and other fields
            $admin->update([
                'fullname' => 'admin',
                'password' => Hash::make('Adminsea@123'),
                'role' => 'ADMIN',
            ]);
        } else {
            // Create new admin if not exists
            User::create([
                'fullname' => 'admin',
                'email' => 'admin@seacatering.com',
                'password' => Hash::make('Adminsea@123'),
                'role' => 'ADMIN',
            ]);
        }
    }
}