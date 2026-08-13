@props([
    'bencana' => null,
    'totalPengungsi' => null
])

@php
    $namaBencana = $bencana?->jenis_bencana ?? 'Banjir Bandang';
    $lokasi = $bencana?->lokasi_bencana ?? 'Kab. Luwu, Sulawesi Selatan';
    $deskripsi = $bencana?->deskripsi ?? 'Hujan dengan intensitas tinggi menyebabkan luapan air sungai dan banjir di beberapa kecamatan.';
    
    $waktuKejadian = isset($bencana?->tanggal_aktivasi) 
        ? \Carbon\Carbon::parse($bencana->tanggal_aktivasi)->translatedFormat('d F Y, H:i') . ' WIB' 
        : '17 Mei 2024, 04:30 WIB';

    $cakupan = $bencana?->cakupan_wilayah ?? 'Wilayah Operasional Posko';
    
    $rawStatus = $bencana?->status ?? 'sedang_berjalan';
    $statusText = str_replace('_', ' ', $rawStatus);

    $jumlahPengungsi = $totalPengungsi ?? 0;
    
    $bgImage = !empty($bencana?->foto_banner) 
        ? asset('storage/' . $bencana->foto_banner) 
        : 'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=1200&auto=format&fit=crop';
@endphp

<div class="relative w-full rounded-2xl overflow-hidden shadow-lg border border-blue-900 text-white bg-blue-700 mb-6"
     x-data="{ activeSlide: 1 }">
    
    <!-- Background Image dengan Overlay Soft Blue-600 -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $bgImage }}" alt="Latar Bencana" class="w-full h-full object-cover opacity-20 mix-blend-luminosity">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 via-blue-600/95 to-blue-900"></div>
    </div>

    <!-- Content Container -->
    <div class="relative z-10 p-6 md:p-8 flex flex-col justify-between space-y-6">
        
        <!-- BARIS ATAS -->
        <div class="flex flex-col md:flex-row items-start justify-between gap-6">
            
            <div class="flex-1 space-y-3">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-600 text-white text-xs font-bold tracking-wide uppercase shadow-xs">
                    <svg class="w-3.5 h-3.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>BENCANA AKTIF</span>
                </div>

                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">{{ $namaBencana }}</h2>
                    <p class="text-sm font-semibold text-blue-100 mt-1">{{ $lokasi }}</p>
                    <p class="text-xs text-blue-100/90 mt-2 max-w-xl leading-relaxed line-clamp-2">
                        {{ $deskripsi }}
                    </p>
                </div>
            </div>

            <!-- Floating Card Total Pengungsi Terdata -->
            <div class="bg-blue-700/80 backdrop-blur-md p-4 rounded-xl border border-blue-400/50 min-w-[160px] flex flex-col justify-between self-start shrink-0 shadow-lg">
                <div class="flex items-center gap-1.5 text-[11px] text-blue-100 font-medium">
                    <span class="p-1 rounded bg-white/20 text-white">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </span>
                    Pengungsi
                </div>
                <div class="mt-3">
                    <span class="text-3xl font-black text-white">{{ number_format($jumlahPengungsi) }}</span>
                    <span class="text-[10px] text-blue-100 block font-medium mt-0.5">Jiwa Terdata</span>
                </div>
            </div>

        </div>

        <div class="h-px w-full bg-blue-500/60"></div>

        <!-- BARIS BAWAH -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-1">
            <div class="flex flex-wrap items-center gap-6 w-full md:w-auto">
                <div class="flex items-center gap-2.5">
                    <div class="p-2 rounded-lg bg-blue-700/60 border border-blue-400/50 text-blue-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-semibold text-blue-200 block">Mulai Kejadian</span>
                        <span class="text-xs font-bold text-white">{{ $waktuKejadian }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <div class="p-2 rounded-lg bg-blue-700/60 border border-blue-400/50 text-blue-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-semibold text-blue-200 block">Cakupan Wilayah</span>
                        <span class="text-xs font-bold text-white">{{ $cakupan }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between md:justify-end gap-5 w-full md:w-auto">
                <div class="flex items-center space-x-1.5">
                    <button @click="activeSlide = 1" :class="activeSlide === 1 ? 'w-6 bg-white' : 'w-2 bg-blue-400/60'" class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                    <button @click="activeSlide = 2" :class="activeSlide === 2 ? 'w-6 bg-white' : 'w-2 bg-blue-400/60'" class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                    <button @click="activeSlide = 3" :class="activeSlide === 3 ? 'w-6 bg-white' : 'w-2 bg-blue-400/60'" class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                </div>

                <a href="{{ route('lapangan.pengungsi.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-blue-700 hover:bg-blue-50 font-bold text-xs rounded-xl shadow-md transition transform hover:-translate-y-0.5 shrink-0">
                    <span>Lihat Detail Bencana</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>
</div>