<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    // Tampilkan daftar armada
    public function index()
    {
        $armadas = Armada::latest()->get();
        return view('komando.armada.index', compact('armadas'));
    }

    // Simpan armada baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_armada' => 'required|string|max:255',
            'plat_nomor'  => 'required|string|max:50|unique:armadas,plat_nomor',
            'nama_driver' => 'required|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
        ]);

        Armada::create([
            'nama_armada' => $request->nama_armada,
            'plat_nomor'  => strtoupper($request->plat_nomor),
            'nama_driver' => $request->nama_driver,
            'no_hp'       => $request->no_hp,
            'status'      => 'tersedia',
        ]);

        return redirect()->back()->with('success', 'Data armada berhasil ditambahkan.');
    }

    // Update data armada
    public function update(Request $request, $id)
    {
        $armada = Armada::findOrFail($id);

        $request->validate([
            'nama_armada' => 'required|string|max:255',
            'plat_nomor'  => 'required|string|max:50|unique:armadas,plat_nomor,' . $id,
            'nama_driver' => 'required|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'status'      => 'required|in:tersedia,dalam_tugas,rusak',
        ]);

        $armada->update([
            'nama_armada' => $request->nama_armada,
            'plat_nomor'  => strtoupper($request->plat_nomor),
            'nama_driver' => $request->nama_driver,
            'no_hp'       => $request->no_hp,
            'status'      => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data armada berhasil diperbarui.');
    }

    // Hapus armada
    public function destroy($id)
    {
        $armada = Armada::findOrFail($id);

        // Mencegah hapus jika armada sedang dalam tugas
        if ($armada->status === 'dalam_tugas') {
            return redirect()->back()->with('error', 'Armada sedang dalam tugas pengiriman dan tidak dapat dihapus.');
        }

        $armada->delete();
        return redirect()->back()->with('success', 'Data armada berhasil dihapus.');
    }
}