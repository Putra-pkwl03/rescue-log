<?php

namespace Database\Seeders;

use App\Models\Posko;
use Illuminate\Database\Seeder;

class PoskoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Posko Komando Utama
        $poskoKomando = Posko::create([
            'nama_posko' => 'Posko Komando Utama (Stadion)',
            'tipe_posko' => 'komando',
            'parent_id' => null,
            'lokasi' => 'Jl. Merdeka No. 1',
            'kapasitas_maksimal' => 2000,
            'penanggung_jawab' => 'Budi Santoso',
            'kontak_hp' => '081234567890',
            'status' => 'aktif',
        ]);

        // 2. Posko Lapangan Kecil
        Posko::create([
            'nama_posko' => 'Posko Lapangan Desa A',
            'tipe_posko' => 'lapangan_kecil',
            'parent_id' => $poskoKomando->id,
            'lokasi' => 'Balai Desa A',
            'kapasitas_maksimal' => 200,
            'penanggung_jawab' => 'Siti Aminah',
            'kontak_hp' => '089876543210',
            'status' => 'aktif',
        ]);
    }
}