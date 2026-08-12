<!-- MODAL SETUJUI SEBAGIAN (PARTIAL APPROVAL) -->
<div id="partialModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 transform transition-all">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Persetujuan Sebagian (Partial Approval)</h3>
                <p id="modalSubTitle" class="text-xs text-slate-500 mt-0.5">Sesuaikan jumlah kuantitas logistik yang akan disetujui.</p>
            </div>
            <button onclick="closePartialModal()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <!-- Form Revisi Jumlah Barang -->
        <form id="partialForm" method="POST" action="" class="space-y-4">
            @csrf
            <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-3 text-xs text-blue-800">
                Ubah angka pada item logistik sesuai dengan kuantitas stok yang tersedia di gudang komando.
            </div>

            <!-- Kontainer Input 12 Item Logistik (Scrollable) -->
            <div class="max-h-[50vh] overflow-y-auto space-y-3 pr-2 text-xs">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Beras (Kg)</label>
                        <input type="number" id="part_beras_kg" name="beras_kg" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Makanan Kaleng (Pack)</label>
                        <input type="number" id="part_makanan_kaleng_pack" name="makanan_kaleng_pack" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Makanan Bayi (Pack)</label>
                        <input type="number" id="part_makanan_bayi_pack" name="makanan_bayi_pack" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Minyak Goreng (Liter)</label>
                        <input type="number" id="part_minyak_goreng_liter" name="minyak_goreng_liter" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Air Minum (Dus)</label>
                        <input type="number" id="part_air_minum_dus" name="air_minum_dus" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Popok Bayi (Pcs)</label>
                        <input type="number" id="part_popok_bayi_pcs" name="popok_bayi_pcs" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Popok Dewasa (Pcs)</label>
                        <input type="number" id="part_popok_dewasa_pcs" name="popok_dewasa_pcs" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Pembalut Wanita (Pack)</label>
                        <input type="number" id="part_pembalut_wanita_pack" name="pembalut_wanita_pack" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Hygiene Kit (Paket)</label>
                        <input type="number" id="part_hygiene_kit_paket" name="hygiene_kit_paket" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Selimut (Pcs)</label>
                        <input type="number" id="part_selimut_pcs" name="selimut_pcs" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Matras / Terpal (Pcs)</label>
                        <input type="number" id="part_matras_terpal_pcs" name="matras_terpal_pcs" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Obat P3K (Paket)</label>
                        <input type="number" id="part_obat_p3k_paket" name="obat_p3k_paket" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closePartialModal()" class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-700 text-xs font-semibold hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg shadow-sm">
                    Simpan & Setujui Sebagian
                </button>
            </div>
        </form>
    </div>
</div>