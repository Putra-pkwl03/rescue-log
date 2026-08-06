@props(['subPosko'])

<div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Logistik Tersedia</h3>
            <p class="text-sm text-slate-500">Daftar logistik yang tersedia di posko ini.</p>
        </div>
        <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-xl text-sm font-semibold transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
            </svg>
            Lihat Semua Logistik
        </a>
    </div>

    {{-- Grid Cards Item Logistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        {{-- Item 1: Beras --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-blue-100/80 flex items-center justify-center text-blue-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Beras</p>
                <p class="text-2xl font-bold text-blue-600">50</p>
                <p class="text-xs text-slate-400">Karung</p>
            </div>
        </div>

        {{-- Item 2: Air Mineral --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-cyan-100/80 flex items-center justify-center text-cyan-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L5.6 15.12a2 2 0 00-1.183.184l-.326.163a2 2 0 00-1.022 1.831V20a2 2 0 002 2h14a2 2 0 002-2v-2.716a2 2 0 00-.663-1.488z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Air Mineral</p>
                <p class="text-2xl font-bold text-cyan-600">120</p>
                <p class="text-xs text-slate-400">Dus</p>
            </div>
        </div>

        {{-- Item 3: Mie Instan --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-amber-100/80 flex items-center justify-center text-amber-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Mie Instan</p>
                <p class="text-2xl font-bold text-amber-600">80</p>
                <p class="text-xs text-slate-400">Dus</p>
            </div>
        </div>

        {{-- Item 4: Selimut --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-purple-100/80 flex items-center justify-center text-purple-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Selimut</p>
                <p class="text-2xl font-bold text-purple-600">35</p>
                <p class="text-xs text-slate-400">Lembar</p>
            </div>
        </div>

        {{-- Item 5: Tenda Pengungsi --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-emerald-100/80 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18L12 3 3 21z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Tenda Pengungsi</p>
                <p class="text-2xl font-bold text-emerald-600">8</p>
                <p class="text-xs text-slate-400">Unit</p>
            </div>
        </div>

        {{-- Item 6: Masker --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-teal-100/80 flex items-center justify-center text-teal-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Masker</p>
                <p class="text-2xl font-bold text-teal-600">500</p>
                <p class="text-xs text-slate-400">Box</p>
            </div>
        </div>

        {{-- Item 7: Obat P3K --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-rose-100/80 flex items-center justify-center text-rose-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Obat P3K</p>
                <p class="text-2xl font-bold text-rose-600">25</p>
                <p class="text-xs text-slate-400">Kit</p>
            </div>
        </div>

        {{-- Item 8: Baby Kit --}}
        <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/50 flex items-center space-x-4">
            <div class="w-12 h-12 rounded-full bg-amber-100/80 flex items-center justify-center text-amber-500 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-700">Baby Kit</p>
                <p class="text-2xl font-bold text-amber-500">15</p>
                <p class="text-xs text-slate-400">Paket</p>
            </div>
        </div>

    </div>

    {{-- Footer Info Stok --}}
    <div class="p-4 rounded-xl bg-blue-50/60 border border-blue-100/80 flex items-center space-x-3 text-sm text-blue-700">
        <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Data stok diperbarui terakhir pada {{ now()->translatedFormat('d M Y, H:i') }} WIB</span>
    </div>
</div>