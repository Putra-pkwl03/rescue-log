@props(['stokInventaris', 'poskoKomando'])

<div x-show="modalKirim" 
     x-transition:enter="transition ease-out duration-200" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="transition ease-in duration-150" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0" 
     class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4"
     style="display: none;"
     x-cloak>

    <div @click.away="modalKirim = false" class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-gray-100 overflow-hidden transform transition-all">
        <!-- Header Modal (Tema Amber/Oranye untuk Logistik) -->
        <div class="bg-amber-600 px-6 py-4 flex items-center justify-between text-white">
            <div>
                <h3 class="text-lg font-bold">Form Pengiriman Logistik</h3>
                <p class="text-xs text-amber-100">Kirim satu atau beberapa jenis barang sekaligus ke Posko Komando.</p>
            </div>
            <button type="button" @click="modalKirim = false" class="text-white hover:text-amber-200 text-2xl font-bold cursor-pointer">&times;</button>
        </div>

        <form action="{{ route('admin.distribusi.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <!-- Pilih Posko Tujuan -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Posko Komando Tujuan <span class="text-red-500">*</span></label>
                <select name="posko_id" x-model="kirimForm.posko_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white">
                    <option value="" disabled selected>-- Pilih Posko Komando --</option>
                    @foreach($poskoKomando as $posko)
                        <option value="{{ $posko->id }}">{{ $posko->nama_posko }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Daftar Item Barang (Dynamic Multi-Item) -->
            <div class="border-t border-b border-gray-100 py-4 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-bold text-gray-800">Daftar Barang Dikirim <span class="text-red-500">*</span></label>
                    <button type="button" @click="addKirimItem()" class="inline-flex items-center text-xs font-bold text-amber-700 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg border border-amber-200 transition cursor-pointer">
                        + Tambah Barang Lain
                    </button>
                </div>

                <template x-for="(item, index) in kirimForm.items" :key="index">
                    <div class="p-3.5 bg-gray-50 border border-gray-200 rounded-xl relative space-y-2">
                        <button type="button" @click="removeKirimItem(index)" x-show="kirimForm.items.length > 1" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-base cursor-pointer" title="Hapus Baris">&times;</button>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pr-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-600 mb-1">Pilih Barang</label>
                                <select :name="`items[${index}][stok_inventaris_id]`" x-model="item.stok_inventaris_id" @change="updateMaksStok(index, $event)" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white">
                                    <option value="" disabled selected>-- Pilih Barang --</option>
                                    @foreach($stokInventaris as $stok)
                                        <option value="{{ $stok->id }}" data-stok="{{ $stok->jumlah }}" {{ $stok->jumlah <= 0 ? 'disabled' : '' }}>
                                            {{ $stok->nama_barang }} (Tersedia: {{ $stok->jumlah }} {{ $stok->satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Jumlah</label>
                                <input type="number" :name="`items[${index}][jumlah_dikirim]`" x-model="item.jumlah_dikirim" min="1" :max="item.maks_stok" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-amber-500 focus:outline-none" placeholder="Jumlah">
                                <template x-if="item.maks_stok > 0">
                                    <span class="text-[10px] text-amber-700 font-bold block mt-1">Maks: <span x-text="item.maks_stok"></span></span>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Keterangan -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Keterangan / Catatan Tambahan</label>
                <textarea name="keterangan" x-model="kirimForm.keterangan" rows="2.5" placeholder="Contoh: Pengiriman bantuan darurat tahap 1..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:outline-none"></textarea>
            </div>

            <!-- Footer Tombol Aksi -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <button type="button" @click="modalKirim = false" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-bold hover:bg-gray-100 transition cursor-pointer">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold shadow-md transition cursor-pointer">Kirim Logistik</button>
            </div>
        </form>
    </div>
</div>