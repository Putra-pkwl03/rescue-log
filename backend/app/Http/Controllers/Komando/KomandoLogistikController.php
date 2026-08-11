<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KomandoLogistikController extends Controller
{
    /**
     * Menampilkan daftar pengajuan logistik dari posko lapangan
     */
    public function index(Request $request)
    {
        $query = Pengajuan::with('user')->latest();

        // Filter berdasarkan pencarian nama posko / kode pengajuan
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

        // Kirim data pengajuan ke view
        $pengajuans = $query->paginate(10)->withQueryString();

        return view('dashboard.komando.logistik.index', compact('pengajuans'));
    }

    /**
     * Menyetujui Pengajuan Secara Penuh (Approved)
     */
    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) berhasil disetujui penuh.");
    }

    /**
     * Menyetujui Pengajuan Sebagian (Partial)
     */
    public function approvePartial(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->update([
            'status' => 'partial',
            'catatan_komando' => $request->catatan_komando ?? 'Disetujui sebagian sesuai ketersediaan stok.',
        ]);

        return redirect()->back()->with('success', "Pengajuan ({$pengajuan->kode_pengajuan}) disetujui sebagian.");
    }

    /**
     * Menolak Pengajuan (Rejected)
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