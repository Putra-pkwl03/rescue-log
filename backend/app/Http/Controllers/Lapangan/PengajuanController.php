<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\Pendataan;
use App\Models\PengajuanKebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PengajuanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Log::info('PengajuanController@index - Mengambil data pengajuan untuk Posko ID: ' . $user->posko_id);

        // 1. Ambil data pendataan pengungsi terbaru khusus posko user yang sedang login
        $pendataan = Pendataan::where('posko_id', $user->posko_id)
            ->latest()
            ->first();

        // Jika belum ada pendataan di posko ini, alihkan pengguna
        if (!$pendataan) {
            Log::warning('PengajuanController@index - Pendataan tidak ditemukan untuk Posko ID: ' . $user->posko_id);
            return redirect()->route('lapangan.pengungsi.index')
                ->with('error', 'Silakan isi Form Pendataan Pengungsi terlebih dahulu sebelum mengajukan logistik.');
        }

        // 2. Format payload untuk dikirim ke Service Machine Learning (FastAPI)
        $payloadML = [
            'total_pengungsi'       => (int) $pendataan->total_pengungsi,
            'anak_balita'           => (int) $pendataan->balita,
            'dewasa'                => (int) $pendataan->dewasa,
            'ibu_hamil'             => (int) $pendataan->ibu_hamil,
            'lansia'                => (int) $pendataan->lansia,
            'disabilitas'           => (int) $pendataan->disabilitas,
            'suhu_celcius'          => (float) $pendataan->suhu_celcius,
            'lama_pengungsian_hari' => (int) $pendataan->lama_pengungsian,
            'tipe_tempat'           => (string) $pendataan->tipe_tempat,
            'akses_air'             => (string) $pendataan->akses_air,
            'cuaca'                 => (string) $pendataan->cuaca,
            'akses_jalan'           => (string) $pendataan->akses_jalan,
        ];

        $estimasi = [];
        try {
            $fastApiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8000') . '/predict';
            $response = Http::timeout(10)->post($fastApiUrl, $payloadML);

            if ($response->successful()) {
                $hasil = $response->json();
                $estimasi = $hasil['estimasi_kebutuhan'] ?? [];
            }
        } catch (\Exception $e) {
            Log::warning('PengajuanController@index - Gagal terkoneksi FastAPI ML: ' . $e->getMessage());
            session()->flash('warning', 'Gagal menghubungkan ke Service AI ML. Anda dapat mengisi jumlah logistik secara manual.');
        }

        // Ambil riwayat pengajuan milik posko/user
        $pengajuans = PengajuanKebutuhan::where('posko_id', $user->posko_id)
            ->latest()
            ->get();

        Log::info('PengajuanController@index - Berhasil mengambil pengajuan. Jumlah record ditemukan: ' . $pengajuans->count());

        return view('dashboard.lapangan.pengajuan.index', compact('pendataan', 'estimasi', 'pengajuans'));
    }

    public function create()
    {
        return redirect()->route('lapangan.pengajuan.index');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Ambil data pendataan berdasarkan posko_id user
        $pendataan = Pendataan::where('posko_id', $user->posko_id)
            ->latest()
            ->first();

        if (!$pendataan) {
            return redirect()->route('lapangan.pengungsi.index')
                ->with('error', 'Silakan isi Form Pendataan Pengungsi terlebih dahulu.');
        }

        // 1. Validasi 12 Input Kolom Eksplisit
        $validated = $request->validate([
            'beras_kg'             => 'nullable|numeric|min:0',
            'air_minum_dus'        => 'nullable|numeric|min:0',
            'makanan_kaleng_pack'  => 'nullable|numeric|min:0',
            'makanan_bayi_pack'    => 'nullable|numeric|min:0',
            'minyak_goreng_liter'  => 'nullable|numeric|min:0',
            'popok_bayi_pcs'       => 'nullable|numeric|min:0',
            'popok_dewasa_pcs'     => 'nullable|numeric|min:0',
            'pembalut_wanita_pack' => 'nullable|numeric|min:0',
            'hygiene_kit_paket'    => 'nullable|numeric|min:0',
            'selimut_pcs'          => 'nullable|numeric|min:0',
            'matras_terpal_pcs'    => 'nullable|numeric|min:0',
            'obat_p3k_paket'       => 'nullable|numeric|min:0',
            'catatan_posko'        => 'nullable|string',
        ]);

        // 2. Pastikan setidaknya ada 1 barang yang bernilai lebih dari 0
        $totalInput = (float) $request->input('beras_kg', 0)
            + (float) $request->input('air_minum_dus', 0)
            + (float) $request->input('makanan_kaleng_pack', 0)
            + (float) $request->input('makanan_bayi_pack', 0)
            + (float) $request->input('minyak_goreng_liter', 0)
            + (float) $request->input('popok_bayi_pcs', 0)
            + (float) $request->input('popok_dewasa_pcs', 0)
            + (float) $request->input('pembalut_wanita_pack', 0)
            + (float) $request->input('hygiene_kit_paket', 0)
            + (float) $request->input('selimut_pcs', 0)
            + (float) $request->input('matras_terpal_pcs', 0)
            + (float) $request->input('obat_p3k_paket', 0);

        if ($totalInput <= 0) {
            return redirect()->back()
                ->with('error', 'Minimal harus mengajukan 1 jenis logistik dengan jumlah lebih dari 0.')
                ->withInput();
        }

        try {
            // 3. Simpan langsung 1 record berisi ke-12 kolom barang ke tabel pengajuan_kebutuhan
            $pengajuan = PengajuanKebutuhan::create([
                'kode_pengajuan'       => 'REQ-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'user_id'              => $user->id,
                'posko_id'             => $user->posko_id ?? null,
                'bencana_id'           => $pendataan->bencana_id ?? null,

                // Map 12 Kolom Barang
                'beras_kg'             => round((float) $request->input('beras_kg', 0), 2),
                'air_minum_dus'        => round((float) $request->input('air_minum_dus', 0), 2),
                'makanan_kaleng_pack'  => round((float) $request->input('makanan_kaleng_pack', 0), 2),
                'makanan_bayi_pack'    => round((float) $request->input('makanan_bayi_pack', 0), 2),
                'minyak_goreng_liter'  => round((float) $request->input('minyak_goreng_liter', 0), 2),
                'popok_bayi_pcs'       => round((float) $request->input('popok_bayi_pcs', 0), 2),
                'popok_dewasa_pcs'     => round((float) $request->input('popok_dewasa_pcs', 0), 2),
                'pembalut_wanita_pack' => round((float) $request->input('pembalut_wanita_pack', 0), 2),
                'hygiene_kit_paket'    => round((float) $request->input('hygiene_kit_paket', 0), 2),
                'selimut_pcs'          => round((float) $request->input('selimut_pcs', 0), 2),
                'matras_terpal_pcs'    => round((float) $request->input('matras_terpal_pcs', 0), 2),
                'obat_p3k_paket'       => round((float) $request->input('obat_p3k_paket', 0), 2),

                'tanggal_pengajuan'    => now(),
                'status'               => 'pending',
                'catatan_posko'        => $request->catatan_posko,
            ]);

            Log::info('PengajuanController@store - SUCCESS. ID: ' . $pengajuan->id);


            // REDIRECT KE HALAMAN STOK & DISTRIBUSI LAPANGAN (DIPERBAIKI)
            return redirect()->route('lapangan.stok.index')
                ->with('success', 'Pengajuan kebutuhan logistik berhasil dikirimkan ke Posko Komando!');

        } catch (\Exception $e) {
            Log::error('PengajuanController@store - ERROR: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Gagal menyimpan pengajuan: ' . $e->getMessage())
                ->withInput();
        }
    }
}