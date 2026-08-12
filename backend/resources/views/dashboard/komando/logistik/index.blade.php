@extends('layouts.app')

@section('title', 'Manajemen & Verifikasi Logistik')

@section('content')
<div class="space-y-6">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Verifikasi & Stok Logistik</h1>
            <p class="text-xs font-medium text-slate-500 mt-0.5">Kelola pengajuan logistik dari posko lapangan dan pantau ketersediaan barang.</p>
        </div>
    </div>

    {{-- Ringkasan Stok Logistik via Komponen stat-card --}}
    <x-stat-card :subPosko="$subPosko ?? null" />

    {{-- CARD 1: Filter & Header Informasi --}}
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-800">Daftar Pengajuan Logistik</h3>
            <p class="text-xs text-slate-400 mt-0.5">Daftar pengajuan kebutuhan masuk dari Posko Lapangan</p>
        </div>

        {{-- Filter Status Dropdown --}}
        <form action="{{ route('komando.logistik.index') }}" method="GET" class="w-full md:w-auto">
            <div class="relative w-full md:w-56 flex items-center">
                <select name="status" onchange="this.form.submit()" 
                    class="peer w-full text-xs font-medium bg-slate-50 hover:bg-white border border-slate-200 rounded-xl pl-3.5 pr-9 py-2.5 text-slate-700 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none appearance-none cursor-pointer shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="disetujui_sebagian" {{ request('status') == 'disetujui_sebagian' ? 'selected' : '' }}>Disetujui Sebagian</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                
                <!-- Ikon Panah SVG Berputar Saat Focus/Diklik -->
                <div class="absolute right-3.5 pointer-events-none text-slate-400 transition-transform duration-200 origin-center peer-focus:rotate-180">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </form>
    </div>

    {{-- CARD 2: Tabel Pengajuan Logistik --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-300 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3.5 font-medium text-slate-900 uppercase tracking-wider text-[11px]">Kode & Tanggal</th>
                        <th class="px-6 py-3.5 font-medium text-slate-900 uppercase tracking-wider text-[11px]">Posko Lapangan</th>
                        <th class="px-6 py-3.5 font-medium text-slate-900 uppercase tracking-wider text-[11px]">Kejadian Bencana</th>
                        <th class="px-6 py-3.5 font-medium text-slate-900 uppercase tracking-wider text-[11px] text-center">Status</th>
                        <th class="px-6 py-3.5 font-medium text-slate-900 uppercase tracking-wider text-[11px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengajuans as $pengajuan)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-bold text-blue-600 block text-xs">#{{ $pengajuan->kode_pengajuan }}</span>
                            <span class="text-[11px] text-slate-400 font-medium">{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->translatedFormat('d M Y, H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-700">
                            {{ $pengajuan->posko->nama_posko ?? '-' }}
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-600">
                            {{ $pengajuan->bencana->jenis_bencana ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <x-status-badge :status="$pengajuan->status" />
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button type="button" 
                                onclick="openModalVerifikasi({{ $pengajuan->id }})"
                                class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-all active:scale-95">
                                <i class="bi {{ $pengajuan->status === 'pending' ? 'bi-shield-check text-blue-600' : 'bi-eye text-slate-500' }}"></i>
                                <span>{{ $pengajuan->status === 'pending' ? 'Verifikasi' : 'Detail' }}</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="w-12 h-12 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                <i class="bi bi-inbox text-2xl"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-600">Belum Ada Pengajuan</p>
                            <p class="text-[11px] text-slate-400 mt-1">Tidak ada pengajuan logistik yang ditemukan untuk filter saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($pengajuans->hasPages())
        <div class="p-4 border-t border-slate-100 bg-slate-50/20">
            {{ $pengajuans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection