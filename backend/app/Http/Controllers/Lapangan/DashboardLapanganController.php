<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posko; // Mengimpor model Posko
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardLapanganController extends Controller
{
    public function index()
{
    // Mengambil posko yang terikat dengan user yang sedang login
    $user = Auth::user();
    $subPosko = $user->posko; // Memanfaatkan relasi posko_id di tabel users

    // Fallback jika user belum memiliki posko atau data tidak ditemukan
    if (!$subPosko) {
        $subPosko = (object) [
            'nama_posko' => 'Posko Lapangan (Belum Terdaftar)',
            'status' => 'Standby',
            'latitude' => -7.7956,
            'longitude' => 110.3695,
            'foto' => null,
        ];
    }

    return view('dashboard.lapangan.index', compact('subPosko'));
}

public function uploadFoto(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Mengambil posko milik user yang login
    $subPosko = Auth::user()->posko;

    if (!$subPosko) {
        return back()->with('error', 'Akun Anda belum terdaftar dalam posko manapun.');
    }

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($subPosko->foto && Storage::disk('public')->exists($subPosko->foto)) {
            Storage::disk('public')->delete($subPosko->foto);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('dokumentasi', 'public');
        
        // Update model Posko
        $subPosko->update(['foto' => $path]);
    }

    return back()->with('success', 'Dokumentasi berhasil diunggah!');
}
}