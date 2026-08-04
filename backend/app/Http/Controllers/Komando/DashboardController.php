<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\Posko;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang sedang login
        $user = auth()->user();

        // 2. Cari data posko komando milik user beserta relasi anak (posko kecil) & bencana yang ditangani
        $posko = Posko::with(['children', 'bencana'])->find($user->posko_id);

        // 3. Kirim variabel $posko ke tampilan Blade komando
        return view('dashboard.komando.index', compact('posko'));
    }
}