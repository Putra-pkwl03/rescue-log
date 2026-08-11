<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        // Ambil data inventaris stok dan pengiriman dari komando
        return view('dashboard.lapangan.stok.index');
    }

    public function konfirmasiSampai($id)
    {
        // Logika ubah status pengiriman & tambah stok otomatis
        return redirect()->back()->with('success', 'Logistik berhasil dikonfirmasi sampai.');
    }
}