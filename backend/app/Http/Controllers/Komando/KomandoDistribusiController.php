<?php

namespace App\Http\Controllers\Komando;

use App\Http\Controllers\Controller;
use App\Models\PengirimanInventaris;
use Illuminate\Http\Request;

class KomandoDistribusiController extends Controller
{
    public function index(Request $request)
    {
        $query = PengirimanInventaris::with(['pengajuan.user', 'user', 'posko']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pengajuan', function ($q) use ($search) {
                $q->where('kode_pengajuan', 'ilike', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'ilike', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            if ($request->status == 'proses') {
                $query->where('status_distribusi', '!=', 'Diterima di Posko');
            } elseif ($request->status == 'selesai') {
                $query->where('status_distribusi', 'Diterima di Posko');
            }
        }

        $pengirimans = $query->latest()->paginate(10)->withQueryString();

        $totalPengiriman = PengirimanInventaris::count();
        $sedangDikirim  = PengirimanInventaris::where('status_distribusi', '!=', 'Diterima di Posko')->count();
        $sampaiTujuan    = PengirimanInventaris::where('status_distribusi', 'Diterima di Posko')->count();

        return view('dashboard.komando.distribusi.index', compact(
            'pengirimans', 
            'totalPengiriman', 
            'sedangDikirim', 
            'sampaiTujuan'
        ));
    }
}