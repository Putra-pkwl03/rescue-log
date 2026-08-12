@php
    $dataPengajuan = $pengajuans ?? $pengajuan ?? collect();
@endphp

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden w-full">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Kode Pengajuan</th>
                    <th class="py-3 px-4">Bencana</th>
                    <th class="py-3 px-4">Tanggal Diajukan</th>
                    <th class="py-3 px-4">Jumlah Barang</th>
                    <th class="py-3 px-4">Status BPBD</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                @forelse($dataPengajuan as $index => $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3.5 px-4 font-medium text-gray-500">
                            {{ method_exists($dataPengajuan, 'firstItem') ? $dataPengajuan->firstItem() + $index : $index + 1 }}
                        </td>
                        <td class="py-3.5 px-4 font-bold text-gray-800">
                            {{ $item->kode_pengajuan }}
                        </td>
                        <td class="py-3.5 px-4">
                            {{ $item->bencana->nama_bencana ?? '-' }}
                        </td>
                        <td class="py-3.5 px-4 text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-semibold">
                                {{ $item->details->count() ?? 0 }} Barang
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if(in_array($item->status, ['pending', 'menunggu']))
                                <span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-medium border border-amber-200">
                                    Menunggu BPBD
                                </span>
                            @elseif(in_array($item->status, ['approved', 'disetujui']))
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-medium border border-emerald-200">
                                    Disetujui
                                </span>
                            @elseif($item->status == 'partial')
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-medium border border-blue-200">
                                    Disetujui Sebagian
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-rose-50 text-rose-600 rounded-full text-xs font-medium border border-rose-200">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Tombol Approve Penuh -->
                                @if(in_array($item->status, ['pending', 'menunggu']))
                                    <form action="{{ route('komando.logistik.approve', $item->id) }}" method="POST" onsubmit="return confirm('Setujui pengajuan kebutuhan logistik ini?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition shadow-sm cursor-pointer">
                                            Approve
                                        </button>
                                    </form>

                                    <!-- Tombol Reject -->
                                    <form action="{{ route('komando.logistik.reject', $item->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan logistik ini?')">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium rounded-lg transition shadow-sm cursor-pointer">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">Selesai Diproses</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-400 text-sm">
                            Belum ada riwayat pengajuan kebutuhan ke BPBD.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(method_exists($dataPengajuan, 'links'))
        <div class="p-4 border-t border-gray-100">
            {{ $dataPengajuan->links() }}
        </div>
    @endif
</div>