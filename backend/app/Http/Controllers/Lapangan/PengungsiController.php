<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendataan;
use Illuminate\Support\Facades\Auth;

class PengungsiController extends Controller
{
    /**
     * Menampilkan Halaman Pendataan Pengungsi (Dashboard Mini)
     */
    public function index()
    {
        // 1. Ambil data pendataan terakhir (untuk ditampilkan di kotak ringkasan)
        $pendataan_terakhir = Pendataan::where('user_id', Auth::id())->latest()->first();

        // 2. Ambil riwayat pendataan (untuk ditampilkan di tabel)
        $riwayat_pendataan = Pendataan::where('user_id', Auth::id())->latest()->get();

        // 3. Logika Smart Empty State: Jika belum ada data sama sekali, bernilai true
        $isFirstTime = $riwayat_pendataan->isEmpty();

        return view('dashboard.lapangan.pengungsi.index', compact(
            'pendataan_terakhir', 
            'riwayat_pendataan', 
            'isFirstTime'
        ));
    }

    /**
     * Menyimpan data pendataan ke database lalu REDIRECT ke Prediksi ML.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_pengungsi'  => 'required|numeric|min:0',
            'balita'           => 'required|numeric|min:0',
            'dewasa'           => 'required|numeric|min:0',
            'ibu_hamil'        => 'required|numeric|min:0',
            'lansia'           => 'required|numeric|min:0',
            'disabilitas'      => 'required|numeric|min:0',
            'tipe_tempat'      => 'required|string',
            'akses_air'        => 'required|string',
            'akses_jalan'      => 'required|string',
            'lama_pengungsian' => 'required|numeric|min:1',
            'suhu_celcius'     => 'nullable|numeric',
            'cuaca'            => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        
        // Fallback jika kosong
        $validated['suhu_celcius'] = $request->suhu_celcius ?? 28.5;
        $validated['cuaca'] = $request->cuaca ?? 'Berawan';

        Pendataan::create($validated);

        return redirect()->route('lapangan.pengajuan.index')
            ->with('success', 'Data pendataan & kondisi cuaca real-time berhasil disimpan. Menampilkan estimasi AI.');
    }
}