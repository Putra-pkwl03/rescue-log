<?php

namespace App\Http\Controllers;

use App\Models\Pendataan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    /**
     * Menyimpan data dari Form Pendataan Pengungsi
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form Blade
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

        // 2. Tambahkan data ID user/posko dan parameter BMKG
        $validated['user_id'] = Auth::id();
        $validated['suhu_celcius'] = 28.5; 
        $validated['cuaca'] = 'Hujan Deras';

        // 3. Simpan atau perbarui data pendataan posko
        Pendataan::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return redirect()->back()->with('success', 'Data pendataan pengungsi berhasil disimpan.');
    }

    /**
     * Memproses Prediksi ML untuk Menu Pengajuan Logistik
     */
    public function predict(Request $request)
    {
        // 1. Ambil data pendataan terbaru milik posko/user yang sedang login
        $pendataan = Pendataan::where('user_id', Auth::id())->latest()->first();

        if (!$pendataan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data pendataan pengungsi belum diisi untuk posko ini.'
            ], 404);
        }

        // 2. Mapping key dari Database ke Key yang dibutuhkan Model Machine Learning
        $payload = [
            'total_pengungsi'       => (int) $pendataan->total_pengungsi,
            'anak_balita'           => (int) $pendataan->balita,            // Form: 'balita' -> ML: 'anak_balita'
            'dewasa'                => (int) $pendataan->dewasa,
            'ibu_hamil'             => (int) $pendataan->ibu_hamil,
            'lansia'                => (int) $pendataan->lansia,
            'disabilitas'           => (int) $pendataan->disabilitas,
            'suhu_celcius'          => (float) $pendataan->suhu_celcius,
            'lama_pengungsian_hari' => (int) $pendataan->lama_pengungsian, // Form: 'lama_pengungsian' -> ML: 'lama_pengungsian_hari'
            'tipe_tempat'           => (string) $pendataan->tipe_tempat,
            'akses_air'             => (string) $pendataan->akses_air,
            'cuaca'                 => (string) $pendataan->cuaca,
            'akses_jalan'           => (string) $pendataan->akses_jalan,
        ];

        // 3. Kirim request ke Service FastAPI
        $fastApiUrl = env('FASTAPI_URL') . '/predict';

        try {
            $response = Http::timeout(15)->post($fastApiUrl, $payload);

            if ($response->successful()) {
                $hasil = $response->json();

                return response()->json([
                    'status' => 'success',
                    'data'   => $hasil
                ]);
            }

            return response()->json([
                'error' => 'FastAPI mengembalikan respon error.'
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal terhubung ke FastAPI: ' . $e->getMessage()
            ], 500);
        }
    }
}