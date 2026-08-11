<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenyaluranController extends Controller
{
    public function index()
    {
        // Ambil data penyaluran logistik dari database di sini
        return view('dashboard.lapangan.penyaluran.index');
    }

    public function create()
    {
        return view('dashboard.lapangan.penyaluran.create');
    }

    public function store(Request $request)
    {
        // Logika catat penyaluran & kurangi stok
        return redirect()->route('dashboard.lapangan.penyaluran.index')->with('success', 'Penyaluran berhasil dicatat.');
    }
}