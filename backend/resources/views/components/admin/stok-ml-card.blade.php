<div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-full">
    <div>
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-sm font-bold text-gray-800">Stok Logistik BPBD</h2>
            <a href="#" class="text-xs font-semibold text-blue-600 hover:underline">Lihat Detail &rarr;</a>
        </div>

        <div class="flex items-center gap-4 my-3">
            <div class="relative w-28 h-28 shrink-0">
                <canvas id="chartStok"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-sm font-extrabold text-gray-900">78%</span>
                    <span class="text-[9px] text-gray-500 font-bold">Tersedia</span>
                </div>
            </div>

            <div class="space-y-1.5 text-xs w-full">
                <div class="text-xs font-bold text-gray-500 mb-1">Total Stok <span class="text-gray-900 font-extrabold text-sm block">12.450 item</span></div>
                <div class="flex justify-between items-center text-[11px]">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Tersedia</span>
                    <span class="font-bold text-gray-800">9.675</span>
                </div>
                <div class="flex justify-between items-center text-[11px]">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Menipis</span>
                    <span class="font-bold text-gray-800">2.320</span>
                </div>
                <div class="flex justify-between items-center text-[11px]">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-500"></span> Habis</span>
                    <span class="font-bold text-gray-800">455</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Box Machine Learning -->
    <div class="mt-3 bg-red-50/80 border border-red-100 rounded-xl p-3 flex gap-2.5 items-start">
        <x-heroicon-o-bell class="w-5 h-5 text-red-500 shrink-0 mt-0.5" />
        <div>
            <span class="text-[11px] font-bold text-red-800 block">Prediksi Kebutuhan (ML)</span>
            <p class="text-[10px] text-red-600 leading-tight mt-0.5">
                Perlu restock dalam 7–10 hari untuk 3 kategori logistik: <strong>Makanan, Selimut, dan Obat-obatan.</strong>
            </p>
        </div>
    </div>
</div>