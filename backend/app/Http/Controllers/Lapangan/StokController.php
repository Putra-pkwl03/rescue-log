<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\PengirimanInventaris;
use App\Models\StokInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use DB;

class StokController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil data pengiriman logistik
        $pengirimans = PengirimanInventaris::with('pengajuan')
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);
                if (!empty($user->posko_id)) {
                    $q->orWhere('posko_id', $user->posko_id);
                }
            })
            ->latest()
            ->get();

        // 2. Ambil data stok inventaris secara fleksibel (Cari posko_id user ATAU yang NULL)
        $stoksQuery = StokInventaris::query();

        if (Schema::hasColumn('stok_inventaris', 'posko_id')) {
            $stoksQuery->where(function ($q) use ($user) {
                if (!empty($user->posko_id)) {
                    $q->where('posko_id', $user->posko_id)
                      ->orWhereNull('posko_id'); // Ambil juga stok yang posko_id-nya masih NULL
                } else {
                    // Jika user tidak terikat posko spesifik, tampilkan seluruh stok
                    $q->whereNotNull('id');
                }
            });
        }

        $stoks = $stoksQuery->latest()->get();

        return view('dashboard.lapangan.stok.index', compact('pengirimans', 'stoks'));
    }

    public function konfirmasiSampai($id)
    {
        $pengiriman = PengirimanInventaris::with('pengajuan')->where('id', $id)->firstOrFail();

        if ($pengiriman->status_distribusi == 'Diterima di Posko') {
            return redirect()->back()->with('success', 'Pengiriman ini sudah dikonfirmasi sebelumnya.');
        }

        DB::transaction(function () use ($pengiriman) {
            // Update status pengiriman
            $pengiriman->update([
                'status_distribusi' => 'Diterima di Posko',
                'waktu_diterima'    => now(),
            ]);

            $p = $pengiriman->pengajuan;
            if ($p) {
                // Tentukan posko_id secara pasti (dari pengiriman -> dari pengajuan -> dari user)
                $poskoId = $pengiriman->posko_id ?? ($p->posko_id ?? Auth::user()->posko_id);

                $items = [
                    ['nama' => 'Beras', 'kategori' => 'Makanan Pokok', 'jumlah' => $p->beras_kg, 'satuan' => 'Kg'],
                    ['nama' => 'Air Minum', 'kategori' => 'Konsumsi', 'jumlah' => $p->air_minum_dus, 'satuan' => 'Dus'],
                    ['nama' => 'Makanan Kaleng', 'kategori' => 'Makanan Cepat Saji', 'jumlah' => $p->makanan_kaleng_pack, 'satuan' => 'Pack'],
                    ['nama' => 'Makanan Bayi', 'kategori' => 'Nutrisi Bayi', 'jumlah' => $p->makanan_bayi_pack, 'satuan' => 'Pack'],
                    ['nama' => 'Minyak Goreng', 'kategori' => 'Bahan Pokok', 'jumlah' => $p->minyak_goreng_liter, 'satuan' => 'Liter'],
                    ['nama' => 'Popok Bayi', 'kategori' => 'Kebutuhan Bayi', 'jumlah' => $p->popok_bayi_pcs, 'satuan' => 'Pcs'],
                    ['nama' => 'Popok Dewasa', 'kategori' => 'Sanitasi', 'jumlah' => $p->popok_dewasa_pcs, 'satuan' => 'Pcs'],
                    ['nama' => 'Pembalut Wanita', 'kategori' => 'Sanitasi', 'jumlah' => $p->pembalut_wanita_pack, 'satuan' => 'Pack'],
                    ['nama' => 'Hygiene Kit', 'kategori' => 'Kebersihan', 'jumlah' => $p->hygiene_kit_paket, 'satuan' => 'Paket'],
                    ['nama' => 'Selimut', 'kategori' => 'Perlengkapan', 'jumlah' => $p->selimut_pcs, 'satuan' => 'Pcs'],
                    ['nama' => 'Matras / Terpal', 'kategori' => 'Tenda/Perlengkapan', 'jumlah' => $p->matras_terpal_pcs, 'satuan' => 'Pcs'],
                    ['nama' => 'Obat-obatan / P3K', 'kategori' => 'Kesehatan', 'jumlah' => $p->obat_p3k_paket, 'satuan' => 'Paket'],
                ];

                foreach ($items as $item) {
                    if ($item['jumlah'] > 0) {
                        $jumlahFix = (int) round($item['jumlah']);

                        // Cari record stok yang ada
                        $stokExisting = StokInventaris::where('nama_barang', $item['nama'])
                            ->where(function($q) use ($poskoId) {
                                if (!empty($poskoId)) {
                                    $q->where('posko_id', $poskoId)->orWhereNull('posko_id');
                                }
                            })->first();

                        if ($stokExisting) {
                            $stokExisting->update([
                                'jumlah'   => $stokExisting->jumlah + $jumlahFix,
                                'posko_id' => $stokExisting->posko_id ?? $poskoId // Isi posko_id jika sebelumnya null
                            ]);
                        } else {
                            StokInventaris::create([
                                'posko_id'    => $poskoId,
                                'nama_barang' => $item['nama'],
                                'kategori'    => $item['kategori'],
                                'jumlah'      => $jumlahFix,
                                'satuan'      => $item['satuan'],
                            ]);
                        }
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Logistik berhasil dikonfirmasi sampai dan stok barang di posko telah diperbarui.');
    }
}