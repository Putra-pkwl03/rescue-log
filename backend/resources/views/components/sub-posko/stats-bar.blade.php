@props(['totalPosko' => 0, 'poskoAktif' => 0, 'totalPetugas' => 0, 'distribusiBerjalan' => 18])

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- Card 1 -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div class="space-y-1">
            <p class="text-xs font-medium text-slate-500">Total Posko</p>
            <h3 class="text-2xl font-bold text-slate-900">{{ $totalPosko }}</h3>
            <p class="text-[11px] text-slate-400">Semua Posko Terdaftar</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4"/></svg>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div class="space-y-1">
            <p class="text-xs font-medium text-slate-500">Posko Aktif</p>
            <h3 class="text-2xl font-bold text-slate-900">{{ $poskoAktif }}</h3>
            <p class="text-[11px] text-emerald-600 font-medium">
                {{ $totalPosko > 0 ? number_format(($poskoAktif / $totalPosko) * 100, 1) : 0 }}% dari total posko
            </p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div class="space-y-1">
            <p class="text-xs font-medium text-slate-500">Total Petugas</p>
            <h3 class="text-2xl font-bold text-slate-900">{{ $totalPetugas }}</h3>
            <p class="text-[11px] text-slate-400">Petugas di lapangan</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div class="space-y-1">
            <p class="text-xs font-medium text-slate-500">Distribusi Berjalan</p>
            <h3 class="text-2xl font-bold text-slate-900">{{ $distribusiBerjalan }}</h3>
            <p class="text-[11px] text-slate-400">Pengiriman aktif</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1m-6 0a1 1 0 001-1m6 0a1 1 0 001 1"/></svg>
        </div>
    </div>
</div>