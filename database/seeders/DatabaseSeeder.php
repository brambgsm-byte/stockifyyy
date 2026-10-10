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
        // Akun Admin
        User::create([
            'name' => 'Admin Stockify',
            'email' => 'admin@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Akun Manager Gudang
        User::create([
            'name' => 'Manager Gudang',
            'email' => 'manager@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // Akun Staff Gudang
        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}