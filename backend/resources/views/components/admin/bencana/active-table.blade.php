<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-base font-bold text-slate-900">Operasi Tanggap Darurat Aktif</h2>
            <p class="text-xs text-slate-500">Daftar bencana resmi yang sedang dalam penanganan logistik BPBD.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-slate-500 text-xs font-semibold uppercase tracking-wider bg-slate-50">
                    <th class="p-3">Jenis Bencana</th>
                    <th class="p-3">Lokasi / Wilayah</th>
                    <th class="p-3">Tanggal Aktivasi</th>
                    <th class="p-3">Koordinat</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($activeDisasters ?? [] as $bencana)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="p-3 font-semibold text-slate-900">
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                                {{ $bencana->jenis_bencana }}
                            </span>
                        </td>
                        <td class="p-3 text-slate-700">{{ $bencana->lokasi_bencana }}</td>
                        <td class="p-3 text-slate-600">
                            {{ \Carbon\Carbon::parse($bencana->tanggal_aktivasi)->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td class="p-3 text-xs text-slate-500 font-mono">
                            {{ $bencana->koordinat_operasional_lat ?? '-' }}, {{ $bencana->koordinat_operasional_lng ?? '-' }}
                        </td>
                        <td class="p-3">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800">
                                Sedang Berjalan
                            </span>
                        </td>
                        <td class="p-3 text-right space-x-2">
                            <form id="form-selesai-{{ $bencana->id }}" action="{{ route('admin.bencana.finish', $bencana->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="button" 
                                        onclick="konfirmasiSelesaiOperasi({{ $bencana->id }}, '{{ $bencana->jenis_bencana }}')"
                                        class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-semibold rounded-lg transition-colors cursor-pointer">
                                    Selesaikan Operasi
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-slate-400 text-sm">
                            Belum ada operasi bencana yang sedang berjalan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>