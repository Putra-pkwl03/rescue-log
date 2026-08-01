<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Posko;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $poskoKomando = Posko::where('tipe_posko', 'komando')->first();
        $poskoKecil = Posko::where('tipe_posko', 'lapangan_kecil')->first();

        // 1. Super Admin / Admin BPBD Utama
        User::create([
            'name' => 'Admin BPBD Utama',
            'email' => 'admin@bpbd.go.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'posko_id' => null, // Bebas memantau seluruh posko
        ]);

        // 2. Koordinator Posko Komando
        User::create([
            'name' => 'Koordinator Komando',
            'email' => 'komando@rescuelog.com',
            'password' => Hash::make('password123'),
            'role' => 'koordinator_komando',
            'posko_id' => $poskoKomando?->id,
        ]);

        // 3. Petugas Lapangan
        User::create([
            'name' => 'Petugas Lapangan A',
            'email' => 'petugas@rescuelog.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas_lapangan',
            'posko_id' => $poskoKecil?->id,
        ]);
    }
}
