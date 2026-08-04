<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posko;
use App\Models\Bencana;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data posko dari database untuk dikirim ke view
        $posko = Posko::first(); 
        $bencanaAktif = Bencana::where('status', 'aktif')->first();

        // Kirim variabel $posko dan $bencanaAktif menggunakan compact
        return view('dashboard.admin.index', compact('posko', 'bencanaAktif'));
    }
}