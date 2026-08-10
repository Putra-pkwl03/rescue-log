<!-- layouts/sidebar.blade.php -->
@php
    $role = auth()->user()->role ?? '';
@endphp

<aside id="main-sidebar" :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="bg-[#1b2250] text-white flex flex-col min-h-screen shrink-0 shadow-xl transition-all duration-300 z-40 overflow-hidden">

    <!-- Header Logo & Subtitle -->
    <div class="p-5 flex items-center gap-3 border-b border-indigo-900/40">
        <div
            class="bg-indigo-600/30 p-2.5 rounded-xl flex items-center justify-center border border-indigo-400/20 shrink-0">
            <svg class="w-6 h-6 text-indigo-300" style="width: 24px; height: 24px;" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                </path>
            </svg>
        </div>

        <div x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap overflow-hidden">
            <h2 class="font-black text-base tracking-wider leading-tight text-white uppercase">
                @if (in_array($role, ['admin', 'bpbd']))
                    BPBD ADMIN
                @elseif(in_array($role, ['komando', 'koordinator_komando', 'posko_komando']))
                    POSKO KOMANDO
                @else
                    TIM LAPANGAN
                @endif
            </h2>
            <p class="text-[11px] text-indigo-300/60 font-semibold tracking-widest uppercase mt-0.5">SISTEM LOGISTIK</p>
        </div>
    </div>

    <!-- Area Navigasi Utama -->
    <div class="p-4 flex-1 overflow-y-auto">

        <nav class="space-y-1.5">
            {{-- MENU ADMIN --}}
            @if (in_array($role, ['admin', 'bpbd']))
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-heroicon-s-squares-2x2 class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard</span>
                </a>

                <a href="{{ route('admin.bencana') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.bencana*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-fas-house-crack class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Manajemen Bencana</span>
                </a>

                <!-- 1. Permintaan Kebutuhan (Menggunakan ikon Clipboard/Daftar Permintaan) -->
                <a href="{{ route('admin.permintaan') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.permintaan*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-fas-clipboard-list class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Permintaan Kebutuhan</span>
                </a>

                <!-- 2. Inventaris & Prediksi (Menggunakan ikon Tumpukan Kotak/Gudang) -->
                <a href="{{ route('admin.inventaris') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.inventaris*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-fas-boxes-stacked class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Inventaris & Prediksi</span>
                </a>

                <!-- 3. Distribusi (Menggunakan ikon Truk Pengiriman) -->
                <a href="{{ route('admin.distribusi') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.distribusi*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-fas-truck class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Distribusi</span>
                </a>

                <!-- 4. Laporan (Menggunakan ikon Grafik/Statistik) -->
                <a href="{{ route('admin.laporan') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.laporan*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-fas-chart-line class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Laporan</span>
                </a>

                {{-- MENU KOMANDO --}}
            @elseif(in_array($role, ['komando', 'koordinator_komando', 'posko_komando']))
                <a href="{{ route('komando.dashboard') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-heroicon-s-squares-2x2 class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard</span>
                </a>

                <a href="{{ route('komando.logistik.index') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.logistik.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-heroicon-o-document-text class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Data Logistik</span>
                </a>

                <a href="{{ route('komando.distribusi.index') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.distribusi.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-heroicon-s-arrows-right-left class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Distribusi Logistik</span>
                </a>

                <a href="{{ route('komando.pengajuan.index') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.pengajuan.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-heroicon-o-document class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Pengajuan Kebutuhan</span>
                </a>

                <a href="{{ route('komando.posko-kecil.index') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.posko-kecil.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <x-heroicon-o-building-office class="w-5 h-5 shrink-0" />
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Pendataan Pos Kecil</span>
                </a>

                {{-- MENU LAPANGAN --}}
            @else
                <a href="{{ route('lapangan.dashboard') }}"
                    class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('lapangan.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" style="width: 20px; height: 20px;" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard</span>
                </a>
            @endif
        </nav>
    </div>
</aside>
