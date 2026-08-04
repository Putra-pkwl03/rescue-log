<?php

namespace Database\Seeders;

use App\Models\Posko;
use App\Models\Bpbd;
use App\Models\Bencana;
use Illuminate\Database\Seeder;

class PoskoSeeder extends Seeder
{
    public function run(): void
    {
        $bpbd = Bpbd::create([
            'nama_kabupaten_kota' => 'Kabupaten Sleman',
            'alamat_kantor' => 'Jl. Merdeka No. 1, Sleman',
        ]);

        $poskoKomando = Posko::create([
            'nama_posko' => 'Posko Komando Sleman',
            'tipe_posko' => 'komando',
            'bpbd_id' => $bpbd->id,
            'penanggung_jawab' => 'Budi Santoso',
            'lokasi' => $bpbd->alamat_kantor, 
            'status' => 'aktif', 
        ]);

        // BARIS posko_id DI BAWAH INI SUDAH DIHAPUS
        $bencana = Bencana::create([
            'jenis_bencana' => 'Banjir',
            'lokasi_bencana' => 'Kecamatan Depok',
            'koordinat_operasional_lat' => -7.7622,
            'koordinat_operasional_lng' => 110.4025,
            'tanggal_aktivasi' => now(),
            'status' => 'sedang_berjalan',
        ]);

        Posko::create([
            'nama_posko' => 'Posko Lapangan Desa A',
            'tipe_posko' => 'lapangan_kecil',
            'parent_id' => $poskoKomando->id,
            'bencana_id' => $bencana->id,
            'penanggung_jawab' => 'Siti Aminah',
            'lokasi' => 'Balai Desa A',
            'kode_undangan' => 'RSC482',
            'status' => 'aktif',
        ]);
    }
}