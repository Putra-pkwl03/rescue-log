@props(['posko'])

<div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row gap-4 items-center">
    <!-- Thumbnail Image -->
    <div class="w-full sm:w-36 h-28 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 relative">
        @if($posko->foto)
            <img src="{{ asset('storage/' . $posko->foto) }}" alt="{{ $posko->nama_posko }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                <svg class="w-8 h-8 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4"/>
                </svg>
                <span class="text-[10px] mt-1 font-medium">No Image</span>
            </div>
        @endif
    </div>

    <!-- Card Body -->
    <div class="flex-1 space-y-2 w-full">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold 
                    {{ $posko->status == 'aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($posko->status == 'siaga' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $posko->status == 'aktif' ? 'bg-emerald-500' : ($posko->status == 'siaga' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                    {{ ucfirst($posko->status ?? 'Aktif') }}
                </span>
                <h3 class="text-sm font-bold text-slate-900 hover:text-indigo-600 transition">
                    {{ $posko->nama_posko }}
                </h3>
            </div>
        </div>

        <p class="text-xs text-slate-500 line-clamp-1">
            {{ $posko->lokasi ?? 'Lokasi belum ditentukan' }}
        </p>

        <!-- Meta Info Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 pt-2 text-[11px] text-slate-600 border-t border-slate-100">
            <div class="flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="truncate font-medium">{{ $posko->bencana->jenis_bencana ?? 'Bencana Umum' }}</span>
            </div>

            <div class="flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="truncate font-medium">{{ $posko->penanggung_jawab }}</span>
            </div>

            <div class="flex items-center gap-1.5 truncate">
                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="font-medium">{{ $posko->jumlah_petugas ?? 0 }} Petugas</span>
            </div>
        </div>
    </div>

    <!-- Action Box -->
    <div class="flex sm:flex-col items-center justify-between sm:justify-center gap-3 w-full sm:w-auto border-t sm:border-t-0 sm:border-l border-slate-100 sm:pl-4 pt-3 sm:pt-0">
        <div class="text-right sm:text-center">
            <span class="inline-block font-mono bg-slate-100 text-slate-800 px-2.5 py-1 rounded-lg border border-slate-200 font-bold text-xs tracking-wider">
                {{ $posko->kode_undangan }}
            </span>
            <span class="block text-[10px] text-slate-400 mt-1">Kode Akses</span>
        </div>

        <a href="{{ route('komando.posko-kecil.show', $posko->id) }}" class="px-3.5 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl text-xs font-semibold transition">
            Detail
        </a>
    </div>
</div>