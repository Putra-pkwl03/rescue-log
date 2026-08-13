<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\Pendataan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PengajuanController extends Controller
{
    /**
     * Tampilan Utama Halaman Form Pengajuan Logistik.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil data pendataan pengungsi terbaru khusus posko user login
        $pendataan = Pendataan::where('posko_id', $user->posko_id)
            ->latest()
            ->first();

        // Jika belum ada pendataan di posko ini, alihkan pengguna
        if (!$pendataan) {
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

        // 3. Panggil FastAPI ML Service
        $estimasi = [];
        try {
            $fastApiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8000') . '/predict';
            $response = Http::timeout(10)->post($fastApiUrl, $payloadML);

            if ($response->successful()) {
                $hasil = $response->json();
                $estimasi = $hasil['estimasi_kebutuhan'] ?? [];
            }
        } catch (\Exception $e) {
            session()->flash('warning', 'Gagal menghubungkan ke Service AI ML. Anda dapat mengisi jumlah logistik secara manual.');
        }

        return view('dashboard.lapangan.pengajuan.index', compact('pendataan', 'estimasi'));
    }

    /**
     * Redirect route 'create' ke index.
     */
    public function create()
    {
        return redirect()->route('lapangan.pengajuan.index');
    }

    /**
     * Menyimpan data pengajuan kebutuhan logistik ke database.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi inputan dari form pengajuan
        $validated = $request->validate([
            'beras_kg'              => 'required|numeric|min:0',
            'makanan_kaleng_pack'   => 'required|numeric|min:0',
            'makanan_bayi_pack'     => 'required|numeric|min:0',
            'minyak_goreng_liter'   => 'required|numeric|min:0',
            'air_minum_dus'         => 'required|numeric|min:0',
            'popok_bayi_pcs'        => 'required|numeric|min:0',
            'popok_dewasa_pcs'      => 'required|numeric|min:0',
            'pembalut_wanita_pack'  => 'required|numeric|min:0',
            'hygiene_kit_paket'     => 'required|numeric|min:0',
            'selimut_pcs'           => 'required|numeric|min:0',
            'matras_terpal_pcs'     => 'required|numeric|min:0',
            'obat_p3k_paket'        => 'required|numeric|min:0',
            'catatan_posko'         => 'nullable|string',
        ]);

        // Tambahkan data identitas pengaju dan posko
        $validated['user_id']        = $user->id;
        $validated['posko_id']       = $user->posko_id;
        $validated['kode_pengajuan'] = 'REQ-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $validated['status']         = 'pending';

        // Simpan data pengajuan langsung ke tabel pengajuans
        Pengajuan::create($validated);

        return redirect()->route('lapangan.pengajuan.index')
            ->with('success', 'Pengajuan logistik berhasil dikirimkan ke Posko Komando.');
    }
}