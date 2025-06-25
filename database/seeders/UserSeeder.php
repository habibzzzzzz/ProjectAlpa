<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan user kurir
        User::create([
            'name' => 'Kurir Satu',
            'email' => 'kurir1@example.com',
            'password' => Hash::make('password'), // default password
            'role' => 'kurir',
        ]);
    }
}
