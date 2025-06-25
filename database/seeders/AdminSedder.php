<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@goborir.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'aktif'
        ]);
    }
} 