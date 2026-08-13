@props(['kendalaJalans'])

<div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Titik Laporan Kendala Akses Jalan</h3>
            <p class="text-xs text-slate-500">Master data blokade rute yang mempengaruhi jalur distribusi bencana.</p>
        </div>
        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
            Total: {{ $kendalaJalans->count() }} Lokasi
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-200">
                    <th class="py-3.5 px-6">Lokasi & Koordinat</th>
                    <th class="py-3.5 px-6">Jenis Kendala</th>
                    <th class="py-3.5 px-6">Pelapor</th>
                    <th class="py-3.5 px-6">Waktu Laporan</th>
                    <th class="py-3.5 px-6">Status Akses Jalur</th>
                    <th class="py-3.5 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($kendalaJalans as $item)
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-900">{{ $item->nama_lokasi }}</div>
                            <div class="text-xs text-slate-500 font-mono flex items-center gap-1 mt-0.5">
                                <i data-lucide="map-pin" class="w-3 h-3 text-rose-500"></i>
                                {{ $item->latitude }}, {{ $item->longitude }}
                            </div>
                        </td>

                        <td class="py-4 px-6">
                            @switch($item->jenis_kendala)
                                @case('longsor')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200 rounded-lg">
                                        <i data-lucide="mountain" class="w-3.5 h-3.5"></i> Tanah Longsor
                                    </span>
                                    @break
                                @case('jembatan_putus')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 rounded-lg">
                                        <i data-lucide="link-2-off" class="w-3.5 h-3.5"></i> Jembatan Putus
                                    </span>
                                    @break
                                @case('banjir')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-200 rounded-lg">
                                        <i data-lucide="waves" class="w-3.5 h-3.5"></i> Banjir / Genangan
                                    </span>
                                    @break
                                @case('pohon_tumbang')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-lg">
                                        <i data-lucide="trees" class="w-3.5 h-3.5"></i> Pohon Tumbang
                                    </span>
                                    @break
                                @default
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-200 rounded-lg">
                                        <i data-lucide="alert-octagon" class="w-3.5 h-3.5"></i> Jalan Rusak
                                    </span>
                            @endswitch
                        </td>

                        <td class="py-4 px-6">
                            <div class="font-semibold text-slate-900">{{ $item->user->name ?? 'Petugas Posko' }}</div>
                            <div class="text-xs text-slate-400">{{ $item->user->email ?? '-' }}</div>
                        </td>

                        <td class="py-4 px-6">
                            <div class="font-medium text-slate-800">{{ $item->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $item->created_at->format('H:i') }} WIB</div>
                        </td>

                        <td class="py-4 px-6">
                            @if($item->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span> Jalur Terhambat
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">
                                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Sudah Aman
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-right">
                            <form method="POST" action="{{ route('komando.distribusi.kendala.toggle', $item->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-lg text-xs font-semibold inline-flex items-center gap-1 transition shadow-2xs cursor-pointer">
                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5 text-slate-500"></i>
                                    Ubah Status
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 px-6 text-center text-slate-400">
                            <i data-lucide="map-off" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                            <p class="text-sm font-medium">Tidak ada titik kendala jalan yang aktif saat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>