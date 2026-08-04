@props(['subPosko'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-slate-900">Lokasi Posko</h3>
        
        @if($subPosko->latitude)
            <a href="https://maps.google.com/?q={{ $subPosko->latitude }},{{ $subPosko->longitude }}" target="_blank" class="text-xs text-indigo-600 font-semibold hover:underline flex items-center gap-1">
                Google Maps
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        @endif
    </div>

    {{-- Container Peta --}}
    <div id="mapWrapper" class="relative rounded-xl overflow-hidden border border-slate-200">
        <div id="miniMap" class="h-52 w-full z-0"></div>

        {{-- Dipindah ke Kanan Bawah (bottom-2.5 right-2.5) --}}
        <button onclick="toggleMapFullscreen()" title="Layar Penuh" class="absolute bottom-2.5 right-2.5 z-[1000] bg-white hover:bg-slate-50 text-slate-700 hover:text-indigo-600 p-2 rounded-lg shadow-md border border-slate-200/80 transition flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
            </svg>
        </button>
    </div>
</div>