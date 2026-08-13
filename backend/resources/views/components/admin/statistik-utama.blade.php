<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

    <!-- Card 1: Status Posko Komando -->
    <div class="bg-gradient-to-br from-emerald-50/60 to-white p-4 rounded-2xl border border-emerald-100/80 shadow-sm flex items-start gap-3.5 relative overflow-hidden">
        <div class="p-3 bg-emerald-100/70 rounded-xl text-emerald-700 shrink-0">
            <x-heroicon-o-home-modern class="w-6 h-6" />
        </div>
        <div class="flex-1 min-w-0">
            <span class="text-xs font-semibold text-gray-600 block truncate">Status Posko Komando</span>
            <div class="flex items-center gap-1.5 mt-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-base font-extrabold text-emerald-700">Aktif</span>
            </div>
            <p class="text-[11px] font-medium text-emerald-600 mt-1">
                <span class="font-bold">3</span> Posko Aktif
            </p>
            <a href="{{ Route::has('admin.bencana.index') ? route('admin.bencana.index') : '#' }}" 
               class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 hover:underline mt-2">
                Lihat Posko &rarr;
            </a>
        </div>
    </div>

    <!-- Card 2: Bencana Berjalan -->
    <div class="bg-gradient-to-br from-red-50/60 to-white p-4 rounded-2xl border border-red-100/80 shadow-sm flex items-start gap-3.5 relative overflow-hidden">
        <div class="p-3 bg-red-100/70 rounded-xl text-red-600 shrink-0">
            <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
        </div>
        <div class="flex-1 min-w-0">
            <span class="text-xs font-semibold text-gray-600 block truncate">Bencana Berjalan</span>
            <span class="text-xl font-extrabold text-red-600 block mt-0.5">2</span>
            <p class="text-[11px] font-medium text-gray-500 mt-0.5">Kejadian</p>
            <a href="{{ Route::has('admin.bencana.index') ? route('admin.bencana.index') : '#' }}" 
               class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 hover:underline mt-2">
                Lihat Bencana &rarr;
            </a>
        </div>
    </div>

    <!-- Card 3: Permintaan Masuk -->
    <div class="bg-gradient-to-br from-blue-50/60 to-white p-4 rounded-2xl border border-blue-100/80 shadow-sm flex items-start gap-3.5 relative overflow-hidden">
        <div class="p-3 bg-blue-100/70 rounded-xl text-blue-600 shrink-0">
            <x-heroicon-o-clipboard-document-list class="w-6 h-6" />
        </div>
        <div class="flex-1 min-w-0">
            <span class="text-xs font-semibold text-gray-600 block truncate">Permintaan Masuk</span>
            <span class="text-xl font-extrabold text-blue-600 block mt-0.5">12</span>
            <p class="text-[11px] font-medium text-gray-500 mt-0.5">Pengajuan Logistik</p>
            <a href="{{ Route::has('admin.kebutuhan-logistik.index') ? route('admin.kebutuhan-logistik.index') : '#' }}" 
               class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 hover:underline mt-2">
                Lihat Kebutuhan &rarr;
            </a>
        </div>
    </div>

    <!-- Card 4: Distribusi Berjalan -->
    <div class="bg-gradient-to-br from-emerald-50/60 to-white p-4 rounded-2xl border border-emerald-100/80 shadow-sm flex items-start gap-3.5 relative overflow-hidden">
        <div class="p-3 bg-emerald-100/70 rounded-xl text-emerald-600 shrink-0">
            <x-heroicon-o-truck class="w-6 h-6" />
        </div>
        <div class="flex-1 min-w-0">
            <span class="text-xs font-semibold text-gray-600 block truncate">Distribusi Berjalan</span>
            <span class="text-xl font-extrabold text-emerald-600 block mt-0.5">4</span>
            <p class="text-[11px] font-medium text-gray-500 mt-0.5">Pengiriman Logistik</p>
            <a href="{{ Route::has('admin.distribusi.index') ? route('admin.distribusi.index') : '#' }}" 
               class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 hover:underline mt-2">
                Lihat Distribusi &rarr;
            </a>
        </div>
    </div>

</div>