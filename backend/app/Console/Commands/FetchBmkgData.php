<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BencanaPending;
use Carbon\Carbon;

class FetchBmkgData extends Command
{
    protected $signature = 'disaster:fetch-bmkg';
    protected $description = 'Mengambil data bencana gempabumi terbaru dari API BMKG secara otomatis';

    public function handle()
    {
        $this->info('Memulai pengambilan data dari BMKG...');

        try {
            // Gunakan endpoint 'gempaterkini.json' (15 gempa M 5.0+ terbaru) atau 'autogempa.json'
            $url = 'https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json';

            // HTTP Request dengan bypass SSL (withoutVerifying) & User-Agent
            $response = Http::withoutVerifying() 
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) SiGap-BPBD/1.0',
                    'Accept'     => 'application/json',
                ])
                ->timeout(15)
                ->get($url);

            if ($response->failed()) {
                $this->error('Gagal terhubung ke API BMKG. Status Code: ' . $response->status());
                return 1;
            }

            $gempaList = $response->json()['Infogempa']['gempa'] ?? [];

            // Jika response berupa associative array tunggal (seperti pada autogempa.json), bungkus jadi array
            if (isset($gempaList['Tanggal'])) {
                $gempaList = [$gempaList];
            }

            $insertedCount = 0;

            foreach ($gempaList as $gempa) {
                // Buat Unique External ID
                $externalId = 'BMKG-' . md5(($gempa['DateTime'] ?? $gempa['Jam']) . $gempa['Coordinates']);

                // Parse Koordinat (Format BMKG: "-6.90,106.85")
                $coords = explode(',', $gempa['Coordinates'] ?? '0,0');
                $lat = isset($coords[0]) ? (float) trim($coords[0]) : 0;
                $lng = isset($coords[1]) ? (float) trim($coords[1]) : 0;

                // Formatter Waktu Kejadian
                $waktu = isset($gempa['DateTime']) 
                    ? Carbon::parse($gempa['DateTime']) 
                    : Carbon::now();

                // Simpan ke database jika belum pernah ada
                $bencana = BencanaPending::firstOrCreate(
                    ['external_id' => $externalId],
                    [
                        'sumber_api'     => 'BMKG TEWS',
                        'jenis_bencana'  => 'Gempabumi',
                        'wilayah'        => $gempa['Wilayah'] ?? 'Tidak diketahui',
                        'magnitude'      => $gempa['Magnitude'] ?? null,
                        'kedalaman'      => $gempa['Kedalaman'] ?? null,
                        'potensi'        => $gempa['Potensi'] ?? 'Tidak Berpotensi Tsunami',
                        'latitude'       => $lat,
                        'longitude'      => $lng,
                        'waktu_kejadian' => $waktu,
                        'raw_payload'    => $gempa,
                        'status'         => 'pending',
                    ]
                );

                if ($bencana->wasRecentlyCreated) {
                    $insertedCount++;
                }
            }

            $this->info("Berhasil! {$insertedCount} data bencana baru berhasil disimpan ke penampungan.");
            return 0;

        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan: ' . $e->getMessage());
            return 1;
        }
    }
}