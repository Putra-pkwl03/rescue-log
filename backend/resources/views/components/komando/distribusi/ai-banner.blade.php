@props(['activeKendalaCount' => 0])

<div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-900 rounded-2xl p-6 text-white shadow-xl flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 border border-indigo-800/40">
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="flex items-start gap-4 z-10">
        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shrink-0 text-amber-400 shadow-inner">
            <x-heroicon-o-cpu-chip class="w-6 h-6 animate-pulse" />
        </div>
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-lg font-bold tracking-tight text-white">AI Dynamic Rerouting Engine</h2>
                <span class="text-[10px] bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 px-2 py-0.5 rounded-md uppercase font-black tracking-wider shadow-xs">Active Routing</span>
            </div>
            <p class="text-indigo-200/90 text-sm leading-relaxed max-w-3xl mt-1">
                Sistem mendeteksi <strong class="text-white font-medium">{{ $activeKendalaCount }} hambatan aktif</strong>. Navigasi otomatis mengalihkan rute pengiriman armada untuk menghindari area bahaya longsor, banjir, dan jembatan putus.
            </p>
        </div>
    </div>
</div>