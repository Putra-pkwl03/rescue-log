<div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col justify-between">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-bold text-gray-800">Distribusi Terakhir</h2>
        <a href="{{ Route::has('admin.distribusi.index') ? route('admin.distribusi.index') : '#' }}" 
           class="text-xs font-semibold text-blue-600 hover:underline">Lihat Semua &rarr;</a>
    </div>

    <div class="overflow-x-auto flex-1">
        <table class="w-full text-xs text-left">
            <thead class="bg-gray-50 text-gray-500 font-bold uppercase border-b border-gray-100">
                <tr>
                    <th class="py-2.5 px-3">Tanggal</th>
                    <th class="py-2.5 px-3">Posko Komando</th>
                    <th class="py-2.5 px-3">Jenis Logistik</th>
                    <th class="py-2.5 px-3">Jumlah</th>
                    <th class="py-2.5 px-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                <tr>
                    <td class="py-2.5 px-3 whitespace-nowrap">18 Mei 2025</td>
                    <td class="py-2.5 px-3 font-semibold">Posko Merdeka - Kab. Sukamaju</td>
                    <td class="py-2.5 px-3">Makanan, Air Mineral</td>
                    <td class="py-2.5 px-3 whitespace-nowrap">200 paket</td>
                    <td class="py-2.5 px-3"><span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-700 font-bold rounded">Terkirim</span></td>
                </tr>
                <tr>
                    <td class="py-2.5 px-3 whitespace-nowrap">17 Mei 2025</td>
                    <td class="py-2.5 px-3 font-semibold">Posko Tangguh - Kec. Cibeber</td>
                    <td class="py-2.5 px-3">Selimut, Obat-obatan</td>
                    <td class="py-2.5 px-3 whitespace-nowrap">150 paket</td>
                    <td class="py-2.5 px-3"><span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-700 font-bold rounded">Terkirim</span></td>
                </tr>
                <tr>
                    <td class="py-2.5 px-3 whitespace-nowrap">16 Mei 2025</td>
                    <td class="py-2.5 px-3 font-semibold">Posko Harapan - Kec. Pangalengan</td>
                    <td class="py-2.5 px-3">Makanan Instan</td>
                    <td class="py-2.5 px-3 whitespace-nowrap">300 paket</td>
                    <td class="py-2.5 px-3"><span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-700 font-bold rounded">Terkirim</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>