<!-- MODAL DETAIL PENGAJUAN LOGISTIK -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 transform transition-all">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Rincian Lengkap Pengajuan Logistik</h3>
                <p id="detailKodePengajuan" class="text-xs text-blue-600 font-semibold mt-0.5">-</p>
            </div>
            <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <div class="space-y-4 text-xs">
            <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                <div>
                    <span class="text-slate-400 block">Posko Lapangan:</span>
                    <span id="detailPoskoNama" class="font-bold text-slate-800">-</span>
                </div>
                <div>
                    <span class="text-slate-400 block">Waktu Pengajuan:</span>
                    <span id="detailWaktu" class="font-bold text-slate-800">-</span>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-slate-800 mb-2 uppercase tracking-wider text-[10px]">Daftar Kebutuhan Logistik:</h4>
                <div class="border border-slate-200 rounded-xl overflow-hidden max-h-[40vh] overflow-y-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 text-slate-500 border-b border-slate-200 sticky top-0">
                            <tr>
                                <th class="p-3 font-semibold">Jenis Barang</th>
                                <th class="p-3 font-semibold text-right">Jumlah Diajukan</th>
                            </tr>
                        </thead>
                        <tbody id="detailTabelBarang" class="divide-y divide-slate-100 text-slate-700">
                            <!-- Diisi via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end pt-4 border-t border-slate-100 mt-6">
            <button type="button" onclick="closeDetailModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-slate-700 text-xs font-semibold transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>