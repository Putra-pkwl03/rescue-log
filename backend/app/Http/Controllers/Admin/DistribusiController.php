<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokInventaris;
use App\Models\PengirimanInventaris;
use App\Models\Posko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DistribusiController extends Controller
{
    /**
     * Menampilkan Halaman Riwayat Distribusi
     */
    public function index()
    {
        $riwayatPengiriman = PengirimanInventaris::with(['stokInventaris', 'posko', 'user'])
            ->latest()
            ->get();

        $stokInventaris = StokInventaris::where('jumlah', '>', 0)->get();
        $poskoKomando = Posko::where('tipe_posko', 'komando')->get();

        return view('dashboard.admin.distribusi.index', compact('riwayatPengiriman', 'stokInventaris', 'poskoKomando'));
    }

    /**
     * Memproses Pengiriman Barang Multi-Item ke Posko Komando
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'posko_id'                     => 'required|exists:poskos,id',
            'keterangan'                   => 'nullable|string',
            'items'                        => 'required|array|min:1',
            'items.*.stok_inventaris_id'   => 'required|exists:stok_inventaris,id',
            'items.*.jumlah_dikirim'       => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($validated) {
            foreach ($validated['items'] as $itemData) {
                $barang = StokInventaris::findOrFail($itemData['stok_inventaris_id']);

                if ($barang->jumlah < $itemData['jumlah_dikirim']) {
                    return back()->with('error', "Stok untuk barang {$barang->nama_barang} tidak mencukupi!");
                }

                // 1. Kurangi stok gudang
                $barang->decrement('jumlah', $itemData['jumlah_dikirim']);

                // 2. Catat transaksi pengiriman
                PengirimanInventaris::create([
                    'stok_inventaris_id' => $itemData['stok_inventaris_id'],
                    'posko_id'           => $validated['posko_id'],
                    'user_id'            => Auth::id(),
                    'jumlah_dikirim'     => $itemData['jumlah_dikirim'],
                    'keterangan'         => $validated['keterangan'] ?? null,
                ]);
            }

            return back()->with('success', 'Pengiriman logistik berhasil diproses.');
        });
    }

    /**
     * Update Pengiriman tunggal (Batas Maksimal 20 Menit)
     */
    public function update(Request $request, $id)
    {
        $pengiriman = PengirimanInventaris::findOrFail($id);

        if (!$pengiriman->canBeEditedOrDeleted()) {
            return back()->with('error', 'Perubahan ditolak! Waktu batas edit (20 menit) telah habis.');
        }

        $validated = $request->validate([
            'posko_id'       => 'required|exists:poskos,id',
            'jumlah_dikirim' => 'required|integer|min:1',
            'keterangan'     => 'nullable|string',
        ]);

        return DB::transaction(function () use ($pengiriman, $validated) {
            $barang = StokInventaris::findOrFail($pengiriman->stok_inventaris_id);
            $selisih = $validated['jumlah_dikirim'] - $pengiriman->jumlah_dikirim;

            if ($selisih > 0 && $barang->jumlah < $selisih) {
                return back()->with('error', 'Stok gudang tidak mencukupi untuk penambahan jumlah pengiriman.');
            }

            $barang->jumlah -= $selisih;
            $barang->save();

            $pengiriman->update([
                'posko_id'       => $validated['posko_id'],
                'jumlah_dikirim' => $validated['jumlah_dikirim'],
                'keterangan'     => $validated['keterangan'] ?? null,
            ]);

            return back()->with('success', 'Data pengiriman berhasil diperbarui.');
        });
    }

    /**
     * Batalkan Pengiriman (Batas Maksimal 20 Menit)
     */
    public function destroy($id)
    {
        $pengiriman = PengirimanInventaris::findOrFail($id);

        if (!$pengiriman->canBeEditedOrDeleted()) {
            return back()->with('error', 'Pembatalan ditolak! Waktu batas pembatalan (20 menit) telah habis.');
        }

        return DB::transaction(function () use ($pengiriman) {
            $barang = StokInventaris::findOrFail($pengiriman->stok_inventaris_id);
            $barang->increment('jumlah', $pengiriman->jumlah_dikirim);
            $pengiriman->delete();

            return back()->with('success', 'Pengiriman berhasil dibatalkan & stok dikembalikan ke gudang.');
        });
    }
}