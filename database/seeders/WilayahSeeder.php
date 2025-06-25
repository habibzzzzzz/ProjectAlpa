<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wilayah;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        $kurir = User::where('role', 'kurir')->first(); // pastikan kurir ada

        if ($kurir) {
            Wilayah::create([
                'nama_wilayah' => 'Plaju',
                'kurir_id' => $kurir->id,
            ]);
        } else {
            echo "Kurir belum ada di tabel users. Tambahkan dulu user dengan role 'kurir'.\n";
        }
    }
}
