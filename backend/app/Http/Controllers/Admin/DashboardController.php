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

        // 3. Oper data ke Blade view
        return view('dashboard.admin.index', compact('posko', 'bencanaAktif'));
    }
}