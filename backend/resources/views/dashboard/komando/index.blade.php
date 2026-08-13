@extends('layouts.app')

@section('content')
<div class="space-y-6 pb-10">

    <!-- HERO BANNER POSKO KOMANDO -->
    <div class="relative w-full rounded-2xl overflow-hidden shadow-xl text-white bg-slate-950 border border-slate-800">
        <!-- Background Overlay Image -->
        <div class="absolute inset-0 z-0 opacity-40 mix-blend-luminosity">
            <img src="https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=1200&auto=format&fit=crop" alt="Posko Komando" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-blue-950/70 z-0"></div>

        <div class="relative z-10 p-6 md:p-8 space-y-6">
            <div>
                <span class="text-xs font-bold text-orange-500 uppercase tracking-widest block mb-1">POSKO KOMANDO SIAGA</span>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">Siap, Responsif, Terkoordinasi</h1>
                <p class="text-xs md:text-sm text-slate-300 mt-1 max-w-xl">
                    Pantau situasi, kelola sumber daya, dan pastikan distribusi logistik berjalan tepat sasaran.
                </p>
            </div>

            <!-- Status Indicator & Info Cards -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 pt-2">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        <span class="w-2 h-2 mr-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        Sistem Aktif
                    </span>
                    <span class="text-xs text-slate-400">
                        <svg class="w-3.5 h-3.5 inline mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ now()->translatedFormat('d F Y, H:i') }} WIB
                    </span>
                </div>

                <!-- 4 Stat Badges di Hero -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 w-full lg:w-auto">
                    <div class="bg-slate-900/80 backdrop-blur-md border border-slate-700/60 p-3 rounded-xl flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-blue-600/20 text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold block">Armada Siap</span>
                            <span class="text-lg font-black text-white">12 <span class="text-xs font-normal text-slate-400">Unit</span></span>
                        </div>
                    </div>

                    <div class="bg-slate-900/80 backdrop-blur-md border border-slate-700/60 p-3 rounded-xl flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-emerald-600/20 text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold block">Personel Siaga</span>
                            <span class="text-lg font-black text-white">48 <span class="text-xs font-normal text-slate-400">Orang</span></span>
                        </div>
                    </div>

                    <div class="bg-slate-900/80 backdrop-blur-md border border-slate-700/60 p-3 rounded-xl flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-sky-600/20 text-sky-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold block">Lokasi Terdampak</span>
                            <span class="text-lg font-black text-white">4 <span class="text-xs font-normal text-slate-400">Desa</span></span>
                        </div>
                    </div>

                    <div class="bg-slate-900/80 backdrop-blur-md border border-slate-700/60 p-3 rounded-xl flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-purple-600/20 text-purple-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold block">Logistik Terkirim</span>
                            <span class="text-lg font-black text-white">234 <span class="text-xs font-normal text-slate-400">Paket</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 CARD RINGKASAN UTAMA -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Pengajuan Masuk -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pengajuan Masuk</span>
                <span class="text-2xl font-black text-slate-900">{{ $totalPengajuanMasuk ?? 0 }}</span>
                <span class="text-[11px] text-slate-500 block">Menunggu keputusan komando</span>
            </div>
        </div>

        <!-- Distribusi Berjalan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Distribusi Berjalan</span>
                <span class="text-2xl font-black text-slate-900">{{ $distribusiBerjalan ?? 0 }}</span>
                <span class="text-[11px] text-slate-500 block">Armada di dalam perjalanan</span>
            </div>
        </div>

        <!-- Stok Logistik Kritis -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Stok Logistik Kritis</span>
                <span class="text-2xl font-black text-slate-900">{{ $stokKritis ?? 0 }}</span>
                <span class="text-[11px] text-slate-500 block">Perlu pengajuan ke BPBD</span>
            </div>
        </div>

        <!-- Posko Kecil Terdaftar -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Posko Kecil Terdaftar</span>
                <span class="text-2xl font-black text-slate-900">{{ $totalPoskoKecil ?? 0 }}</span>
                <span class="text-[11px] text-slate-500 block">Titik aktif di bawah komando</span>
            </div>
        </div>
    </div>

    <!-- PINTASAN MENU UTAMA -->
    <div>
        <h3 class="text-sm font-bold text-slate-800 mb-3">Pintasan Menu Utama</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <a href="{{ route('komando.logistik.index') }}" class="p-5 bg-white rounded-2xl border border-slate-200 hover:border-orange-500 shadow-xs hover:shadow-md transition flex items-center justify-between group">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-orange-500 transition">Data Logistik</h4>
                        <p class="text-[11px] text-slate-500">Tinjau & putuskan pengajuan dari Posko Kecil</p>
                    </div>
                </div>
                <div class="p-1.5 rounded-full bg-slate-100 text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>

            <a href="{{ route('komando.distribusi.index') }}" class="p-5 bg-white rounded-2xl border border-slate-200 hover:border-orange-500 shadow-xs hover:shadow-md transition flex items-center justify-between group">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-orange-500 transition">Distribusi Logistik</h4>
                        <p class="text-[11px] text-slate-500">Atur armada & rute pengiriman ke Posko Kecil</p>
                    </div>
                </div>
                <div class="p-1.5 rounded-full bg-slate-100 text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>

            <a href="#" class="p-5 bg-white rounded-2xl border border-slate-200 hover:border-orange-500 shadow-xs hover:shadow-md transition flex items-center justify-between group">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-orange-500 transition">Pengajuan Kebutuhan</h4>
                        <p class="text-[11px] text-slate-500">Ajukan tambahan stok ke BPBD saat kebutuhan belum tercukupi</p>
                    </div>
                </div>
                <div class="p-1.5 rounded-full bg-slate-100 text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>

            <a href="#" class="p-5 bg-white rounded-2xl border border-slate-200 hover:border-orange-500 shadow-xs hover:shadow-md transition flex items-center justify-between group">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 group-hover:text-orange-500 transition">Pendataan Pos Kecil</h4>
                        <p class="text-[11px] text-slate-500">Daftarkan titik Posko Kecil baru & buat kode undangan</p>
                    </div>
                </div>
                <div class="p-1.5 rounded-full bg-slate-100 text-slate-400 group-hover:bg-orange-500 group-hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>

        </div>
    </div>

    <!-- AKTIVITAS & LOG TERBARU -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-bold text-slate-800">Aktivitas & Log Terbaru</h3>
            <a href="#" class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua</a>
        </div>

        <div class="space-y-3">
            <div class="p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></div>
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-slate-800">Distribusi Selesai</h5>
                        <p class="text-[11px] text-slate-500">Armada B 9021 XYZ telah menyelesaikan distribusi ke Posko Kecil Suli.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[11px] text-slate-400">10 menit yang lalu</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">Selesai</span>
                </div>
            </div>

            <div class="p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></div>
                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-slate-800">Pengajuan Baru</h5>
                        <p class="text-[11px] text-slate-500">Posko Kecil Walenrang mengajukan kebutuhan logistik untuk 200 jiwa pengungsi.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[11px] text-slate-400">35 menit yang lalu</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700">Menunggu</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection