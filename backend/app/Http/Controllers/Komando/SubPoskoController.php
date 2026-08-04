<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Posko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubPoskoController extends Controller
{
    public function index(Request $request)
    {
        $komandoPoskoId = auth()->user()->posko_id;

        // Query Data Sub-Posko dengan Filter Search
        $query = Posko::with('bencana')
            ->where('parent_id', $komandoPoskoId)
            ->where('tipe_posko', 'lapangan_kecil');

        if ($request->filled('search')) {
            $query->where('nama_posko', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pagination 5 data per halaman
        $subPoskos = $query->latest()->paginate(5)->withQueryString();

        // Data Statistik untuk Header Cards & Sidebar Widget
        $totalPosko = Posko::where('parent_id', $komandoPoskoId)->where('tipe_posko', 'lapangan_kecil')->count();
        $poskoAktif = Posko::where('parent_id', $komandoPoskoId)->where('tipe_posko', 'lapangan_kecil')->where('status', 'aktif')->count();
        $poskoSiaga = Posko::where('parent_id', $komandoPoskoId)->where('tipe_posko', 'lapangan_kecil')->where('status', 'siaga')->count();
        $poskoNonaktif = Posko::where('parent_id', $komandoPoskoId)->where('tipe_posko', 'lapangan_kecil')->where('status', 'nonaktif')->count();
        $totalPetugas = Posko::where('parent_id', $komandoPoskoId)->where('tipe_posko', 'lapangan_kecil')->sum('jumlah_petugas') ?? 0;

        return view('dashboard.komando.posko-kecil.index', compact(
            'subPoskos', 
            'totalPosko', 
            'poskoAktif', 
            'poskoSiaga', 
            'poskoNonaktif', 
            'totalPetugas'
        ));
    }

    public function create()
    {
        $bencanaAktif = Bencana::where('status', 'sedang_berjalan')->get();
        return view('dashboard.komando.posko-kecil.create', compact('bencanaAktif'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_posko'       => 'required|string|max:255',
            'bencana_id'       => 'required|exists:bencana,id',
            'penanggung_jawab' => 'required|string|max:255',
            'kontak_hp'        => 'nullable|string|max:20',
            'jumlah_petugas'   => 'nullable|integer|min:0',
            'lokasi'           => 'nullable|string',
            'latitude'         => 'nullable|numeric',
            'longitude'        => 'nullable|numeric',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('posko-images', 'public');
        }

        $kodeUndangan = Posko::generateKodeUndangan();

        $subPosko = Posko::create([
            'nama_posko'       => $validated['nama_posko'],
            'tipe_posko'       => 'lapangan_kecil',
            'parent_id'        => $user->posko_id, 
            'bencana_id'       => $validated['bencana_id'],
            'kode_undangan'    => $kodeUndangan,
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'kontak_hp'        => $validated['kontak_hp'] ?? null,
            'jumlah_petugas'   => $validated['jumlah_petugas'] ?? 0,
            'lokasi'           => $validated['lokasi'] ?? null,
            'latitude'         => $validated['latitude'] ?? null,
            'longitude'        => $validated['longitude'] ?? null,
            'foto'             => $fotoPath,
            'status'           => 'aktif',
        ]);

        return redirect()->route('komando.posko-kecil.index')
            ->with('success', "Sub-Posko '{$subPosko->nama_posko}' berhasil didaftarkan. Kode Akses: {$kodeUndangan}");
    }

    public function show($id)
    {
        $komandoPoskoId = auth()->user()->posko_id;

        $subPosko = Posko::with(['bencana', 'users'])
            ->where('parent_id', $komandoPoskoId)
            ->findOrFail($id);

        return view('dashboard.komando.posko-kecil.show', compact('subPosko'));
    }

    public function edit($id)
    {
        $komandoPoskoId = auth()->user()->posko_id;

        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);
        $bencanaAktif = Bencana::where('status', 'sedang_berjalan')->get();

        return view('dashboard.komando.posko-kecil.edit', compact('subPosko', 'bencanaAktif'));
    }

    public function update(Request $request, $id)
    {
        $komandoPoskoId = auth()->user()->posko_id;
        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);

        $validated = $request->validate([
            'nama_posko'       => 'required|string|max:255',
            'bencana_id'       => 'required|exists:bencana,id',
            'penanggung_jawab' => 'required|string|max:255',
            'kontak_hp'        => 'nullable|string|max:20',
            'jumlah_petugas'   => 'nullable|integer|min:0',
            'lokasi'           => 'nullable|string',
            'latitude'         => 'nullable|numeric',
            'longitude'        => 'nullable|numeric',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            if ($subPosko->foto && Storage::disk('public')->exists($subPosko->foto)) {
                Storage::disk('public')->delete($subPosko->foto);
            }
            $validated['foto'] = $request->file('foto')->store('posko-images', 'public');
        }

        $subPosko->update($validated);

        return redirect()->route('komando.posko-kecil.index')
            ->with('success', "Data Sub-Posko '{$subPosko->nama_posko}' berhasil diperbarui.");
    }

    public function destroy($id)
    {
        $komandoPoskoId = auth()->user()->posko_id;
        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);

        if ($subPosko->foto && Storage::disk('public')->exists($subPosko->foto)) {
            Storage::disk('public')->delete($subPosko->foto);
        }

        $subPosko->delete();

        return redirect()->route('komando.posko-kecil.index')
            ->with('success', 'Sub-Posko berhasil dihapus.');
    }

    public function regenerateCode($id)
    {
        $komandoPoskoId = auth()->user()->posko_id;

        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);
        $subPosko->update([
            'kode_undangan' => Posko::generateKodeUndangan(),
        ]);

        return back()->with('success', "Kode akses baru berhasil dibuat: {$subPosko->kode_undangan}");
    }
}