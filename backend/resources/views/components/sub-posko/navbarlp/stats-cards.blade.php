<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    
    <!-- Card 1: Jumlah Pengungsi -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between relative">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-purple-50 text-purple-600">
                <!-- Icon Group -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <!-- Mini Chart Garis Ungu -->
            <svg class="w-20 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 100 30"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 25 Q 25 5, 50 20 T 97 10"></path></svg>
        </div>
        <div class="mt-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Pengungsi</p>
            <div class="flex items-baseline space-x-2 mt-1">
                <h4 class="text-2xl font-bold text-gray-900">186</h4>
                <span class="text-xs text-gray-500">Jiwa</span>
            </div>
            <p class="text-xs text-gray-400 mt-1">52 KK • 4 Desa terdampak</p>
        </div>
    </div>

    <!-- Card 2: Pengajuan Terakhir (Sudah dihubungkan ke route pengajuan.index) -->
    <a href="{{ route('lapangan.pengajuan.index') }}" class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between hover:border-blue-400 transition group">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                <!-- Icon Dokumen -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <span class="px-2.5 py-1 text-xs font-semibold bg-amber-100 text-amber-700 rounded-full">Menunggu</span>
        </div>
        <div class="mt-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengajuan Terakhir</p>
            <p class="text-xs text-gray-500 mt-1">17 Mei 2024, 09:15 WIB</p>
            <div class="flex items-center text-xs font-semibold text-blue-600 mt-3 group-hover:underline">
                <span>Lihat Detail</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>
    </a>

    <!-- Card 3: Stok Tersedia -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between relative">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600">
                <!-- Icon Kotak/Logistik -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <!-- Mini Chart Garis Hijau -->
            <svg class="w-20 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 100 30"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 20 Q 30 25, 60 10 T 97 5"></path></svg>
        </div>
        <div class="mt-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok Tersedia</p>
            <div class="flex items-baseline space-x-2 mt-1">
                <h4 class="text-2xl font-bold text-gray-900">24</h4>
                <span class="text-xs text-gray-500">Jenis Logistik</span>
            </div>
            <div class="flex items-center space-x-1.5 text-xs text-emerald-600 mt-1 font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Stok aman</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Penyaluran Hari Ini -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between relative">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-rose-50 text-rose-600">
                <!-- Icon Donasi/Hati -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </div>
            <!-- Mini Chart Garis Merah -->
            <svg class="w-20 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 100 30"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 15 Q 40 28, 70 12 T 97 22"></path></svg>
        </div>
        <div class="mt-4">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Penyaluran Hari Ini</p>
            <div class="flex items-baseline space-x-2 mt-1">
                <h4 class="text-2xl font-bold text-gray-900">38</h4>
                <span class="text-xs text-gray-500">Paket</span>
            </div>
            <p class="text-xs text-gray-400 mt-1">Untuk 38 KK</p>
        </div>
    </div>

</div>