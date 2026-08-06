<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\Posko; // Mengimpor model Posko yang sudah kamu buat

class DashboardLapanganController extends Controller
{
    public function index()
    {
        // Mencari data posko dengan tipe lapangan_kecil dari database
        $subPosko = Posko::where('tipe_posko', 'lapangan_kecil')->first();

        // Jika di database belum ada data sama sekali, gunakan data dummy sementara
        // agar tampilan peta dan Blade tidak mengalami error/undefined variable.
        if (!$subPosko) {
            $subPosko = (object) [
                'nama_posko' => 'Posko Lapangan (Belum Ada Data di Database)',
                'status' => 'Standby',
                'latitude' => -6.2088,   // Contoh koordinat default (Jakarta)
                'longitude' => 106.8456,
            ];
        }

        // Kembalikan ke tampilan view index
        return view('dashboard.lapangan.index', compact('subPosko'));
    }
}