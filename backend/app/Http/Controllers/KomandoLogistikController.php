<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KomandoLogistikController extends Controller
{
    public function index(Request $request)
    {
        $pengajuan = collect();

        return view('dashboard.komando.logistik.index', compact('pengajuan'));
    }

    public function approve(Request $request, $id)
    {
        return redirect()
            ->route('komando.logistik.index')
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function approvePartial(Request $request, $id)
    {
        $request->validate([
            'jumlah_disetujui' => 'required|numeric|min:1',
        ]);

        return redirect()
            ->route('komando.logistik.index')
            ->with('success', 'Pengajuan disetujui sebagian.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_reject' => 'nullable|string|max:255',
        ]);

        return redirect()
            ->route('komando.logistik.index')
            ->with('success', 'Pengajuan ditolak.');
    }
}