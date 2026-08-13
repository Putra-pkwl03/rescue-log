<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Pendataan;
use App\Models\Posko;
use App\Models\PoskoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardLapanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $subPosko = $user->posko;

        if (!$subPosko) {
            $subPosko = (object) [
                'id' => null,
                'nama_posko' => 'Posko Lapangan (Belum Terdaftar)',
                'status' => 'Standby',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'foto' => null,
            ];
        }

        // 1. Ambil data pendataan pengungsi terbaru dari posko ini
        $pendataanTerakhir = Pendataan::where('posko_id', $user->posko_id)
            ->latest()
            ->first();

        $totalPengungsiReal = $pendataanTerakhir ? $pendataanTerakhir->total_pengungsi : 0;

        // 2. Ambil Bencana yang tersambung dengan Posko ini
        $bencanaAktif = null;
        if ($subPosko && isset($subPosko->bencana_id)) {
            $bencanaAktif = $subPosko->bencana;
        } else {
            // Fallback: Ambil bencana yang statusnya sedang_berjalan paling terbaru
            $bencanaAktif = Bencana::where('status', 'sedang_berjalan')
                ->orderBy('tanggal_aktivasi', 'desc')
                ->first();
        }

        return view('dashboard.lapangan.index', compact(
            'subPosko',
            'totalPengungsiReal',
            'bencanaAktif'
        ));
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
        $foto = PoskoFoto::findOrFail($id);

        // Pastikan foto milik posko user yang login
        if ($foto->posko && $foto->posko->id === Auth::user()->posko_id) {
            if (Storage::disk('public')->exists($foto->path_file)) {
                Storage::disk('public')->delete($foto->path_file);
            }
            $foto->delete();
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}