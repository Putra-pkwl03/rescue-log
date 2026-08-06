@props(['subPosko' => null])

@if (!$subPosko)
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm text-slate-400 text-xs">
        Data sub posko tidak tersedia.
    </div>
@else
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6">
            <div class="w-full lg:w-48 h-32 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 relative">
                @if ($subPosko->foto)
                    <img src="{{ asset('storage/' . $subPosko->foto) }}" alt="{{ $subPosko->nama_posko }}"
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                        <svg class="w-8 h-8 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4" />
                        </svg>
                        <span class="text-[10px] mt-1 font-medium">Foto Posko</span>
                    </div>
                @endif
            </div>

            <div class="flex-1 space-y-4 w-full">
                <div class="flex flex-wrap items-center gap-2.5">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold 
                        {{ $subPosko->status == 'aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($subPosko->status == 'siaga' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full {{ $subPosko->status == 'aktif' ? 'bg-emerald-500' : ($subPosko->status == 'siaga' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                        {{ ucfirst($subPosko->status ?? 'Aktif') }}
                    </span>
                    <h2 class="text-xl font-bold text-slate-900">{{ $subPosko->nama_posko }}</h2>
                </div>
                <p class="text-xs text-slate-500 -mt-2">{{ $subPosko->lokasi ?? 'Lokasi belum ditentukan' }}</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 pt-3 border-t border-slate-100 text-xs">
                    <div>
                        <span class="text-slate-400 font-medium block mb-1">Kode Akses</span>
                        <div
                            class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg border border-indigo-100 font-mono font-bold">
                            <span>{{ $subPosko->kode_undangan }}</span>
                            <button
                                onclick="navigator.clipboard.writeText('{{ $subPosko->kode_undangan }}'); alert('Kode Akses Berhasil Disalin!');"
                                title="Salin Kode" class="text-indigo-500 hover:text-indigo-800 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium block">Bencana Terkait</span>
                        <strong
                            class="text-slate-800 font-semibold mt-1 block">{{ $subPosko->bencana->jenis_bencana ?? 'Bencana Umum' }}</strong>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium block">Penanggung Jawab</span>
                        <strong
                            class="text-slate-800 font-semibold mt-1 block">{{ $subPosko->penanggung_jawab ?? '-' }}</strong>
                        <span class="text-[11px] text-slate-400">{{ $subPosko->kontak_hp ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium block">Petugas</span>
                        <strong class="text-slate-800 font-semibold mt-1 block">{{ $subPosko->jumlah_petugas ?? 0 }}
                            Orang</strong>
                    </div>

                    <div>
                        <span class="text-slate-400 font-medium block">Dibuat Pada</span>
                        <strong
                            class="text-slate-800 font-semibold mt-1 block">{{ $subPosko->created_at ? $subPosko->created_at->translatedFormat('d M Y') : '-' }}</strong>
                        <span
                            class="text-[11px] text-slate-400">{{ $subPosko->created_at ? $subPosko->created_at->format('H:i') . ' WIB' : '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif