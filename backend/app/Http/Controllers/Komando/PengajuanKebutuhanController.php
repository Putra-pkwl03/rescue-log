<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\PengajuanKebutuhan;
use App\Models\PengajuanKebutuhanDetail;
use App\Models\StokInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanKebutuhanController extends Controller
{
    /**
     * Menampilkan daftar semua pengajuan logistik Posko Komando ke BPBD.
     */
    public function index(Request $request)
    {
        $poskoId = Auth::user()->posko_id;

        $query = PengajuanKebutuhan::with(['bencana', 'details.barang', 'responder'])
            ->where('posko_id', $poskoId);

        // Filter berdasarkan pencarian (kode pengajuan atau bencana)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_pengajuan', 'ILIKE', "%{$search}%")
                  ->orWhereHas('bencana', function ($b) use ($search) {
                      $b->where('jenis_bencana', 'ILIKE', "%{$search}%");
                  });
            });
        }

        // Filter berdasarkan status pengajuan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Data pengajuan dengan pagination
        $pengajuans = $query->latest()->paginate(10)->withQueryString();

        // Statistik Pengajuan Kebutuhan untuk Cards/Widgets Header
        $totalPengajuan = PengajuanKebutuhan::where('posko_id', $poskoId)->count();
        $pendingCount   = PengajuanKebutuhan::where('posko_id', $poskoId)->where('status', 'pending')->count();
        $disetujuiCount = PengajuanKebutuhan::where('posko_id', $poskoId)->whereIn('status', ['disetujui', 'disetujui_sebagian'])->count();
        $ditolakCount   = PengajuanKebutuhan::where('posko_id', $poskoId)->where('status', 'ditolak')->count();

        // Data Pendukung untuk Form Modal / Select Pengajuan Baru
        $bencanaAktif   = Bencana::orderBy('jenis_bencana', 'asc')->get();
        
        // Ambil seluruh daftar stok_inventaris tanpa filter 'jumlah > 0' agar dropdown modal tidak kosong
        $barangs        = StokInventaris::orderBy('nama_barang', 'asc')->get();

        return view('dashboard.komando.pengajuan.index', compact(
            'pengajuans',
            'totalPengajuan',
            'pendingCount',
            'disetujuiCount',
            'ditolakCount',
            'bencanaAktif',
            'barangs'
        ));
    }

    /**
     * Menyimpan data pengajuan kebutuhan logistik ke BPBD.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi Request
        $validated = $request->validate([
            'bencana_id'             => 'required|exists:bencana,id',
            'catatan_komando'        => 'nullable|string|max:1000',
            'items'                  => 'required|array|min:1',
            'items.*.barang_id'      => 'required|exists:stok_inventaris,id',
            'items.*.jumlah_diminta' => 'required|integer|min:1',
            'items.*.satuan'         => 'required|string|max:50',
            'items.*.keterangan'     => 'nullable|string|max:255',
        ], [
            'items.required'             => 'Minimal tambahkan 1 barang logistik yang ingin diajukan.',
            'items.*.jumlah_diminta.min' => 'Jumlah barang yang diminta minimal 1.',
            'items.*.barang_id.exists'   => 'Barang yang dipilih tidak tersedia di stok gudang BPBD.',
        ]);

        $kodePengajuan = PengajuanKebutuhan::generateKode();

        // Transaction DB
        $pengajuan = DB::transaction(function () use ($validated, $user, $kodePengajuan) {
            // 1. Simpan Header Pengajuan
            $header = PengajuanKebutuhan::create([
                'kode_pengajuan'    => $kodePengajuan,
                'posko_id'          => $user->posko_id,
                'bencana_id'        => $validated['bencana_id'],
                'user_id'           => $user->id,
                'tanggal_pengajuan' => now(),
                'status'            => 'pending',
                'catatan_komando'   => $validated['catatan_komando'] ?? null,
            ]);

            // 2. Simpan Detail Barang
            foreach ($validated['items'] as $item) {
                PengajuanKebutuhanDetail::create([
                    'pengajuan_kebutuhan_id' => $header->id,
                    'barang_id'              => $item['barang_id'],
                    'jumlah_diminta'         => $item['jumlah_diminta'],
                    'jumlah_disetujui'       => 0,
                    'satuan'                 => $item['satuan'],
                    'keterangan'             => $item['keterangan'] ?? null,
                ]);
            }

            return $header;
        });

        return redirect()->route('komando.pengajuan.index')
            ->with('success', "Pengajuan kebutuhan (#{$pengajuan->kode_pengajuan}) berhasil dikirim ke BPBD.");
    }

    /**
     * Membatalkan / Menghapus pengajuan (Hanya jika status 'pending').
     */
    public function destroy($id)
    {
        $poskoId = Auth::user()->posko_id;

        $pengajuan = PengajuanKebutuhan::where('posko_id', $poskoId)->findOrFail($id);

        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan ini tidak dapat dibatalkan karena sudah diproses atau disetujui oleh BPBD.');
        }

        DB::transaction(function () use ($pengajuan) {
            $pengajuan->details()->delete();
            $pengajuan->delete();
        });

        return redirect()->route('komando.pengajuan.index')
            ->with('success', 'Pengajuan kebutuhan berhasil dibatalkan.');
    }
}