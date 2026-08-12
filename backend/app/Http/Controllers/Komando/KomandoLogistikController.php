<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\PengirimanInventaris;
use Illuminate\Http\Request;

class KomandoLogistikController extends Controller
{
    /**
     * Menampilkan daftar pengajuan kebutuhan logistik dari posko lapangan
     */
    public function index(Request $request)
    {
        // Eager load relasi 'user' dan 'posko' untuk optimasi query
        $query = Pengajuan::with(['user', 'posko'])->latest();

        // Filter berdasarkan pencarian (kode pengajuan atau nama pemohon)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_pengajuan', 'ilike', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'ilike', "%{$search}%");
                  });
            });
        }

        // Filter berdasarkan status pengajuan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data dengan pagination & pertahankan query string saat berpindah halaman
        $pengajuans = $query->paginate(10)->withQueryString();

        return view('dashboard.komando.logistik.index', compact('pengajuans'));
    }

    /**
     * Menyetujui Pengajuan Kebutuhan Secara Penuh (Approved)
     */
    public function approve($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);
        
        $pengajuan->update([
            'status' => 'approved',
        ]);

        // Hitung total akumulasi item barang yang dikirim
        $totalItems = ($pengajuan->beras_kg ?? 0) + 
                      ($pengajuan->makanan_kaleng_pack ?? 0) + 
                      ($pengajuan->makanan_bayi_pack ?? 0) + 
                      ($pengajuan->minyak_goreng_liter ?? 0) + 
                      ($pengajuan->air_minum_dus ?? 0) + 
                      ($pengajuan->popok_bayi_pcs ?? 0) + 
                      ($pengajuan->popok_dewasa_pcs ?? 0) + 
                      ($pengajuan->pembalut_wanita_pack ?? 0) + 
                      ($pengajuan->hygiene_kit_paket ?? 0) + 
                      ($pengajuan->selimut_pcs ?? 0) + 
                      ($pengajuan->matras_terpal_pcs ?? 0) + 
                      ($pengajuan->obat_p3k_paket ?? 0);

        // OTOMATIS BUAT/UPDATE DATA DISTRIBUSI UNTUK POSKO LAPANGAN
        PengirimanInventaris::updateOrCreate(
            ['pengajuan_id' => $pengajuan->id],
            [
                'posko_id'          => $pengajuan->posko_id ?? ($pengajuan->user->posko_id ?? null),
                'user_id'           => $pengajuan->user_id,
                'jumlah_dikirim'    => max(1, (int) round($totalItems)),
                'status_distribusi' => 'Dalam Pengiriman (Dikirim Komando)',
                'estimasi_waktu'    => 'Hari ini, ± ' . now()->addHours(2)->format('H:i') . ' WIB',
            ]
        );

        return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) berhasil disetujui penuh.");
    }

    /**
     * Menyetujui Pengajuan Kebutuhan Sebagian (Partial)
     */
    public function approvePartial(Request $request, $id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        $pengajuan->update(array_merge(
            $request->only([
                'beras_kg', 'makanan_kaleng_pack', 'makanan_bayi_pack', 
                'minyak_goreng_liter', 'air_minum_dus', 'popok_bayi_pcs', 
                'popok_dewasa_pcs', 'pembalut_wanita_pack', 'hygiene_kit_paket', 
                'selimut_pcs', 'matras_terpal_pcs', 'obat_p3k_paket'
            ]),
            [
                'status' => 'partial',
                'catatan_komando' => $request->catatan_komando ?? 'Disetujui sebagian sesuai ketersediaan stok.',
            ]
        ));

        // Hitung ulang total item setelah revisi partial
        $totalItems = ($pengajuan->beras_kg ?? 0) + 
                      ($pengajuan->makanan_kaleng_pack ?? 0) + 
                      ($pengajuan->makanan_bayi_pack ?? 0) + 
                      ($pengajuan->minyak_goreng_liter ?? 0) + 
                      ($pengajuan->air_minum_dus ?? 0) + 
                      ($pengajuan->popok_bayi_pcs ?? 0) + 
                      ($pengajuan->popok_dewasa_pcs ?? 0) + 
                      ($pengajuan->pembalut_wanita_pack ?? 0) + 
                      ($pengajuan->hygiene_kit_paket ?? 0) + 
                      ($pengajuan->selimut_pcs ?? 0) + 
                      ($pengajuan->matras_terpal_pcs ?? 0) + 
                      ($pengajuan->obat_p3k_paket ?? 0);

        // OTOMATIS BUAT/UPDATE DATA DISTRIBUSI UNTUK POSKO LAPANGAN
        PengirimanInventaris::updateOrCreate(
            ['pengajuan_id' => $pengajuan->id],
            [
                'posko_id'          => $pengajuan->posko_id ?? ($pengajuan->user->posko_id ?? null),
                'user_id'           => $pengajuan->user_id,
                'jumlah_dikirim'    => max(1, (int) round($totalItems)),
                'status_distribusi' => 'Dalam Pengiriman (Disetujui Sebagian)',
                'estimasi_waktu'    => 'Hari ini, ± ' . now()->addHours(2)->format('H:i') . ' WIB',
            ]
        );

        return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) disetujui sebagian.");
    }

    /**
     * Menolak Pengajuan Kebutuhan (Rejected)
     */
    public function reject(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->update([
            'status' => 'rejected',
            'catatan_komando' => $request->catatan_komando ?? 'Pengajuan ditolak oleh Posko Komando.',
        ]);

        return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) telah ditolak.");
    }
}