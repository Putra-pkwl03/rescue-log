<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKebutuhan;
use Illuminate\Http\Request;

class KomandoLogistikController extends Controller
{
    /**
     * Menampilkan daftar pengajuan kebutuhan logistik
     */
    public function index(Request $request)
    {
        // Eager load relasi 'user', 'posko', 'bencana', dan 'details' untuk optimasi query
        $query = PengajuanKebutuhan::with(['user', 'posko', 'bencana', 'details'])->latest();

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

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data dengan pagination & pertahankan query string saat berpindah halaman
        $pengajuans = $query->paginate(10)->withQueryString();

        // Sesuaikan nama view dengan lokasi folder yang Anda gunakan:
        // Gunakan 'dashboard.admin.permintaan.index' atau 'dashboard.komando.logistik.index'
        return view('dashboard.admin.permintaan.index', compact('pengajuans'));
    }

    /**
     * Menyetujui Pengajuan Kebutuhan Secara Penuh (Approved)
     */
    public function approve($id)
    {
        $pengajuanKebutuhan = PengajuanKebutuhan::findOrFail($id);
        $pengajuanKebutuhan->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', "Pengajuan ({$pengajuanKebutuhan->kode_pengajuan}) berhasil disetujui penuh.");
    }

    /**
     * Menyetujui Pengajuan Kebutuhan Sebagian (Partial)
     */
    public function approvePartial(Request $request, $id)
    {
        $pengajuanKebutuhan = PengajuanKebutuhan::findOrFail($id);

        $pengajuanKebutuhan->update([
            'status' => 'partial',
            'catatan_komando' => $request->catatan_komando ?? 'Disetujui sebagian sesuai ketersediaan stok.',
        ]);

        return redirect()->back()->with('success', "Pengajuan ({$pengajuanKebutuhan->kode_pengajuan}) disetujui sebagian.");
    }

    /**
     * Menolak Pengajuan Kebutuhan (Rejected)
     */
    public function reject(Request $request, $id)
    {
        $pengajuanKebutuhan = PengajuanKebutuhan::findOrFail($id);

        $pengajuanKebutuhan->update([
            'status' => 'rejected',
            'catatan_komando' => $request->catatan_komando ?? 'Pengajuan ditolak oleh BPBD.',
        ]);

        return redirect()->back()->with('success', "Pengajuan ({$pengajuanKebutuhan->kode_pengajuan}) telah ditolak.");
    }
}