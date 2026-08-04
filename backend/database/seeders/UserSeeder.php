<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Posko;
use App\Models\Bpbd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $bpbd = Bpbd::first();
        $poskoKomando = Posko::where('tipe_posko', 'komando')->first();
        $poskoKecil = Posko::where('tipe_posko', 'lapangan_kecil')->first();

        User::create([
            'name' => 'Admin BPBD Utama',
            'email' => 'admin@bpbd.go.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'posko_id' => null,
            'bpbd_id' => $bpbd?->id,
        ]);

        User::create([
            'name' => 'Koordinator Komando',
            'email' => 'komando@rescuelog.com',
            'password' => Hash::make('password123'),
            'role' => 'komando',
            'posko_id' => $poskoKomando?->id,
        ]);

        User::create([
            'name' => 'Petugas Lapangan A',
            'email' => 'petugas@rescuelog.com',
            'password' => Hash::make('password123'),
            'role' => 'lapangan',
            'posko_id' => $poskoKecil?->id,
        ]);
    }
}