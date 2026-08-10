@props(['stokInventaris'])

<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b border-gray-200 text-gray-700 text-xs uppercase tracking-wider font-bold">
                <th class="py-4 px-6">No</th>
                <th class="py-4 px-6">Nama Barang</th>
                <th class="py-4 px-6">Kategori</th>
                <th class="py-4 px-6 text-center">Jumlah Stok</th>
                <th class="py-4 px-6 text-center">Status</th>
                <th class="py-4 px-6">Keterangan</th>
                <th class="py-4 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody id="inventarisTableBody" class="divide-y divide-gray-200 text-sm">
            @forelse($stokInventaris as $index => $item)
            <tr class="hover:bg-blue-50/50 transition item-row" data-nama="{{ $item->nama_barang }}" data-kategori="{{ $item->kategori }}">
                <td class="py-4 px-6 font-semibold text-gray-500">{{ $index + 1 }}</td>
                <td class="py-4 px-6 font-bold text-gray-900">{{ $item->nama_barang }}</td>
                <td class="py-4 px-6">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                        {{ $item->kategori }}
                    </span>
                </td>
                <td class="py-4 px-6 text-center font-extrabold text-base text-gray-900">
                    {{ number_format($item->jumlah) }} <span class="text-xs font-normal text-gray-500">{{ $item->satuan }}</span>
                </td>
                <td class="py-4 px-6 text-center">
                    @if($item->jumlah == 0)
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700 border border-red-200">Habis</span>
                    @elseif($item->jumlah <= 50)
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">Menipis</span>
                    @else
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">Aman</span>
                    @endif
                </td>
                <td class="py-4 px-6 text-gray-600 max-w-xs truncate">{{ $item->keterangan ?? '-' }}</td>
                <td class="py-4 px-6 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <!-- Tombol Edit -->
                        <button @click="
                            editData = {
                                id: '{{ $item->id }}',
                                nama_barang: '{{ $item->nama_barang }}',
                                kategori: '{{ $item->kategori }}',
                                jumlah: '{{ $item->jumlah }}',
                                satuan: '{{ $item->satuan }}',
                                keterangan: '{{ $item->keterangan }}'
                            };
                            modalEdit = true;
                        " class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition cursor-pointer" title="Edit Barang">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>

                        <!-- Form Hapus Barang -->
                        <form action="{{ route('admin.inventaris.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition cursor-pointer" title="Hapus Barang">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="py-12 text-center text-gray-500 bg-gray-50">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <p class="text-base font-bold text-gray-700">Belum Ada Data Stok Inventaris</p>
                    <p class="text-sm text-gray-500 mt-1">Silakan klik tombol "Tambah Stok Barang" untuk menambahkan data baru.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>