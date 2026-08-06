@extends('layouts.app-lapangan')

@section('content')
<div class="space-y-6">

    <x-sub-posko.page-header 
        title="Status Distribusi & Stok Logistik" 
        description="Pantau status pengiriman dari Posko Komando serta ketersediaan stok barang di pos lapangan">
        
        <!-- Tombol Aksi di sebelah kanan (opsional jika dibutuhkan) -->
        <a href="{{ route('lapangan.pengajuan.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition shadow-sm gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Pengajuan Baru
        </a>
    </x-sub-posko.page-header>


    <!-- Bagian 1: Status Pengiriman/Distribusi dari Komando -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
            Status Pengiriman Logistik dari Posko Komando
        </h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4">ID Pengajuan</th>
                        <th class="py-3 px-4">Item Dikirim</th>
                        <th class="py-3 px-4">Status Distribusi</th>
                        <th class="py-3 px-4">Estimasi / Waktu Sampai</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3.5 px-4 font-bold text-gray-900">#REQ-2026-002</td>
                        <td class="py-3.5 px-4">Selimut (20 pcs), Tenda Darurat (1 unit)</td>
                        <td class="py-3.5 px-4">
                            <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                Dalam Pengiriman (Dikirim Komando)
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-gray-600">Hari ini, ± 14:00 WIB</td>
                        <td class="py-3.5 px-4 text-right">
                            <button class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-medium transition shadow-sm">
                                Konfirmasi Sampai
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bagian 2: Daftar Stok Logistik Tersedia -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            Inventaris & Stok Logistik Tersedia di Pos Lapangan
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Barang</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Jumlah / Stok</th>
                        <th class="py-3 px-4">Kondisi</th>
                        <th class="py-3 px-4 text-right">Terakhir Diperbarui</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3.5 px-4 font-bold text-gray-900">Beras Premium</td>
                        <td class="py-3.5 px-4 text-gray-600">Makanan Pokok</td>
                        <td class="py-3.5 px-4 font-semibold text-emerald-600">250 Kg</td>
                        <td class="py-3.5 px-4"><span class="px-2 py-0.5 text-xs bg-emerald-50 text-emerald-700 rounded-md font-medium">Aman</span></td>
                        <td class="py-3.5 px-4 text-right text-xs text-gray-400">17 Mei 2024, 10:30 WIB</td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3.5 px-4 font-bold text-gray-900">Mie Instan</td>
                        <td class="py-3.5 px-4 text-gray-600">Makanan Cepat Saji</td>
                        <td class="py-3.5 px-4 font-semibold text-emerald-600">45 Dus</td>
                        <td class="py-3.5 px-4"><span class="px-2 py-0.5 text-xs bg-emerald-50 text-emerald-700 rounded-md font-medium">Aman</span></td>
                        <td class="py-3.5 px-4 text-right text-xs text-gray-400">17 Mei 2024, 10:30 WIB</td>
                    </tr>
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3.5 px-4 font-bold text-gray-900">Air Mineral Galon</td>
                        <td class="py-3.5 px-4 text-gray-600">Konsumsi</td>
                        <td class="py-3.5 px-4 font-semibold text-amber-600">12 Galon</td>
                        <td class="py-3.5 px-4"><span class="px-2 py-0.5 text-xs bg-amber-50 text-amber-700 rounded-md font-medium">Menipis</span></td>
                        <td class="py-3.5 px-4 text-right text-xs text-gray-400">17 Mei 2024, 08:00 WIB</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection