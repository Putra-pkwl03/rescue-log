@php
    $role = auth()->user()->role ?? '';
@endphp

<!-- SIDEBAR CONTAINER -->
<aside id="main-sidebar" class="w-64 bg-[#1b2250] text-white flex flex-col min-h-screen shrink-0 shadow-xl transition-all duration-300 z-40">

    <!-- Header Logo & Subtitle -->
    <div class="p-5 flex items-center gap-3 border-b border-indigo-900/40">
        <!-- Logo Perisai -->
        <div class="bg-indigo-600/30 p-2.5 rounded-xl flex items-center justify-center border border-indigo-400/20 shrink-0">
            <svg class="w-6 h-6 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-black text-base tracking-wider leading-tight text-white uppercase">
                @if(in_array($role, ['admin', 'bpbd']))
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
        <p class="text-[11px] font-bold text-indigo-300/40 uppercase tracking-widest px-3 mb-3">MENU UTAMA</p>

        <nav class="space-y-1.5">
            {{-- ================= MENU ADMIN ================= --}}
            @if(in_array($role, ['admin', 'bpbd']))

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.bencana') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.bencana*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                    <span>Manajemen Bencana</span>
                </a>

                <a href="{{ route('admin.permintaan') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.permintaan*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span>Permintaan Kebutuhan</span>
                </a>

                <a href="{{ route('admin.inventaris') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.inventaris*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7v10l4 2"></path></svg>
                    <span>Inventaris & Prediksi</span>
                </a>

                <a href="{{ route('admin.distribusi') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.distribusi*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10h1m5-10h4l3 3v4h-3M5 16h3"></path></svg>
                    <span>Distribusi</span>
                </a>

                <a href="{{ route('admin.laporan') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('admin.laporan*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span>Laporan</span>
                </a>

            {{-- ================= MENU KOMANDO ================= --}}
            @elseif(in_array($role, ['komando', 'koordinator_komando', 'posko_komando']))

                <!-- Dashboard Komando -->
                <a href="{{ route('komando.dashboard') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard</span>
                </a>

                <!-- Data Logistik -->
                <a href="{{ route('komando.logistik.index') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.logistik.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Data Logistik</span>
                </a>

                <!-- Distribusi Logistik -->
                <a href="{{ route('komando.distribusi.index') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.distribusi.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    <span>Distribusi Logistik</span>
                </a>

                <!-- Pengajuan Kebutuhan -->
                <a href="{{ route('komando.pengajuan.index') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.pengajuan.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span>Pengajuan Kebutuhan</span>
                </a>

                <!-- Pendataan Pos Kecil -->
                <a href="{{ route('komando.posko-kecil.index') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('komando.posko-kecil.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6-4a4 4 0 11-4-4"></path></svg>
                    <span>Pendataan Pos Kecil</span>
                </a>

            {{-- ================= MENU LAPANGAN ================= --}}
            @else

                <a href="{{ route('lapangan.dashboard') }}"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('lapangan.dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('lapangan.tugas*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span>Tugas Distribusi</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 {{ request()->routeIs('lapangan.status*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30' : 'text-indigo-200/70 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <span>Update Status</span>
                </a>

            @endif
        </nav>
    </div>
</aside>