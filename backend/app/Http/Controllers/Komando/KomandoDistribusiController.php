<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\KendalaJalan;
use App\Models\PengajuanKebutuhan;
use App\Models\Pengiriman;
use App\Models\PengirimanInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KomandoDistribusiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil pengajuan yang SIAP KIRIM (disetujui / disetujui_sebagian)
        // Langsung eager load 'user.posko' dan 'posko' tanpa 'details.barang'
        $pengajuanSiapKirim = PengajuanKebutuhan::with(['user.posko', 'posko'])
            ->whereIn('status', ['disetujui', 'disetujui_sebagian'])
            ->where(function ($q) {
                $q->doesntHave('pengiriman')
                  ->orWhereHas('pengiriman', function ($p) {
                      $p->where('status_pengiriman', 'dijadwalkan');
                  });
            })
            ->latest()
            ->get();

        // 2. Daftar Pengiriman
        $query = Pengiriman::with(['pengajuan.user.posko', 'armada', 'poskoAsal', 'poskoTujuan']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_pengiriman', 'ilike', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status_pengiriman', $request->status);
        }

        $pengirimans = $query->latest()->get();
        $armadas = Armada::where('status', 'tersedia')->get();
        $kendalaJalans = KendalaJalan::where('is_active', true)->latest()->get();

        return view('dashboard.komando.distribusi.index', compact(
            'pengajuanSiapKirim', 
            'pengirimans', 
            'armadas',
            'kendalaJalans'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_id'  => 'required|exists:pengajuan_kebutuhan,id', 
            'armada_id'     => 'required|exists:armadas,id',
            'tanggal_kirim' => 'required|date',
            'lat_tujuan'    => 'nullable|string',
            'long_tujuan'   => 'nullable|string',
            'catatan_rute'  => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $pengajuan = PengajuanKebutuhan::with('user.posko')->findOrFail($request->pengajuan_id);

            $latTujuan = $request->lat_tujuan ?? $pengajuan->user->posko->latitude ?? '-7.797709';
            $longTujuan = $request->long_tujuan ?? $pengajuan->user->posko->longitude ?? '110.371862';

            // 1. Buat Record Pengiriman Logistik
            $pengiriman = Pengiriman::create([
                'kode_pengiriman'   => 'DIST-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
                'pengajuan_id'      => $request->pengajuan_id,
                'armada_id'         => $request->armada_id,
                'posko_asal_id'     => 1, // Default: Posko Utama Komando
                'posko_tujuan_id'   => $pengajuan->posko_id ?? $pengajuan->user->posko_id ?? null,
                'lat_asal'          => '-7.7956',
                'long_asal'         => '110.3695',
                'lat_tujuan'        => $latTujuan,
                'long_tujuan'       => $longTujuan,
                'tanggal_kirim'     => $request->tanggal_kirim,
                'status_pengiriman' => 'dalam_perjalanan', 
                'catatan_rute'      => $request->catatan_rute,
            ]);

            // 2. Update Status Armada & Pengajuan
            Armada::where('id', $request->armada_id)->update(['status' => 'dalam_tugas']);
            $pengajuan->update(['status' => 'dalam_pengiriman']);

            // 3. Update Status PengirimanInventaris agar Posko Lapangan melihat statusnya "Dalam Pengiriman"
            PengirimanInventaris::where('pengajuan_id', $pengajuan->id)->update([
                'status_distribusi' => 'Dalam Pengiriman'
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Jadwal pengiriman armada berhasil dibuat dan sedang dalam perjalanan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pengiriman: ' . $e->getMessage());
        }
    }

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

            if (in_array($statusBaru, ['terkirim', 'batal']) && !in_array($statusLama, ['terkirim', 'batal'])) {
                // Bebaskan armada
                Armada::where('id', $pengiriman->armada_id)->update(['status' => 'tersedia']);
                
                if ($statusBaru === 'terkirim') {
                    // Update status Pengajuan & PengirimanInventaris menjadi selesai / diterima
                    PengajuanKebutuhan::where('id', $pengiriman->pengajuan_id)->update(['status' => 'selesai']);
                    PengirimanInventaris::where('pengajuan_id', $pengiriman->pengajuan_id)->update([
                        'status_distribusi' => 'selesai',
                        'waktu_diterima'    => now()
                    ]);
                } elseif ($statusBaru === 'batal') {
                    PengajuanKebutuhan::where('id', $pengiriman->pengajuan_id)->update(['status' => 'disetujui']);
                    PengirimanInventaris::where('pengajuan_id', $pengiriman->pengajuan_id)->update([
                        'status_distribusi' => 'Dibatalkan'
                    ]);
                }
            }

            if ($statusLama === 'terkirim' && $statusBaru !== 'terkirim') {
                Armada::where('id', $pengiriman->armada_id)->update(['status' => 'dalam_tugas']);
                PengajuanKebutuhan::where('id', $pengiriman->pengajuan_id)->update(['status' => 'dalam_pengiriman']);
                PengirimanInventaris::where('pengajuan_id', $pengiriman->pengajuan_id)->update([
                    'status_distribusi' => 'Dalam Pengiriman',
                    'waktu_diterima'    => null
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui menjadi: ' . ucfirst(str_replace('_', ' ', $statusBaru)));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function storeKendala(Request $request)
    {
        $request->validate([
            'nama_lokasi'   => 'required|string|max:255',
            'jenis_kendala' => 'required|in:longsor,jembatan_putus,banjir,pohon_tumbang,jalan_rusak',
            'latitude'      => 'required|numeric',
            'longitude'     => 'required|numeric',
            'deskripsi'     => 'nullable|string',
        ]);

        KendalaJalan::create([
            'nama_lokasi'   => $request->nama_lokasi,
            'jenis_kendala' => $request->jenis_kendala,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'deskripsi'     => $request->deskripsi,
            'is_active'     => true,
            'user_id'       => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Laporan kendala jalan berhasil ditambahkan ke peta.');
    }

    public function toggleKendala($id)
    {
        $kendala = KendalaJalan::findOrFail($id);
        $kendala->is_active = !$kendala->is_active;
        $kendala->save();

        return redirect()->back()->with('success', 'Status kendala jalan berhasil diperbarui.');
    }
}