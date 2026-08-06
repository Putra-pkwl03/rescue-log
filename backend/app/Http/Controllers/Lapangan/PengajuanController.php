<?php

namespace App\Http\Controllers\Lapangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        // Ambil data pengajuan dari database di sini (jika ada)
        return view('dashboard.lapangan.pengajuan.index');
    }

    public function create()
    {
        return view('dashboard.lapangan.pengajuan.create');
    }

    public function store(Request $request)
    {
        // Logika simpan data pengajuan
        return redirect()->route('dashboard.lapangan.pengajuan.index')->with('success', 'Pengajuan berhasil dikirim.');
    }
}