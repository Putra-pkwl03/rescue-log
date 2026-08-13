<div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-full">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-bold text-gray-800">Ringkasan Laporan</h2>
        <a href="{{ Route::has('admin.laporan.index') ? route('admin.laporan.index') : '#' }}" 
           class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua &rarr;</a>
    </div>

    <div class="grid grid-cols-3 gap-2 my-auto">
        <div class="bg-blue-50/60 border border-blue-100 p-3 rounded-xl text-center">
            <x-heroicon-o-user-group class="w-5 h-5 text-blue-600 mx-auto mb-1" />
            <span class="text-base font-extrabold text-gray-900 block">8</span>
            <span class="text-[9px] font-semibold text-gray-500 leading-tight block">Bencana Ditangani</span>
        </div>

        <div class="bg-emerald-50/60 border border-emerald-100 p-3 rounded-xl text-center">
            <x-heroicon-o-archive-box class="w-5 h-5 text-emerald-600 mx-auto mb-1" />
            <span class="text-base font-extrabold text-gray-900 block">1.250</span>
            <span class="text-[9px] font-semibold text-gray-500 leading-tight block">Paket Tersalurkan</span>
        </div>

        <div class="bg-purple-50/60 border border-purple-100 p-3 rounded-xl text-center">
            <x-heroicon-o-users class="w-5 h-5 text-purple-600 mx-auto mb-1" />
            <span class="text-base font-extrabold text-gray-900 block">4.320</span>
            <span class="text-[9px] font-semibold text-gray-500 leading-tight block">Pengungsi Terlayani</span>
        </div>
    </div>
</div>