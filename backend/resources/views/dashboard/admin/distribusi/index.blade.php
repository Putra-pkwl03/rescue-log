@extends('layouts.app')

@section('content')
<div x-data="{
    modalEditKirim: false,
    editKirimData: { id: '', nama_barang: '', posko_id: '', jumlah_dikirim: 1, keterangan: '' }
}">

    <!-- Header Section -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Menu Distribusi Logistik</h1>
            <p class="text-base text-gray-600 mt-1">Pemantauan riwayat dan pengelolaan distribusi barang dari gudang ke Posko Komando.</p>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-2 border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-900 font-bold text-lg cursor-pointer">&times;</button>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-900 font-bold text-lg cursor-pointer">&times;</button>
    </div>
    @endif

    <!-- TABEL RIWAYAT DISTRIBUSI BARANG -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Riwayat Pengiriman Logistik</h2>
                <p class="text-sm text-gray-500 mt-0.5">Daftar distribusi barang dari Gudang BPBD menuju Posko Komando.</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full border border-amber-200 shadow-sm">
                Batas Edit/Batal: 20 Menit
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100/80 text-gray-600 uppercase text-xs font-bold tracking-wider">
                        <th class="py-3.5 px-4">Waktu Pengiriman</th>
                        <th class="py-3.5 px-4">Nama Barang</th>
                        <th class="py-3.5 px-4">Posko Tujuan</th>
                        <th class="py-3.5 px-4">Jumlah Dikirim</th>
                        <th class="py-3.5 px-4">Petugas</th>
                        <th class="py-3.5 px-4">Keterangan</th>
                        <th class="py-3.5 px-4 text-center">Status / Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($riwayatPengiriman as $item)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-3.5 px-4 font-medium text-gray-700 whitespace-nowrap">
                                {{ $item->created_at->format('d M Y, H:i') }}
                                <span class="block text-xs text-gray-400 font-normal">({{ $item->created_at->diffForHumans() }})</span>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-gray-900">
                                {{ $item->stokInventaris->nama_barang ?? 'Barang Dihapus' }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-blue-700">
                                {{ $item->posko->nama_posko ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 font-extrabold text-amber-700 whitespace-nowrap">
                                {{ number_format($item->jumlah_dikirim) }} {{ $item->stokInventaris->satuan ?? 'unit' }}
                            </td>
                            <td class="py-3.5 px-4 text-gray-600">
                                {{ $item->user->name ?? 'Sistem' }}
                            </td>
                            <td class="py-3.5 px-4 text-gray-500 max-w-xs truncate">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($item->canBeEditedOrDeleted())
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <button 
                                            @click="
                                                modalEditKirim = true; 
                                                editKirimData = {
                                                    id: '{{ $item->id }}',
                                                    nama_barang: '{{ addslashes($item->stokInventaris->nama_barang ?? '') }}',
                                                    posko_id: '{{ $item->posko_id }}',
                                                    jumlah_dikirim: {{ $item->jumlah_dikirim }},
                                                    keterangan: '{{ addslashes($item->keterangan ?? '') }}'
                                                }
                                            "
                                            class="px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 rounded-lg font-bold text-xs transition cursor-pointer flex items-center shadow-sm"
                                        >
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>

                                        <!-- Tombol Batal/Hapus -->
                                        <form action="{{ route('admin.distribusi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengiriman ini? Stok barang akan dikembalikan otomatis ke gudang.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg font-bold text-xs transition cursor-pointer flex items-center shadow-sm">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Batal
                                            </button>
                                        </form>
                                    </div>
                                    <span class="block text-[10px] text-green-600 font-bold mt-1">Sisa: {{ $item->sisaWaktuMenit() }} mnt</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 border border-gray-200">
                                        Terkunci (>20 mnt)
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400 italic">Belum ada riwayat pengiriman logistik.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL EDIT PENGIRIMAN LOGISTIK -->
    <div x-show="modalEditKirim" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4"
         style="display: none;"
         x-cloak>

        <div @click.away="modalEditKirim = false" class="bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-gray-100 overflow-hidden transform transition-all">
            <!-- Header Modal -->
            <div class="bg-amber-600 px-6 py-4 flex items-center justify-between text-white">
                <div>
                    <h3 class="text-lg font-bold">Edit Data Pengiriman Logistik</h3>
                    <p class="text-xs text-amber-100">Ubah detail atau jumlah barang yang telah dikirim ke posko.</p>
                </div>
                <button type="button" @click="modalEditKirim = false" class="text-white hover:text-amber-200 text-2xl font-bold cursor-pointer">&times;</button>
            </div>

            <form :action="'{{ url('/admin/distribusi') }}/' + editKirimData.id" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama Barang (Disabled Field) -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" :value="editKirimData.nama_barang" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-300 rounded-xl text-sm font-bold text-gray-600 cursor-not-allowed">
                </div>

                <!-- Posko Komando Tujuan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Posko Komando Tujuan <span class="text-red-500">*</span></label>
                    <select name="posko_id" x-model="editKirimData.posko_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white">
                        @foreach($poskoKomando as $posko)
                            <option value="{{ $posko->id }}">{{ $posko->nama_posko }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah Dikirim -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah Dikirim Baru <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_dikirim" x-model="editKirimData.jumlah_dikirim" min="1" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:outline-none">
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Keterangan / Catatan</label>
                    <textarea name="keterangan" x-model="editKirimData.keterangan" rows="3" placeholder="Tambahkan catatan jika ada penyesuaian..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:outline-none"></textarea>
                </div>

                <!-- Footer Tombol Aksi -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="modalEditKirim = false" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-bold hover:bg-gray-100 transition cursor-pointer">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold shadow-md transition cursor-pointer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection