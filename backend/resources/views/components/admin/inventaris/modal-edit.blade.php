<div x-show="modalEdit" 
     x-transition:enter="transition ease-out duration-200" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="transition ease-in duration-150" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0" 
     class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4"
     style="display: none;">

    <div @click.away="modalEdit = false" class="bg-white rounded-2xl max-w-lg w-full shadow-2xl border border-gray-100 overflow-hidden transform transition-all">
        <div class="bg-blue-700 px-6 py-4 flex items-center justify-between text-white">
            <h3 class="text-lg font-bold">Edit Data Stok Inventaris</h3>
            <button @click="modalEdit = false" class="text-white hover:text-gray-200 text-2xl font-bold cursor-pointer">&times;</button>
        </div>

        <form :action="`{{ url('admin/inventaris') }}/${editData.id}`" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                <input type="text" name="nama_barang" x-model="editData.nama_barang" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" x-model="editData.kategori" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option value="Makanan & Minuman">Makanan & Minuman</option>
                    <option value="Medis & Kesehatan">Medis & Kesehatan</option>
                    <option value="Perlengkapan & Tenda">Perlengkapan & Tenda</option>
                    <option value="Pakaian & Selimut">Pakaian & Selimut</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah <span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="jumlah" x-model="editData.jumlah" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Satuan <span class="text-red-500">*</span></label>
                    <input type="text" name="satuan" x-model="editData.satuan" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Keterangan Tambahan</label>
                <textarea name="keterangan" x-model="editData.keterangan" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <button type="button" @click="modalEdit = false" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-bold hover:bg-gray-100 transition cursor-pointer">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-sm font-bold shadow-md transition cursor-pointer">Perbarui Data</button>
            </div>
        </form>
    </div>
</div>