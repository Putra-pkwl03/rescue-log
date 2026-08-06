<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pusat Komando Insiden</h1>
        <p class="text-sm text-slate-500">Monitoring real-time deteksi bencana BMKG & manajemen operasi tanggap darurat.</p>
    </div>
    <div class="flex items-center gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
            <span class="w-2 h-2 mr-2 bg-emerald-500 rounded-full animate-ping"></span>
            Sistem Live
        </span>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Terdeteksi Hari Ini</p>
            <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['terdeteksi_hari_ini'] ?? 0 }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg">📡</div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Perlu Validasi</p>
            <h3 class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['perlu_validasi'] ?? 0 }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-lg">⚠️</div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Operasi Berjalan</p>
            <h3 class="text-2xl font-bold text-rose-600 mt-1">{{ $stats['sedang_berjalan'] ?? 0 }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg">🚨</div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Operasi Selesai</p>
            <h3 class="text-2xl font-bold text-slate-700 mt-1">{{ $stats['selesai'] ?? count($completedDisasters ?? []) }}</h3>
        </div>
        <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-lg">✅</div>
    </div>
</div>