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
        // 1. Validasi Input dari form Blade
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
        ]);

        // 2. Data Tambahan Otomatis
        $validated['user_id'] = Auth::id();
        $validated['suhu_celcius'] = 28.5; // (Diambil manual sementara)
        $validated['cuaca'] = 'Hujan Deras'; // (Diambil manual sementara)

        // 3. Simpan sebagai data baru (Karena ini riwayat harian/berkala, gunakan create, BUKAN updateOrCreate)
        Pendataan::create($validated);

        // 4. Redirect ke halaman Pengajuan (Yang otomatis menembak AI FastAPI)
        return redirect()->route('lapangan.pengajuan.index')
            ->with('success', 'Data pendataan berhasil diperbarui! Berikut adalah estimasi kebutuhan logistik terbaru dari AI.');
    }
}