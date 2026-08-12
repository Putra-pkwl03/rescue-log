<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    
    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200/80 flex items-center gap-4 hover:shadow-md transition-all duration-200">
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center shrink-0 border border-blue-100">
            <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-blue-600 stroke-[2.5]" />
        </div>
        <div class="space-y-0.5 flex-1 min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider truncate">Total Pengajuan</p>
            <h3 class="text-2xl font-extrabold text-slate-800">
                {{ $totalPengajuan ?? 0 }}
            </h3>
            <p class="text-[11px] text-slate-400 truncate">Seluruh data masuk</p>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200/80 flex items-center gap-4 hover:shadow-md transition-all duration-200">
        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center shrink-0 border border-amber-100">
            <x-heroicon-o-clock class="w-6 h-6 text-amber-600 stroke-[2.5]" />
        </div>
        <div class="space-y-0.5 flex-1 min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider truncate">Menunggu BPBD</p>
            <h3 class="text-2xl font-extrabold text-amber-500">
                {{ $pendingCount ?? 0 }}
            </h3>
            <p class="text-[11px] text-slate-400 truncate">Proses verifikasi</p>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200/80 flex items-center gap-4 hover:shadow-md transition-all duration-200">
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0 border border-emerald-100">
            <x-heroicon-o-check-circle class="w-6 h-6 text-emerald-600 stroke-[2.5]" />
        </div>
        <div class="space-y-0.5 flex-1 min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider truncate">Disetujui BPBD</p>
            <h3 class="text-2xl font-extrabold text-emerald-500">
                {{ $approvedCount ?? 0 }}
            </h3>
            <p class="text-[11px] text-slate-400 truncate">Pengajuan diterima</p>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200/80 flex items-center gap-4 hover:shadow-md transition-all duration-200">
        <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center shrink-0 border border-rose-100">
            <x-heroicon-o-x-circle class="w-6 h-6 text-rose-600 stroke-[2.5]" />
        </div>
        <div class="space-y-0.5 flex-1 min-w-0">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider truncate">Ditolak BPBD</p>
            <h3 class="text-2xl font-extrabold text-rose-500">
                {{ $rejectedCount ?? 0 }}
            </h3>
            <p class="text-[11px] text-slate-400 truncate">Perlu perbaikan</p>
        </div>
    </div>

</div>