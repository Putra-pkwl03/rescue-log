<?php

namespace Database\Seeders;

use App\Models\Armada;
use Illuminate\Database\Seeder;

class ArmadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $armadas = [
            [
                'nama_armada' => 'Truk Engkel Logistik A1',
                'plat_nomor'  => 'AB 8123 CD',
                'nama_driver' => 'Sugeng Rahardjo',
                'no_hp'       => '081234567890',
                'status'      => 'tersedia',
            ],
            [
                'nama_armada' => 'Truk Double Box B2',
                'plat_nomor'  => 'AB 9456 EF',
                'nama_driver' => 'Bambang Triyono',
                'no_hp'       => '082198765432',
                'status'      => 'tersedia',
            ],
            [
                'nama_armada' => 'Pick Up Rapid Response C1',
                'plat_nomor'  => 'AB 1029 GH',
                'nama_driver' => 'Eko Prasetyo',
                'no_hp'       => '085712341234',
                'status'      => 'tersedia',
            ],
            [
                'nama_armada' => 'Truk Serbaguna BPBD D1',
                'plat_nomor'  => 'AB 7711 IJ',
                'nama_driver' => 'Agus Setiawan',
                'no_hp'       => '089876543210',
                'status'      => 'dalam_tugas',
            ],
            [
                'nama_armada' => 'Pick Up Cadangan E2',
                'plat_nomor'  => 'AB 5543 KL',
                'nama_driver' => 'Dwi Cahyono',
                'no_hp'       => '081345678912',
                'status'      => 'tersedia', // 👈 Diubah dari 'rusak' menjadi 'tersedia'
            ],
        ];

        foreach ($armadas as $armada) {
            Armada::updateOrCreate(
                ['plat_nomor' => $armada['plat_nomor']],
                $armada
            );
        }
    }
}