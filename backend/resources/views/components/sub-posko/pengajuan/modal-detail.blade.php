<div id="modalDetail" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all my-8">
        
        <!-- Header Modal -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-800" id="detailKode">-</h3>
                <p class="text-xs text-gray-500" id="detailBencana">-</p>
            </div>
            <button onclick="closeModalDetail()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-4">
            <!-- Information Grid -->
            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-3 rounded-lg text-xs">
                <div>
                    <span class="text-gray-400 block">Status BPBD:</span>
                    <span id="detailStatus" class="font-bold">-</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Tanggal Pengajuan:</span>
                    <span id="detailTanggal" class="font-semibold text-gray-700">-</span>
                </div>
            </div>

            <!-- Catatan Pengaju (Komando) -->
            <div id="boxCatatanKomando" class="hidden">
                <p class="text-xs font-semibold text-gray-600">Catatan Komando:</p>
                <p id="detailCatatanKomando" class="text-xs text-gray-700 bg-gray-50 p-2.5 rounded border border-gray-100 italic mt-1"></p>
            </div>

            <!-- Catatan Respon BPBD -->
            <div id="boxCatatanBpbd" class="hidden p-3 rounded-lg border">
                <p class="text-xs font-bold text-gray-700">Respon BPBD:</p>
                <p id="detailCatatanBpbd" class="text-xs mt-1"></p>
                <p id="detailResponder" class="text-[10px] text-gray-400 mt-2"></p>
            </div>

            <!-- Detail Barang Table -->
            <div>
                <h4 class="text-xs font-bold text-gray-700 uppercase mb-2">Rincian Barang Kebutuhan</h4>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-100 text-gray-600 font-semibold uppercase">
                            <tr>
                                <th class="py-2 px-3">Nama Barang</th>
                                <th class="py-2 px-3 text-center">Diminta</th>
                                <th class="py-2 px-3 text-center">Disetujui BPBD</th>
                            </tr>
                        </thead>
                        <tbody id="detailItemsBody" class="divide-y divide-gray-100 text-gray-700">
                            <!-- Injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-right">
            <button type="button" onclick="closeModalDetail()" class="px-4 py-1.5 bg-gray-200 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-300">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function showDetail(data) {
        document.getElementById('detailKode').innerText = data.kode_pengajuan;
        document.getElementById('detailBencana').innerText = data.bencana ? data.bencana.nama_bencana : '-';
        document.getElementById('detailTanggal').innerText = data.tanggal_pengajuan ? data.tanggal_pengajuan : '-';

        // Set Status
        const statusEl = document.getElementById('detailStatus');
        statusEl.innerText = data.status.toUpperCase();
        
        // Catatan Komando
        if(data.catatan_komando) {
            document.getElementById('boxCatatanKomando').classList.remove('hidden');
            document.getElementById('detailCatatanKomando').innerText = data.catatan_komando;
        } else {
            document.getElementById('boxCatatanKomando').classList.add('hidden');
        }

        // Catatan BPBD
        const boxBpbd = document.getElementById('boxCatatanBpbd');
        if(data.catatan_bpbd || data.status !== 'pending') {
            boxBpbd.classList.remove('hidden');
            document.getElementById('detailCatatanBpbd').innerText = data.catatan_bpbd ?? 'Tidak ada catatan khusus dari BPBD.';
            document.getElementById('detailResponder').innerText = `Diverifikasi oleh: ${data.responder ? data.responder.name : 'Petugas BPBD'} pada ${data.tanggal_respon ?? '-'}`;
            
            boxBpbd.className = data.status === 'ditolak' ? 'p-3 rounded-lg border bg-rose-50 border-rose-200 text-rose-800' : 'p-3 rounded-lg border bg-emerald-50 border-emerald-200 text-emerald-800';
        } else {
            boxBpbd.classList.add('hidden');
        }

        // Table Detail Barang
        const tbody = document.getElementById('detailItemsBody');
        tbody.innerHTML = '';

        if(data.details && data.details.length > 0) {
            data.details.forEach(item => {
                const tr = `
                    <tr>
                        <td class="py-2 px-3 font-medium">${item.barang ? item.barang.nama_barang : '-'}</td>
                        <td class="py-2 px-3 text-center font-bold text-gray-800">${item.jumlah_diminta} ${item.satuan}</td>
                        <td class="py-2 px-3 text-center font-bold text-emerald-600">${item.jumlah_disetujui ?? 0} ${item.satuan}</td>
                    </tr>
                `;
                tbody.innerHTML += tr;
            });
        }

        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeModalDetail() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
</script>