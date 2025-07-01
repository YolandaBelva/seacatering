<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@seacatering.com')->first();

        if ($admin) {
            // Force update password
            $admin->update([
                'password' => Hash::make('Adminsea@123')
            ]);
        } else {
            // Create new admin
            User::create([
                'fullname' => 'admin',
                'email' => 'admin@seacatering.com',
                'password' => Hash::make('Adminsea@123'),
                'role' => 'admin'
            ]);
        }
    }
}
