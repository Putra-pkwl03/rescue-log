<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Posko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubPoskoController extends Controller
{
    public function index(Request $request)
    {
        $komandoPoskoId = Auth::user()->posko_id;

        if (!$komandoPoskoId) {
            return back()->with('error', 'Akun Anda belum terhubung dengan Posko Utama.');
        }

        $baseQuery = Posko::where('parent_id', $komandoPoskoId)
            ->where('tipe_posko', 'lapangan_kecil');

        $query = (clone $baseQuery)->with('bencana');

        if ($request->filled('search')) {
            $query->where('nama_posko', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $subPoskos = $query->latest()->paginate(5)->withQueryString();

        $totalPosko    = (clone $baseQuery)->count();
        $poskoAktif    = (clone $baseQuery)->where('status', 'aktif')->count();
        $poskoSiaga    = (clone $baseQuery)->where('status', 'siaga')->count();
        $poskoNonaktif = (clone $baseQuery)->where('status', 'nonaktif')->count();
        $totalPetugas  = (clone $baseQuery)->sum('jumlah_petugas') ?? 0;

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
        $user = Auth::user();

        if (!$user->posko_id) {
            return back()->with('error', 'Gagal membuat Sub-Posko. Anda tidak memiliki Posko Induk.');
        }

        // Cukup validasi input bawaan form awal (tanpa email & password)
        $validated = $request->validate([
            'nama_posko'       => 'required|string|max:255',
            'bencana_id'       => [
                'required',
                Rule::exists('bencana', 'id')->where(fn ($q) => $q->where('status', 'sedang_berjalan'))
            ],
            'penanggung_jawab' => 'required|string|max:255',
            'kontak_hp'        => 'nullable|string|max:20',
            'jumlah_petugas'   => 'nullable|integer|min:0',
            'lokasi'           => 'nullable|string',
            'latitude'         => 'nullable|numeric|between:-90,90',
            'longitude'        => 'nullable|numeric|between:-180,180',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('posko-images', 'public');
        }

        DB::beginTransaction();
        try {
            // 1. Buat Sub Posko Baru
            $subPosko = Posko::create([
                'nama_posko'       => $validated['nama_posko'],
                'tipe_posko'       => 'lapangan_kecil',
                'parent_id'        => $user->posko_id, 
                'bencana_id'       => $validated['bencana_id'],
                'penanggung_jawab' => $validated['penanggung_jawab'],
                'kontak_hp'        => $validated['kontak_hp'] ?? null,
                'jumlah_petugas'   => $validated['jumlah_petugas'] ?? 0,
                'lokasi'           => $validated['lokasi'] ?? null,
                'latitude'         => $validated['latitude'] ?? null,
                'longitude'        => $validated['longitude'] ?? null,
                'foto'             => $fotoPath,
                'status'           => 'aktif',
            ]);

            // 2. Generate Email Dummy Unik & Password Default
            $slugNamaPosko = Str::slug($validated['nama_posko']);
            $dummyEmail    = $slugNamaPosko . '.' . time() . '@posko.id'; // contoh: posko-mawar.1712345678@posko.id
            $defaultPass   = 'password123';

            // 3. Buat Akun User di Tabel users
            User::create([
                'name'     => $validated['penanggung_jawab'],
                'email'    => $dummyEmail,
                'password' => Hash::make($defaultPass),
                'role'     => 'lapangan',      // Sesuaikan role jika di database Anda beda nama
                'posko_id' => $subPosko->id,   // Hubungkan ke posko yang baru dibuat
            ]);

            DB::commit();

            return redirect()->route('komando.posko-kecil.index')
                ->with('success', "Sub-Posko '{$subPosko->nama_posko}' berhasil dibuat! Credential Login -> Email: {$dummyEmail} | Password: {$defaultPass}");

        } catch (\Exception $e) {
            DB::rollBack();

            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            return back()->with('error', 'Gagal menambahkan Sub-Posko: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $komandoPoskoId = Auth::user()->posko_id;

        $subPosko = Posko::with(['bencana', 'users'])
            ->where('parent_id', $komandoPoskoId)
            ->findOrFail($id);

        return view('dashboard.komando.posko-kecil.show', compact('subPosko'));
    }

    public function edit($id)
    {
        $komandoPoskoId = Auth::user()->posko_id;

        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);
        $bencanaAktif = Bencana::where('status', 'sedang_berjalan')->get();

        return view('dashboard.komando.posko-kecil.edit', compact('subPosko', 'bencanaAktif'));
    }

    public function update(Request $request, $id)
    {
        $komandoPoskoId = Auth::user()->posko_id;
        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);

        $validated = $request->validate([
            'nama_posko'       => 'required|string|max:255',
            'bencana_id'       => [
                'required',
                Rule::exists('bencana', 'id')->where(fn ($q) => $q->where('status', 'sedang_berjalan'))
            ],
            'penanggung_jawab' => 'required|string|max:255',
            'status'           => 'required|in:aktif,siaga,nonaktif',
            'kontak_hp'        => 'nullable|string|max:20',
            'jumlah_petugas'   => 'nullable|integer|min:0',
            'lokasi'           => 'nullable|string',
            'latitude'         => 'nullable|numeric|between:-90,90',
            'longitude'        => 'nullable|numeric|between:-180,180',
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
        $komandoPoskoId = Auth::user()->posko_id;
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
        $komandoPoskoId = Auth::user()->posko_id;
        $subPosko = Posko::where('parent_id', $komandoPoskoId)->findOrFail($id);
        
        $subPosko->update([
            'kode_undangan' => Posko::generateKodeUndangan(),
        ]);

        return back()->with('success', "Kode akses baru berhasil dibuat: {$subPosko->kode_undangan}");
    }
}