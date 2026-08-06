<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoskoController extends Controller
{
    public function create()
    {
        $bpbd = Auth::user()->bpbd;

        if (Posko::where('bpbd_id', $bpbd->id)->exists()) {
            return redirect()->route('admin.dashboard');
        }

        return view('dashboard.admin.posko.create', compact('bpbd'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_posko' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        $bpbd = Auth::user()->bpbd;

        Posko::create([
            'nama_posko' => $validated['nama_posko'],
            'tipe_posko' => 'komando',
            'bpbd_id' => $bpbd->id,
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'lokasi' => $bpbd->alamat_kantor,
            'status' => 'terdaftar_nonaktif',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Posko Komando berhasil didaftarkan.');
    }

    public function aktifkan(Posko $posko)
    {
        $posko->update(['status' => 'aktif']);

        return redirect()->back()->with('success', 'Posko berhasil diaktifkan.');
    }
}