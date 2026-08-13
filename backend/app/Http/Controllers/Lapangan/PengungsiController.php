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

        // Query berdasarkan posko_id (Bukan user_id)
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

        $validated = $request->validate([
            'total_pengungsi' => 'required|integer|min:0',
            'balita'           => 'nullable|integer|min:0',
            'lansia'           => 'nullable|integer|min:0',
            'ibu_hamil'        => 'nullable|integer|min:0',
            'disabilitas'      => 'nullable|integer|min:0',
            'tipe_tempat'      => 'nullable|string',
            'cuaca'            => 'nullable|string',
            'suhu_celcius'     => 'nullable|numeric',
            'catatan'          => 'nullable|string',
        ]);

        // Otomatis masukkan posko_id milik user yang sedang login
        $validated['posko_id'] = $user->posko_id;

        Pendataan::create($validated);

        return redirect()->route('lapangan.pengungsi.index')
            ->with('success', 'Data pengungsi berhasil diperbarui.');
    }
}