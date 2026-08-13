<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengungsiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil posko_id dari user yang sedang login
        $poskoId = $user->posko_id;

        // Query berdasarkan posko_id
        $pendataan_terakhir = Pendataan::where('posko_id', $poskoId)
            ->latest()
            ->first();

        $riwayat_pendataan = Pendataan::where('posko_id', $poskoId)
            ->latest()
            ->get();

        $isFirstTime = $riwayat_pendataan->isEmpty();

        return view('dashboard.lapangan.pengungsi.index', compact(
            'pendataan_terakhir',
            'riwayat_pendataan',
            'isFirstTime'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi seluruh inputan dari Modal Pendataan
        $validated = $request->validate([
            'total_pengungsi'  => 'required|integer|min:0',
            'balita'           => 'required|integer|min:0',
            'dewasa'           => 'required|integer|min:0',
            'lansia'           => 'required|integer|min:0',
            'ibu_hamil'        => 'required|integer|min:0',
            'disabilitas'      => 'required|integer|min:0',
            'tipe_tempat'      => 'required|string',
            'akses_air'        => 'required|string',
            'akses_jalan'      => 'required|string',
            'lama_pengungsian' => 'required|integer|min:1',
            'cuaca'            => 'nullable|string',
            'suhu_celcius'     => 'nullable|numeric',
            'catatan'          => 'nullable|string',
        ]);

        // Masukkan posko_id milik user yang sedang login
        $validated['posko_id'] = $user->posko_id;

        // Simpan data pendataan baru ke database
        Pendataan::create($validated);

        // REDIRECT LANGSUNG KE HALAMAN PENGAJUAN LOGISTIK
        return redirect()->route('lapangan.pengajuan.index')
            ->with('success', 'Data pengungsi berhasil diperbarui! Hasil kalkulasi rekomendasi logistik AI telah disesuaikan.');
    }
}