<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-700 font-semibold border-b border-gray-200 uppercase text-xs">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Kode Pengajuan</th>
                    <th class="py-3 px-4">Bencana</th>
                    <th class="py-3 px-4">Tanggal Diajukan</th>
                    <th class="py-3 px-4 text-center">Jumlah Barang</th>
                    <th class="py-3 px-4 text-center">Status BPBD</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pengajuans as $index => $pengajuan)
                    <tr class="hover:bg-gray-50/80 transition">
                        <td class="py-3.5 px-4 font-medium">{{ $pengajuans->firstItem() + $index }}</td>
                        <td class="py-3.5 px-4 font-semibold text-blue-600">
                            {{ $pengajuan->kode_pengajuan }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="font-medium text-gray-800">{{ $pengajuan->bencana->nama_bencana ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-gray-500">
                            {{ $pengajuan->tanggal_pengajuan ? $pengajuan->tanggal_pengajuan->format('d M Y, H:i') : '-' }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-block px-2.5 py-0.5 bg-gray-100 text-gray-700 font-medium rounded-full text-xs">
                                {{ $pengajuan->details->count() }} Jenis Item
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($pengajuan->status == 'pending')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-700">Menunggu BPBD</span>
                            @elseif($pengajuan->status == 'diproses')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Diproses</span>
                            @elseif($pengajuan->status == 'disetujui')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">Disetujui Penuh</span>
                            @elseif($pengajuan->status == 'disetujui_sebagian')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-teal-100 text-teal-700">Disetujui Sebagian</span>
                            @elseif($pengajuan->status == 'ditolak')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-700">Ditolak</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="inline-flex items-center space-x-2">
                                <!-- Tombol Detail -->
                                <button onclick="showDetail({{ json_encode($pengajuan->load(['bencana', 'details.barang', 'responder'])) }})" 
                                        class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-200 transition">
                                    Detail
                                </button>

                                <!-- Tombol Batalkan (Hanya jika status masih pending) -->
                                @if($pengajuan->status == 'pending')
                                    <form action="{{ route('komando.pengajuan-kebutuhan.destroy', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-600 text-xs font-medium rounded-md hover:bg-rose-100 transition">
                                            Batal
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-400">
                            Belum ada riwayat pengajuan kebutuhan ke BPBD.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    @if($pengajuans->hasPages())
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $pengajuans->links() }}
        </div>
    @endif
</div>