<?php

namespace Database\Seeders;

use App\Models\Posko;
use App\Models\Bpbd;
use App\Models\BencanaPending;
use Illuminate\Database\Seeder;

class PoskoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Data BPBD Wilayah (Sleman)
        $bpbd = Bpbd::firstOrCreate(
            ['nama_kabupaten_kota' => 'Kabupaten Sleman'],
            ['alamat_kantor' => 'Jl. Merdeka No. 1, Sleman']
        );

        // 2. Buat Posko Komando Utama
        $poskoKomando = Posko::create([
            'nama_posko'       => 'Posko Komando Sleman',
            'tipe_posko'       => 'komando',
            'bpbd_id'          => $bpbd->id,
            'bencana_id'       => null,
            'penanggung_jawab' => 'Budi Santoso',
            'lokasi'           => $bpbd->alamat_kantor, 
            'status'           => 'terdaftar_nonaktif',
        ]);

        // 3. TAMBAHKAN: Buat Posko Lapangan Kecil untuk Petugas Lapangan
        $poskoLapangan = Posko::create([
            'nama_posko'       => 'Posko Lapangan Sukamaju',
            'tipe_posko'       => 'lapangan_kecil',
            'bpbd_id'          => $bpbd->id,
            'bencana_id'       => null,
            'penanggung_jawab' => 'Petugas Lapangan A',
            'lokasi'           => 'Kec. Sukamaju, Kab. Sleman',
            'latitude'         => -7.7956,
            'longitude'        => 110.3695,
            'status'           => 'aktif',
        ]);

        // 4. Tambahkan Data Dummy Bencana Pending
        BencanaPending::create([
            'external_id'    => 'BMKG-TEST-001',
            'jenis_bencana'  => 'Gempabumi M 5.2',
            'wilayah'        => 'Kabupaten Sleman',
            'latitude'       => -7.7622,
            'longitude'      => 110.4025,
            'waktu_kejadian' => now(),
            'status'         => 'pending',
        ]);
    }
}