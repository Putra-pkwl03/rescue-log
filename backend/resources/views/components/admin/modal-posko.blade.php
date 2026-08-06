<!-- resources/views/components/admin/modal-posko.blade.php -->
<div x-show="openModal" 
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4">
    
    <div @click.away="openModal = false" 
         class="bg-white rounded-2xl shadow-xl border border-gray-100 max-w-md w-full p-6 transition-all transform">
        
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
            <h3 class="text-lg font-bold text-gray-800">Daftarkan Posko Komando</h3>
            <button type="button" @click="openModal = false" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
        </div>

        @if(Route::has('admin.posko.store'))
            <form action="{{ route('admin.posko.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Posko -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Posko</label>
                    <input type="text" name="nama_posko" value="{{ old('nama_posko', 'Posko Komando Utama BPBD') }}" required
                           placeholder="Contoh: Posko Komando Utama BPBD"
                           class="w-full px-3.5 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 text-sm">
                    @error('nama_posko')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid Penanggung Jawab & Kontak HP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" required
                               placeholder="Nama Lengkap"
                               class="w-full px-3.5 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 text-sm">
                        @error('penanggung_jawab')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="kontak_hp" value="{{ old('kontak_hp') }}" required
                               placeholder="08xxxxxxxxxx"
                               class="w-full px-3.5 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 text-sm">
                        @error('kontak_hp')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Alamat Kantor (Disabled) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Kantor</label>
                    <input type="text" value="{{ $bpbd->alamat_kantor ?? 'Kantor BPBD Pusat' }}" disabled
                           class="w-full px-3.5 py-2 border border-gray-200 rounded-xl bg-gray-50 text-gray-500 text-sm">
                    <p class="text-[11px] text-gray-400 mt-1">Otomatis mengikuti alamat kantor BPBD</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="openModal = false" 
                            class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                        Daftarkan
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>