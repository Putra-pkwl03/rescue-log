<div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-full">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-bold text-gray-800">Permintaan Logistik Masuk</h2>
        <a href="{{ Route::has('admin.kebutuhan-logistik.index') ? route('admin.kebutuhan-logistik.index') : '#' }}" 
           class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua &rarr;</a>
    </div>

    <div class="space-y-3 flex-1 flex flex-col justify-between">
        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-orange-100 rounded-lg text-orange-600 shrink-0">
                    <x-heroicon-o-home-modern class="w-5 h-5" />
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Posko Komando Merdeka</h4>
                    <p class="text-[10px] text-gray-500">Kab. Sukamaju • Makanan, Air Mineral (200 paket)</p>
                </div>
            </div>
            <span class="px-2 py-1 text-[10px] font-bold text-amber-700 bg-amber-100 rounded-md shrink-0">Menunggu</span>
        </div>

        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 rounded-lg text-blue-600 shrink-0">
                    <x-heroicon-o-home-modern class="w-5 h-5" />
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Posko Komando Tangguh</h4>
                    <p class="text-[10px] text-gray-500">Kec. Cibeber • Selimut, Obat-obatan (150 paket)</p>
                </div>
            </div>
            <span class="px-2 py-1 text-[10px] font-bold text-emerald-700 bg-emerald-100 rounded-md shrink-0">Disetujui</span>
        </div>

        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-orange-100 rounded-lg text-orange-600 shrink-0">
                    <x-heroicon-o-home-modern class="w-5 h-5" />
                </div>
                <div>
                    <h4 class="text-xs font-bold text-gray-800">Posko Komando Harapan</h4>
                    <p class="text-[10px] text-gray-500">Kec. Pangalengan • Makanan Instan (300 paket)</p>
                </div>
            </div>
            <span class="px-2 py-1 text-[10px] font-bold text-amber-700 bg-amber-100 rounded-md shrink-0">Menunggu</span>
        </div>
    </div>
</div>