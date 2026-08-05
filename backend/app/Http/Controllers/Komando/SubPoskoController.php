<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Posko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        // Jalankan Transaction agar data posko & user dibuat secara bersamaan
        $subPosko = DB::transaction(function () use ($validated, $user, $fotoPath, $kodeUndangan) {
            
            // 1. Simpan ke Tabel Posko
            $posko = Posko::create([
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

            // 2. Simpan ke Tabel Users dengan Role 'lapangan'
            User::create([
                'name'           => $validated['nama_posko'],
                'email'          => strtolower(str_replace([' ', '-'], '', $kodeUndangan)) . '@subposko.local',
                'password'       => Hash::make($kodeUndangan),
                'role'           => 'lapangan', // <-- Disesuaikan ke 'lapangan'
                'posko_id'       => $posko->id,
                'kode_sub_posko' => $kodeUndangan,
            ]);

            return $posko;
        });

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

        DB::transaction(function () use ($subPosko, $validated) {
            $subPosko->update($validated);

            // Update nama user jika nama posko berubah
            User::where('posko_id', $subPosko->id)->update([
                'name' => $validated['nama_posko'],
            ]);
        });

        return redirect()->route('komando.posko-kecil.show', $subPosko->id)
            ->with('success', "Data Sub-Posko '{$subPosko->nama_posko}' berhasil diperbarui.");
    }

    public function destroy($id)
    {
        $komandoPoskoId = auth()->user()->posko_id;
        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);

        DB::transaction(function () use ($subPosko) {
            // Hapus akun user terhubung
            User::where('posko_id', $subPosko->id)->delete();

            if ($subPosko->foto && Storage::disk('public')->exists($subPosko->foto)) {
                Storage::disk('public')->delete($subPosko->foto);
            }

            $subPosko->delete();
        });

        return redirect()->route('komando.posko-kecil.index')
            ->with('success', 'Sub-Posko dan Akun Akses berhasil dihapus.');
    }

    public function regenerateCode($id)
    {
        $komandoPoskoId = auth()->user()->posko_id;
        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);

        $kodeBaru = Posko::generateKodeUndangan();

        DB::transaction(function () use ($subPosko, $kodeBaru) {
            // Update kode di tabel posko
            $subPosko->update([
                'kode_undangan' => $kodeBaru,
            ]);

            // Update kode & password login di tabel users
            User::where('posko_id', $subPosko->id)->update([
                'kode_sub_posko' => $kodeBaru,
                'email'          => strtolower(str_replace([' ', '-'], '', $kodeBaru)) . '@subposko.local',
                'password'       => Hash::make($kodeBaru),
            ]);
        });

        return back()->with('success', "Kode akses baru berhasil dibuat: {$kodeBaru}");
    }
}