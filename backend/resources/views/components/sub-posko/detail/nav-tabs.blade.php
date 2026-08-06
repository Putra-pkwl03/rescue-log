<div class="border-b border-slate-200">
    <nav class="-mb-px flex space-x-6 text-xs font-semibold overflow-x-auto">
        {{-- Tab Informasi --}}
        <a href="#informasi" 
           @click="activeTab = 'informasi'"
           :class="activeTab === 'informasi' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
           class="border-b-2 pb-3 px-1 flex items-center gap-2 whitespace-nowrap transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Informasi
        </a>

        {{-- Tab Logistik --}}
        <a href="#logistik" 
           @click="activeTab = 'logistik'"
           :class="activeTab === 'logistik' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
           class="border-b-2 pb-3 px-1 flex items-center gap-2 whitespace-nowrap transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Logistik
        </a>

        {{-- Tab Distribusi --}}
        <a href="#distribusi" 
           @click="activeTab = 'distribusi'"
           :class="activeTab === 'distribusi' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
           class="border-b-2 pb-3 px-1 flex items-center gap-2 whitespace-nowrap transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            Distribusi
        </a>

        {{-- Tab Permintaan --}}
        <a href="#permintaan" 
           @click="activeTab = 'permintaan'"
           :class="activeTab === 'permintaan' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
           class="border-b-2 pb-3 px-1 flex items-center gap-2 whitespace-nowrap transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Permintaan
        </a>

        {{-- Tab Riwayat Aktivitas --}}
        <a href="#riwayat" 
           @click="activeTab = 'riwayat'"
           :class="activeTab === 'riwayat' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
           class="border-b-2 pb-3 px-1 flex items-center gap-2 whitespace-nowrap transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Riwayat Aktivitas
        </a>
    </nav>
</div>