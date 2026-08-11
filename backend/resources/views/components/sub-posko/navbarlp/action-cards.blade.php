<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    
    <!-- Menu 2: Pendataan Pengungsi -->
    <a href="{{ route('lapangan.pengungsi.index') }}" class="bg-purple-50/40 p-5 rounded-2xl border border-purple-100 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-purple-100 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-purple-600 shadow-sm group-hover:bg-purple-600 group-hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </div>
        <div class="mt-6">
            <h4 class="font-bold text-purple-900 text-base">Pendataan Pengungsi</h4>
            <p class="text-xs text-purple-700/70 mt-1">Input & update data KK dan kategori khusus</p>
        </div>
    </a>

    <!-- Menu 3: Pengajuan Logistik -->
    <a href="{{ route('lapangan.pengajuan.index') }}" class="bg-blue-50/40 p-5 rounded-2xl border border-blue-100 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            </div>
            <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </div>
        <div class="mt-6">
            <h4 class="font-bold text-blue-900 text-base">Pengajuan Logistik</h4>
            <p class="text-xs text-blue-700/70 mt-1">Ajukan kebutuhan logistik ke Posko Komando</p>
        </div>
    </a>

    <!-- Menu 4: Status & Stok -->
    <a href="{{ route('lapangan.stok.index') }}" class="bg-emerald-50/40 p-5 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-emerald-100 text-emerald-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
            </div>
            <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-emerald-600 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </div>
        <div class="mt-6">
            <h4 class="font-bold text-emerald-900 text-base">Status Distribusi</h4>
            <p class="text-xs text-emerald-700/70 mt-1">Lihat status pengajuan dan stok logistik</p>
        </div>
    </a>

    <!-- Menu 5: Penyaluran & Stok -->
    <a href="{{ route('lapangan.penyaluran.index') }}" class="bg-amber-50/40 p-5 rounded-2xl border border-amber-100 shadow-sm hover:shadow-md transition flex flex-col justify-between group">
        <div class="flex items-start justify-between">
            <div class="p-3 rounded-xl bg-amber-100 text-amber-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2_2 0 012-2m-6 9l2 2 4-4"></path></svg>
            </div>
            <span class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-amber-600 shadow-sm group-hover:bg-amber-600 group-hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </div>
        <div class="mt-6">
            <h4 class="font-bold text-amber-900 text-base">Penyaluran & Stok</h4>
            <p class="text-xs text-amber-700/70 mt-1">Catat penyaluran dan kelola stok</p>
        </div>
    </a>

</div>