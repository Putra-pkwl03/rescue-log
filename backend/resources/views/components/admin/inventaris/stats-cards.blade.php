@props(['stokInventaris'])

@php
    $totalJenisBarang = $stokInventaris->count();
    $totalUnitLogistik = $stokInventaris->sum('jumlah');
    $stokMenipis = $stokInventaris->where('jumlah', '<=', 50)->count();
    $totalKategori = $stokInventaris->pluck('kategori')->unique()->count();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Total Jenis Barang -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-blue-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-blue-700 uppercase tracking-wider">Total Jenis Barang</h3>
            <p class="text-4xl font-extrabold text-blue-600 mt-2">{{ $totalJenisBarang }}</p>
            <p class="text-sm text-gray-600 mt-1">Item logistik terdata</p>
        </div>
        <div class="bg-blue-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
    </div>

    <!-- Card 2: Total Kuantitas Stok -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-green-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-green-700 uppercase tracking-wider">Total Kuantitas Unit</h3>
            <p class="text-4xl font-extrabold text-green-600 mt-2">{{ number_format($totalUnitLogistik) }}</p>
            <p class="text-sm text-gray-600 mt-1">Gabungan seluruh stok gudang</p>
        </div>
        <div class="bg-green-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
    </div>

    <!-- Card 3: Stok Kritis / Menipis -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-red-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-red-700 uppercase tracking-wider">Stok Menipis (<= 50)</h3>
            <p class="text-4xl font-extrabold text-red-600 mt-2">{{ $stokMenipis }}</p>
            <p class="text-sm text-gray-600 mt-1">Perlu pengadaan ulang segera</p>
        </div>
        <div class="bg-red-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
    </div>

    <!-- Card 4: Kategori Terdaftar -->
    <div class="bg-white p-6 rounded-xl shadow-md border-2 border-purple-100 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-bold text-purple-700 uppercase tracking-wider">Kategori Barang</h3>
            <p class="text-4xl font-extrabold text-purple-600 mt-2">{{ $totalKategori }}</p>
            <p class="text-sm text-gray-600 mt-1">Kelompok jenis logistik</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-full">
            <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M19 7h.01M19 11h.01M19 15h.01"></path></svg>
        </div>
    </div>
</div>