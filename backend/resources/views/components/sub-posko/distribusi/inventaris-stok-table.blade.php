@props(['stoks' => []])

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        Stok Logistik Tersedia di Pos Lapangan
    </h3>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <th class="py-3 px-4">Nama Barang</th>
                    <th class="py-3 px-4">Kategori</th>
                    <th class="py-3 px-4">Jumlah / Stok</th>
                    <th class="py-3 px-4">Kondisi</th>
                    <th class="py-3 px-4 text-right">Terakhir Diperbarui</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($stoks as $stok)
                    <tr class="hover:bg-gray-50/50 transition">
                        <!-- Nama Barang -->
                        <td class="py-3.5 px-4 font-bold text-gray-900">
                            {{ $stok->nama_barang ?? $stok->nama }}
                        </td>

                        <!-- Kategori -->
                        <td class="py-3.5 px-4 text-gray-600">
                            {{ $stok->kategori ?? 'Logistik Umum' }}
                        </td>

                        <!-- Jumlah / Stok -->
                        <td class="py-3.5 px-4 font-semibold {{ ($stok->jumlah ?? 0) <= 10 ? 'text-amber-600' : 'text-emerald-600' }}">
                            {{ $stok->jumlah ?? 0 }} {{ $stok->satuan ?? 'Unit' }}
                        </td>

                        <!-- Kondisi / Status Stok -->
                        <td class="py-3.5 px-4">
                            @if(($stok->jumlah ?? 0) <= 0)
                                <span class="px-2 py-0.5 text-xs bg-rose-50 text-rose-700 rounded-md font-medium">Habis</span>
                            @elseif(($stok->jumlah ?? 0) <= 10)
                                <span class="px-2 py-0.5 text-xs bg-amber-50 text-amber-700 rounded-md font-medium">Menipis</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-emerald-50 text-emerald-700 rounded-md font-medium">Aman</span>
                            @endif
                        </td>

                        <!-- Terakhir Diperbarui -->
                        <td class="py-3.5 px-4 text-right text-xs text-gray-400">
                            {{ $stok->updated_at ? $stok->updated_at->format('d M Y, H:i') . ' WIB' : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400 text-xs font-medium">
                            Belum ada data stok inventaris yang terdaftar di pos lapangan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>