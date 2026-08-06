@extends('layouts.app-lapangan')

@section('content')
<div class="space-y-6">

    <x-sub-posko.page-header 
        title="Pengajuan Logistik" 
        description="Daftar pengajuan kebutuhan logistik dari pos lapangan ke Posko Komando.">
        
        <!-- Tombol Aksi di sebelah kanan (opsional jika dibutuhkan) -->
        <a href="{{ route('lapangan.pengajuan.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition shadow-sm gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Pengajuan Baru
        </a>
    </x-sub-posko.page-header>

    <!-- Tabel Daftar Pengajuan -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="py-3.5 px-6">ID / Tanggal</th>
                        <th class="py-3.5 px-6">Item Logistik Diajukan</th>
                        <th class="py-3.5 px-6">Total Jenis</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    
                    <!-- Contoh Baris Data 1 (Status: Menunggu) -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-6">
                            <span class="font-bold text-gray-900">#REQ-2026-001</span>
                            <p class="text-xs text-gray-400 mt-0.5">17 Mei 2024, 09:15 WIB</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-medium text-gray-800">Beras (50 kg), Mie Instan (2 dus), Air Mineral (10 galon)</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 text-xs font-semibold bg-blue-50 text-blue-700 rounded-full">3 Jenis</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-semibold bg-amber-100 text-amber-700 rounded-full inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Review Komando
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="#" class="inline-flex items-center justify-center px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">
                                Detail
                            </a>
                        </td>
                    </tr>

                    <!-- Contoh Baris Data 2 (Status: Disetujui) -->
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-6">
                            <span class="font-bold text-gray-900">#REQ-2026-002</span>
                            <p class="text-xs text-gray-400 mt-0.5">15 Mei 2024, 14:30 WIB</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-medium text-gray-800">Selimut (20 pcs), Tenda Darurat (1 unit)</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 text-xs font-semibold bg-blue-50 text-blue-700 rounded-full">2 Jenis</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-full inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Disetujui Komando
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="#" class="inline-flex items-center justify-center px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">
                                Detail
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <!-- Footer Tabel / Paginasi -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-2">
            <span>Menampilkan data pengajuan logistik dari pos lapangan</span>
            <div class="flex items-center space-x-1">
                <span class="px-3 py-1 rounded bg-white border border-gray-300 text-gray-400 cursor-not-allowed">Sebelumnya</span>
                <span class="px-3 py-1 rounded bg-blue-600 text-white font-medium">1</span>
                <span class="px-3 py-1 rounded bg-white border border-gray-300 text-gray-400 cursor-not-allowed">Selanjutnya</span>
            </div>
        </div>
    </div>

</div>
@endsection