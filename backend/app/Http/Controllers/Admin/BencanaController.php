<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\BencanaPending;
use App\Models\Bpbd;
use App\Models\Posko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BencanaController extends Controller
{
    /**
     * Halaman Utama Manajemen Bencana / Pusat Komando Insiden
     */
    public function index()
    {
        // 1. Ambil daftar wilayah BPBD
        $regions = Bpbd::pluck('nama_kabupaten_kota')->filter()->toArray();

        // 2. Query Bencana Pending Terfilter Wilayah BPBD
        $pendingQuery = BencanaPending::where('status', 'pending');

        if (!empty($regions)) {
            $pendingQuery->where(function ($query) use ($regions) {
                foreach ($regions as $region) {
                    $query->orWhereRaw('LOWER(wilayah) LIKE ?', ['%' . strtolower(trim($region)) . '%']);
                }
            });
        }

        $pendingDisasters = $pendingQuery->orderBy('waktu_kejadian', 'desc')->get();

        // 3. Query Deteksi Hari Ini Khusus Wilayah BPBD
        $todayQuery = BencanaPending::whereDate('created_at', today());

        if (!empty($regions)) {
            $todayQuery->where(function ($query) use ($regions) {
                foreach ($regions as $region) {
                    $query->orWhereRaw('LOWER(wilayah) LIKE ?', ['%' . strtolower(trim($region)) . '%']);
                }
            });
        }

        // 4. Data Operasi Bencana Resmi yang Sedang Berjalan
        $activeDisasters = Bencana::where('status', 'sedang_berjalan')
            ->orderBy('tanggal_aktivasi', 'desc')
            ->get();

        // 5. Data Operasi Bencana Resmi yang Sudah Selesai (DITAMBAHKAN)
        $completedDisasters = Bencana::where('status', 'selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        // 6. Ringkasan Statistik
        $stats = [
            'terdeteksi_hari_ini' => $todayQuery->count(), 
            'perlu_validasi'      => $pendingDisasters->count(),
            'sedang_berjalan'     => $activeDisasters->count(),
            'selesai'             => $completedDisasters->count(),
        ];

        // Meneruskan $completedDisasters ke Blade view
        return view('dashboard.admin.bencana.index', compact(
            'pendingDisasters', 
            'activeDisasters', 
            'completedDisasters', 
            'stats'
        ));
    }

    /**
     * Validasi API BMKG -> Ubah ke Bencana Resmi (Sedang Berjalan) 
     * dan Otomatis Aktifkan Posko Komando Utama
     */
    public function validateAndActivate(Request $request, $pendingId)
    {
        // 1. Pengecekan Ketersediaan Posko Komando Utama
        $poskoKomando = Posko::komando()
            ->where('status', 'terdaftar_nonaktif')
            ->first();

        if (!$poskoKomando) {
            return redirect()->back()->with('error', 'Gagal mengaktifkan bencana: Belum ada Posko Komando Utama yang terdaftar atau Posko Komando sedang digunakan.');
        }

        $pending = BencanaPending::findOrFail($pendingId);

        DB::beginTransaction();
        try {
            // 2. Simpan ke tabel 'bencana'
            $bencana = Bencana::create([
                'jenis_bencana'             => $pending->jenis_bencana,
                'lokasi_bencana'            => $pending->wilayah,
                'koordinat_operasional_lat' => $pending->latitude,
                'koordinat_operasional_lng' => $pending->longitude,
                'tanggal_aktivasi'          => now(),
                'status'                    => 'sedang_berjalan',
            ]);

            // 3. Update status bencana pending
            $pending->update(['status' => 'validated']);

            // 4. Otomatis Hubungkan & Aktifkan Posko Komando Utama
            $poskoKomando->update([
                'status'     => 'aktif',
                'bencana_id' => $bencana->id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Bencana berhasil divalidasi dan Posko Komando Utama resmi DIAKTIFKAN!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengaktifkan bencana: ' . $e->getMessage());
        }
    }

    /**
     * Abaikan / Reject Bencana dari API BMKG
     */
    public function rejectPending($pendingId)
    {
        $pending = BencanaPending::findOrFail($pendingId);
        $pending->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Deteksi bencana berhasil diabaikan.');
    }

    /**
     * Selesaikan Operasi Bencana dan Nonaktifkan/Tutup Seluruh Posko Terkait
     */
    public function finish($id)
    {
        $bencana = Bencana::findOrFail($id);

        DB::beginTransaction();
        try {
            // 1. Set Status Bencana Selesai
            $bencana->update([
                'status'          => 'selesai',
                'tanggal_selesai' => now(),
            ]);

            // 2. Kembalikan Posko Komando Utama ke Status Standby (Terdaftar Nonaktif)
            Posko::komando()
                ->where('bencana_id', $bencana->id)
                ->update([
                    'status'     => 'terdaftar_nonaktif',
                    'bencana_id' => null,
                ]);

            // 3. Deaktivasi / Tutup Seluruh Sub-Posko (Posko Kecil) Lapangan
            Posko::subPosko()
                ->where('bencana_id', $bencana->id)
                ->update([
                    'status' => 'ditutup',
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Operasi bencana telah diselesaikan. Posko Komando Utama kembali ke status Standby.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyelesaikan bencana: ' . $e->getMessage());
        }
    }
}