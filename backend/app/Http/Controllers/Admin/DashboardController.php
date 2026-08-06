<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Posko;
use App\Models\Bencana;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Ambil data Posko Komando milik BPBD user
        $posko = Posko::where('tipe_posko', 'komando')
            ->where('bpbd_id', $user->bpbd_id)
            ->first();

        // 2. Ambil data bencana aktif (jika ada)
        $bencanaAktif = null;
        if ($posko && $posko->bencana_id) {
            $bencanaAktif = $posko->bencana;
        } else {
            $bencanaAktif = Bencana::where('status', 'aktif')->first();
        }

        $bpbd = $user->bpbd;

        return view('dashboard.admin.index', compact('posko', 'bencanaAktif', 'bpbd'));
    }

    /**
     * Mendaftarkan Posko Komando Utama baru oleh BPBD
     */
    public function storePosko(Request $request)
    {
        $request->validate([
            'nama_posko'       => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'kontak_hp'        => 'required|string|max:20',
        ]);

        $user = auth()->user();
        $bpbd = $user->bpbd;

        $posko = Posko::create([
            'nama_posko'       => $request->nama_posko,
            'penanggung_jawab' => $request->penanggung_jawab,
            'kontak_hp'        => $request->kontak_hp,
            'tipe_posko'       => 'komando',
            'status'           => 'terdaftar_nonaktif',
            'bpbd_id'          => $user->bpbd_id ?? 1,
            'alamat'           => $bpbd->alamat_kantor ?? null,
            'latitude'         => $bpbd->latitude ?? null,
            'longitude'        => $bpbd->longitude ?? null,
        ]);

        // Mengirimkan Session Flash 'success' untuk Toast Kanan Atas
        return redirect()->back()->with('success', 'Posko Komando "' . $posko->nama_posko . '" berhasil didaftarkan!');
    }

    /**
     * Mengaktifkan Posko Komando untuk Tanggap Darurat Bencana
     */
    public function aktifkanPosko(Request $request, $id)
    {
        $posko = Posko::findOrFail($id);

        // Cari bencana yang sedang aktif
        $bencanaAktif = Bencana::where('status', 'aktif')->first();

        // Mengirimkan Session Flash 'error' jika bencana tidak ditemukan
        if (!$bencanaAktif) {
            return redirect()->back()->with('error', 'Gagal mengaktifkan posko: Tidak ada kejadian bencana aktif di sistem!');
        }

        // Update status posko & hubungkan dengan ID Bencana
        $posko->update([
            'status'     => 'aktif',
            'bencana_id' => $bencanaAktif->id,
        ]);

        // Mengirimkan Session Flash 'success' untuk Toast Kanan Atas
        return redirect()->back()->with('success', 'Posko Komando berhasil diaktifkan untuk bencana ' . $bencanaAktif->jenis_bencana . '!');
    }

    /**
     * Menyelesaikan Operasi Tanggap Darurat dan Menutup Posko
     */
    public function selesaikanPosko(Request $request, $id)
    {
        $posko = Posko::findOrFail($id);

        if ($posko->bencana_id) {
            Bencana::where('id', $posko->bencana_id)->update([
                'status' => 'selesai'
            ]);
        }

        $posko->update([
            'status'     => 'nonaktif',
            'bencana_id' => null,
        ]);

        // Mengirimkan Session Flash 'success' untuk Toast Kanan Atas
        return redirect()->back()->with('success', 'Posko Komando telah dinonaktifkan & tanggap darurat dinyatakan selesai.');
    }
}