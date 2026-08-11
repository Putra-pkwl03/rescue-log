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
        'fotos' => 'required',
        'fotos.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi tiap file dalam array
    ]);

    $subPosko = Auth::user()->posko;

    if (!$subPosko) {
        return back()->with('error', 'Akun Anda belum terdaftar dalam posko manapun.');
    }

    if ($request->hasFile('fotos')) {
        foreach ($request->file('fotos') as $file) {
            $path = $file->store('dokumentasi', 'public');
            
            // Simpan sebagai data baru (tidak menimpa foto lama)
            $subPosko->fotos()->create([
                'path_file' => $path
            ]);
        }
    }

    return back()->with('success', 'Dokumentasi foto berhasil ditambahkan!');
}

public function hapusFoto($id)
{
    $foto = \App\Models\PoskoFoto::findOrFail($id);
    
    // Pastikan foto milik posko user yang login
    if ($foto->posko->id === Auth::user()->posko_id) {
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($foto->path_file)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($foto->path_file);
        }
        $foto->delete();
    }

    return back()->with('success', 'Foto berhasil dihapus.');
}
}