<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengungsiController extends Controller
{
    public function index()
    {
        // Ambil data pengungsi/KK dari database di sini
        return view('dashboard.lapangan.pengungsi.index');
    }

    public function create()
    {
        return view('dashboard.lapangan.pengungsi.create');
    }

    public function store(Request $request)
    {
        // Logika simpan data KK
        return redirect()->route('dashboard.lapangan.pengungsi.index')->with('success', 'Data KK berhasil disimpan.');
    }
}