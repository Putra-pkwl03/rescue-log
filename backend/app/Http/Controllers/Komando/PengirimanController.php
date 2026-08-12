<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\PengajuanKebutuhan;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengirimanController extends Controller
{
    // Tampilkan halaman Distribusi Logistik & Rute Peta (Menu 3)
    public function index()
    {
        // 1. Pengajuan Kebutuhan yang sudah disetujui & belum punya jadwal pengiriman
        $pengajuanSiapKirim = PengajuanKebutuhan::with(['posko', 'details.barang'])
            ->whereIn('status', ['disetujui', 'disetujui_sebagian'])
            ->doesntHave('pengiriman')
            ->latest()
            ->get();

        // 2. Daftar Pengiriman yang sedang berjalan / terjadwal
        $pengirimans = Pengiriman::with(['pengajuan.posko', 'armada', 'poskoAsal', 'poskoTujuan'])
            ->latest()
            ->get();

        // 3. Armada yang siap/tersedia dipakai
        $armadas = Armada::where('status', 'tersedia')->get();

        return view('dashboard.komando.distribusi.index', compact('pengajuanSiapKirim', 'pengirimans', 'armadas'));
    }

    // Buat Surat Jalan & Penjadwalan Pengiriman Baru
    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_kebutuhan_id' => 'required|exists:pengajuan_kebutuhan,id',
            'armada_id'              => 'required|exists:armadas,id',
            'tanggal_kirim'          => 'required|date',
            'lat_tujuan'             => 'nullable|string',
            'long_tujuan'            => 'nullable|string',
            'catatan_rute'           => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = PengajuanKebutuhan::findOrFail($request->pengajuan_kebutuhan_id);

            // Buat record pengiriman baru
            $pengiriman = Pengiriman::create([
                'kode_pengiriman'        => 'DIST-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'pengajuan_kebutuhan_id' => $request->pengajuan_kebutuhan_id,
                'armada_id'              => $request->armada_id,
                'posko_asal_id'          => 1, // Default ID Posko Komando Utama
                'posko_tujuan_id'        => $pengajuan->posko_id,
                'lat_asal'               => '-7.7956', // Koordinat asal Posko Komando
                'long_asal'              => '110.3695',
                'lat_tujuan'             => $request->lat_tujuan,
                'long_tujuan'            => $request->long_tujuan,
                'tanggal_kirim'          => $request->tanggal_kirim,
                'status_pengiriman'      => 'dijadwalkan',
                'catatan_rute'           => $request->catatan_rute,
            ]);

            // Ubah status armada menjadi 'dalam_tugas'
            Armada::where('id', $request->armada_id)->update(['status' => 'dalam_tugas']);

            DB::commit();
            return redirect()->back()->with('success', 'Jadwal pengiriman berhasil dibuat dengan kode: ' . $pengiriman->kode_pengiriman);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat jadwal pengiriman: ' . $e->getMessage());
        }
    }

    // Update Status Perjalanan Logistik (Dijadwalkan -> Dalam Perjalanan -> Terkirim)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pengiriman' => 'required|in:dijadwalkan,dalam_perjalanan,terkirim,batal',
        ]);

        DB::beginTransaction();
        try {
            $pengiriman = Pengiriman::findOrFail($id);
            $statusLama = $pengiriman->status_pengiriman;
            $statusBaru = $request->status_pengiriman;

            $pengiriman->status_pengiriman = $statusBaru;
            $pengiriman->save();

            // Jika pengiriman selesai (terkirim) atau dibatalkan, kembalikan status armada ke 'tersedia'
            if (in_array($statusBaru, ['terkirim', 'batal']) && !in_array($statusLama, ['terkirim', 'batal'])) {
                Armada::where('id', $pengiriman->armada_id)->update(['status' => 'tersedia']);
            }

            // Jika status berubah dari terkirim kembali ke proses lain
            if ($statusLama === 'terkirim' && $statusBaru !== 'terkirim') {
                Armada::where('id', $pengiriman->armada_id)->update(['status' => 'dalam_tugas']);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui menjadi: ' . ucfirst(str_replace('_', ' ', $statusBaru)));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}