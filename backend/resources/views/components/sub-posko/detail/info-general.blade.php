@props(['subPosko'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
    <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Informasi Umum</h3>
    <dl class="space-y-3 text-xs">
        <div class="flex items-start justify-between">
            <dt class="text-slate-400 font-medium w-1/3">Nama Posko</dt>
            <dd class="text-slate-800 font-semibold w-2/3 text-right">{{ $subPosko->nama_posko }}</dd>
        </div>
        <div class="flex items-start justify-between">
            <dt class="text-slate-400 font-medium w-1/3">Lokasi</dt>
            <dd class="text-slate-800 font-medium w-2/3 text-right leading-relaxed">{{ $subPosko->lokasi ?? '-' }}</dd>
        </div>
        <div class="flex items-center justify-between">
            <dt class="text-slate-400 font-medium">Koordinat</dt>
            <dd class="text-slate-800 font-mono text-[11px] flex items-center gap-1">
                <span>{{ $subPosko->latitude ?? '-' }}, {{ $subPosko->longitude ?? '-' }}</span>
                @if($subPosko->latitude)
                    <button onclick="navigator.clipboard.writeText('{{ $subPosko->latitude }},{{ $subPosko->longitude }}')" class="text-slate-400 hover:text-indigo-600">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                @endif
            </dd>
        </div>
        <div class="flex items-center justify-between">
            <dt class="text-slate-400 font-medium">Kode Akses</dt>
            <dd class="font-mono font-bold text-indigo-600">{{ $subPosko->kode_undangan }}</dd>
        </div>
        <div class="flex items-center justify-between">
            <dt class="text-slate-400 font-medium">Status</dt>
            <dd>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $subPosko->status == 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                    {{ ucfirst($subPosko->status) }}
                </span>
            </dd>
        </div>
        <div class="flex items-center justify-between">
            <dt class="text-slate-400 font-medium">Bencana Terkait</dt>
            <dd class="text-slate-800 font-medium">{{ $subPosko->bencana->jenis_bencana ?? 'Bencana Umum' }}</dd>
        </div>
        <div class="flex items-center justify-between">
            <dt class="text-slate-400 font-medium">Tanggal Dibuat</dt>
            <dd class="text-slate-800">{{ $subPosko->created_at ? $subPosko->created_at->format('d M Y, H:i') . ' WIB' : '-' }}</dd>
        </div>
    </dl>
</div>