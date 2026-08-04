@props(['subPosko'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-slate-900">Dokumentasi Posko</h3>
        <span class="text-xs text-slate-400 font-medium">Foto Lapangan</span>
    </div>

    <div class="grid grid-cols-3 gap-2">
        @if($subPosko->foto)
            <div class="h-20 rounded-lg overflow-hidden bg-slate-100 border border-slate-200">
                <img src="{{ asset('storage/' . $subPosko->foto) }}" class="w-full h-full object-cover">
            </div>
        @endif
        <div class="h-20 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
            <svg class="w-6 h-6 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div class="h-20 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs font-semibold">
            +0 Foto
        </div>
    </div>
</div>