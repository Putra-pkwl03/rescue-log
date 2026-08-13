<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\PengajuanKebutuhan;
use App\Models\PengirimanInventaris; 
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KomandoLogistikController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanKebutuhan::with(['user', 'posko'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_pengajuan', 'ilike', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'ilike', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->paginate(10)->withQueryString();
        $armadas = Armada::where('status', 'tersedia')->get();

        return view('dashboard.komando.logistik.index', compact('pengajuans', 'armadas'));
    }

    public function storePengiriman(Request $request)
    {
        $request->validate([
            'pengajuan_id'  => 'required|exists:pengajuan_kebutuhan,id',
            'armada_id'     => 'required|exists:armadas,id',
            'tanggal_kirim' => 'required|date',
            'catatan_rute'  => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = PengajuanKebutuhan::with('user.posko')->findOrFail($request->pengajuan_id);

            $latTujuan = $pengajuan->user->posko->latitude ?? '-7.797709';
            $longTujuan = $pengajuan->user->posko->longitude ?? '110.371862';

            // 1. Mencegah DUA kali create di tabel Pengiriman (Pakai updateOrCreate berdasarkan pengajuan_id)
            $pengiriman = Pengiriman::updateOrCreate(
                ['pengajuan_id' => $request->pengajuan_id],
                [
                    'kode_pengiriman'   => 'DIST-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                    'armada_id'         => $request->armada_id,
                    'posko_asal_id'     => 1, // Posko Utama Komando
                    'posko_tujuan_id'   => $pengajuan->posko_id ?? $pengajuan->user->posko_id ?? null,
                    'lat_asal'          => '-7.7956',
                    'long_asal'         => '110.3695',
                    'lat_tujuan'        => $latTujuan,
                    'long_tujuan'       => $longTujuan,
                    'tanggal_kirim'     => $request->tanggal_kirim,
                    'status_pengiriman' => 'dalam_perjalanan',
                    'catatan_rute'      => $request->catatan_rute,
                ]
            );

            // 2. Ubah status armada & pengajuan
            Armada::where('id', $request->armada_id)->update(['status' => 'dalam_tugas']);
            $pengajuan->update(['status' => 'dalam_pengiriman']);

            // 3. Update RECORD YANG SUDAH ADA di PengirimanInventaris (Tidak buat baru)
            PengirimanInventaris::where('pengajuan_id', $pengajuan->id)->update([
                'status_distribusi' => 'Dalam Pengiriman'
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Armada dan jadwal pengiriman berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menjadwalkan armada: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $pengajuan = PengajuanKebutuhan::findOrFail($id);
            
            // 1. Update status pengajuan
            $pengajuan->update([
                'status' => 'disetujui'
            ]);

            // Hitung total jumlah barang dari seluruh field
            $totalJumlah = ($pengajuan->beras_kg ?? 0) +
                           ($pengajuan->air_minum_dus ?? 0) +
                           ($pengajuan->makanan_kaleng_pack ?? 0) +
                           ($pengajuan->makanan_bayi_pack ?? 0) +
                           ($pengajuan->minyak_goreng_liter ?? 0) +
                           ($pengajuan->popok_bayi_pcs ?? 0) +
                           ($pengajuan->popok_dewasa_pcs ?? 0) +
                           ($pengajuan->pembalut_wanita_pack ?? 0) +
                           ($pengajuan->hygiene_kit_paket ?? 0) +
                           ($pengajuan->selimut_pcs ?? 0) +
                           ($pengajuan->matras_terpal_pcs ?? 0) +
                           ($pengajuan->obat_p3k_paket ?? 0);

            // 2. Simpan atau perbarui HANYA 1 rekam di tabel pengiriman_inventaris
            // Status awal di-set 'Menunggu Dijadwalkan' karena armada belum dipilih
            PengirimanInventaris::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id],
                [
                    'posko_id'          => $pengajuan->posko_id ?? $pengajuan->user->posko_id ?? null,
                    'jumlah_dikirim'    => $totalJumlah,
                    'status_distribusi' => 'Menunggu Dijadwalkan',
                    'keterangan'        => 'ACC Full - Pengajuan ' . $pengajuan->kode_pengajuan,
                ]
            );

            DB::commit();
            return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) disetujui penuh & dicatat ke pengiriman!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyetujui pengajuan: ' . $e->getMessage());
        }
    }

    public function approvePartial(Request $request, $id)
    {
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
            'catatan_komando'      => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = PengajuanKebutuhan::findOrFail($id);

            $updateData = [
                'status'          => 'disetujui_sebagian',
                'catatan_komando' => $request->catatan_komando ?? 'Disetujui sebagian.',
            ];

            $columns = [
                'beras_kg', 'air_minum_dus', 'makanan_kaleng_pack', 'makanan_bayi_pack',
                'minyak_goreng_liter', 'popok_bayi_pcs', 'popok_dewasa_pcs', 'pembalut_wanita_pack',
                'hygiene_kit_paket', 'selimut_pcs', 'matras_terpal_pcs', 'obat_p3k_paket'
            ];

            $totalJumlahAcc = 0;
            foreach ($columns as $column) {
                if ($request->has($column)) {
                    $jumlahAcc = round((float) $request->input($column), 2);
                    $updateData[$column] = $jumlahAcc;
                    $totalJumlahAcc += $jumlahAcc;
                }
            }

            $pengajuan->update($updateData);

            // Simpan atau perbarui HANYA 1 rekam di tabel pengiriman_inventaris
            PengirimanInventaris::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id],
                [
                    'posko_id'          => $pengajuan->posko_id ?? $pengajuan->user->posko_id ?? null,
                    'jumlah_dikirim'    => $totalJumlahAcc,
                    'status_distribusi' => 'Menunggu Dijadwalkan',
                    'keterangan'        => 'ACC Partial - Pengajuan ' . $pengajuan->kode_pengajuan,
                ]
            );

            DB::commit();
            return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) disetujui sebagian & dicatat ke pengiriman.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses ACC parsial: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = PengajuanKebutuhan::findOrFail($id);
        $pengajuan->update([
            'status'          => 'ditolak',
            'catatan_komando' => $request->catatan_komando ?? 'Pengajuan ditolak.',
        ]);

        // Hapus/batalkan record pengiriman_inventaris jika ada
        PengirimanInventaris::where('pengajuan_id', $pengajuan->id)->delete();

        return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) ditolak.");
    }
}