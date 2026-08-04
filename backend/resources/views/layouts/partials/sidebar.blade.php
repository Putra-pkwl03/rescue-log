<!-- SIDEBAR CONTAINER -->
<!-- Hapus x-data, tetapkan width awal w-72, tambahkan id="main-sidebar" -->
<aside id="main-sidebar" class="bg-gray-900 text-white flex flex-col shadow-xl border-r-4 border-orange-600 transition-all duration-300 relative w-72 z-50 overflow-hidden">
    
    <!-- Header Sidebar & Tombol Toggle -->
    <div class="h-20 flex items-center justify-between border-b border-gray-800 px-4 bg-gradient-to-r from-gray-900 to-gray-800">
        <!-- Teks Logo (Tambahkan id="logo-text") -->
        <h2 id="logo-text" class="text-xl font-black tracking-wider text-orange-500 transition-opacity duration-300 whitespace-nowrap">SiGap BPBD</h2>
        
        <!-- Tombol Toggle (Hapus @click, tambahkan id="toggle-btn") -->
        <button id="toggle-btn" class="p-2 rounded-lg bg-gray-800 text-orange-400 hover:bg-gray-700 hover:text-white transition focus:outline-none flex-shrink-0 ml-auto">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
    
    <!-- Navigasi Utama -->
    <nav class="flex-1 px-3 py-6 space-y-3 overflow-y-auto overflow-x-hidden">
        {{-- ================= MENU ADMIN ================= --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-base font-bold rounded-xl bg-blue-600 text-white shadow-md hover:bg-blue-700 transition">Dashboard Admin</a>
            <a href="{{ route('admin.bencana') }}" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Manajemen Bencana</a>
            <a href="{{ route('admin.permintaan') }}" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Permintaan Kebutuhan</a>
            <a href="{{ route('admin.inventaris') }}" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Inventaris & Prediksi</a>
            <a href="{{ route('admin.distribusi') }}" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Distribusi</a>
            <a href="{{ route('admin.laporan') }}" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Laporan</a>
        
        {{-- ================= MENU KOMANDO ================= --}}
        @elseif(auth()->user()->role === 'koordinator_komando')
            
            <!-- Menu Item: Dashboard -->
            <a href="{{ route('komando.dashboard') }}"
               title="Dashboard"
               class="group flex items-center px-3.5 py-3.5 text-base font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('komando.dashboard') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/40 border-l-4 border-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
               <svg class="w-6 h-6 flex-shrink-0 {{ request()->routeIs('komando.dashboard') ? 'text-white' : 'text-orange-400 group-hover:text-orange-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
               </svg>
               <!-- Hapus x-show, tambahkan class menu-text -->
               <span class="menu-text ml-3 transition-opacity duration-300 whitespace-nowrap">Dashboard</span>
            </a>
            
            <!-- Menu Item: Data Logistik -->
            <a href="{{ route('komando.logistik.index') }}"
               title="Data Logistik"
               class="group flex items-center px-3.5 py-3.5 mt-2 text-base font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('komando.logistik.*') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/40 border-l-4 border-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
               <svg class="w-6 h-6 flex-shrink-0 {{ request()->routeIs('komando.logistik.*') ? 'text-white' : 'text-orange-400 group-hover:text-orange-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7v10l4 2"></path>
               </svg>
               <span class="menu-text ml-3 transition-opacity duration-300 whitespace-nowrap">Data Logistik</span>
            </a>
            
            <!-- Menu Item: Distribusi Logistik -->
            <a href="{{ route('komando.distribusi.index') }}"
               title="Distribusi Logistik"
               class="group flex items-center px-3.5 py-3.5 mt-2 text-base font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('komando.distribusi.*') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/40 border-l-4 border-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
               <svg class="w-6 h-6 flex-shrink-0 {{ request()->routeIs('komando.distribusi.*') ? 'text-white' : 'text-orange-400 group-hover:text-orange-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>
               <span class="menu-text ml-3 transition-opacity duration-300 whitespace-nowrap">Distribusi Logistik</span>
            </a>
            
            <!-- Menu Item: Pengajuan Kebutuhan -->
            <a href="{{ route('komando.pengajuan.index') }}"
               title="Pengajuan Kebutuhan"
               class="group flex items-center px-3.5 py-3.5 mt-2 text-base font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('komando.pengajuan.*') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/40 border-l-4 border-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
               <svg class="w-6 h-6 flex-shrink-0 {{ request()->routeIs('komando.pengajuan.*') ? 'text-white' : 'text-orange-400 group-hover:text-orange-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>
               <span class="menu-text ml-3 transition-opacity duration-300 whitespace-nowrap">Pengajuan Kebutuhan</span>
            </a>
            
            <!-- Menu Item: Pendataan Pos Kecil -->
            <a href="{{ route('komando.posko-kecil.index') }}"
               title="Pendataan Pos Kecil"
               class="group flex items-center px-3.5 py-3.5 mt-2 text-base font-semibold rounded-xl transition-all duration-200 {{ request()->routeIs('komando.posko-kecil.*') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/40 border-l-4 border-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
               <svg class="w-6 h-6 flex-shrink-0 {{ request()->routeIs('komando.posko-kecil.*') ? 'text-white' : 'text-orange-400 group-hover:text-orange-300' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
               </svg>
               <span class="menu-text ml-3 transition-opacity duration-300 whitespace-nowrap">Pendataan Pos Kecil</span>
            </a>
        
        {{-- ================= MENU LAPANGAN ================= --}}
        @elseif(auth()->user()->role === 'lapangan')
            <a href="{{ route('lapangan.dashboard') }}" class="flex items-center px-4 py-3 text-base font-bold rounded-xl bg-blue-600 text-white shadow-md">Dashboard Lapangan</a>
            <a href="#" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Tugas Distribusi</a>
            <a href="#" class="flex items-center px-4 py-3 mt-2 text-base font-semibold rounded-xl text-gray-300 hover:bg-gray-800 hover:text-white transition">Update Status</a>
        @endif
    </nav>
</aside>