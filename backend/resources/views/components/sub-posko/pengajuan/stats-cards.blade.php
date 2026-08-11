<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Total Pengajuan -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center">
        <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Total Pengajuan</p>
            <h3 class="text-xl font-bold text-gray-800">{{ $totalPengajuan ?? 0 }}</h3>
        </div>
    </div>

    <!-- Pending / Menunggu BPBD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center">
        <div class="p-3 rounded-lg bg-amber-50 text-amber-600 mr-4 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Menunggu BPBD</p>
            <h3 class="text-xl font-bold text-amber-600">{{ $pendingCount ?? 0 }}</h3>
        </div>
    </div>

    <!-- Disetujui BPBD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center">
        <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600 mr-4 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Disetujui BPBD</p>
            <h3 class="text-xl font-bold text-emerald-600">{{ $disetujuiCount ?? 0 }}</h3>
        </div>
    </div>

    <!-- Ditolak -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center">
        <div class="p-3 rounded-lg bg-rose-50 text-rose-600 mr-4 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Ditolak BPBD</p>
            <h3 class="text-xl font-bold text-rose-600">{{ $ditolakCount ?? 0 }}</h3>
        </div>
    </div>
</div>