<!-- Modal Form Pengajuan Kebutuhan Baru -->
<div id="modalCreate" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl overflow-hidden transform transition-all my-8">
        
        <!-- Header Modal -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-800">Form Pengajuan Kebutuhan Logistik ke BPBD</h3>
                <p class="text-xs text-gray-500">Ajukan permohonan logistik berdasarkan data stok gudang BPBD.</p>
            </div>
            <button type="button" onclick="closeModalCreate()" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Form Pengajuan -->
        <form action="{{ route('komando.pengajuan.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <!-- Penanganan Alert Jika Data Utama Kosong -->
            @if(empty($barangs) || count($barangs) === 0 || empty($bencanaAktif) || count($bencanaAktif) === 0)
                <div class="p-3.5 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3 text-amber-800 text-xs">
                    <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <span class="font-bold block mb-0.5">Perhatian:</span>
                        @if(empty($barangs) || count($barangs) === 0)
                            <p>- Belum ada data stok barang inventaris di gudang BPBD.</p>
                        @endif
                        @if(empty($bencanaAktif) || count($bencanaAktif) === 0)
                            <p>- Belum ada kejadian bencana aktif yang terdaftar.</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Pilih Bencana -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Pilih Bencana <span class="text-rose-500">*</span></label>
                <select name="bencana_id" required class="w-full py-2 px-3 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white disabled:bg-gray-100 disabled:cursor-not-allowed" {{ (empty($bencanaAktif) || count($bencanaAktif) === 0) ? 'disabled' : '' }}>
                    <option value="">-- Pilih Kejadian Bencana --</option>
                    @if(!empty($bencanaAktif) && count($bencanaAktif) > 0)
                        @foreach($bencanaAktif as $bencana)
                            <option value="{{ $bencana->id }}">
                                {{ $bencana->jenis_bencana ?? $bencana->nama_bencana }} - {{ $bencana->lokasi ?? 'Lokasi Terdaftar' }}
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>-- Tidak Ada Data Bencana Aktif --</option>
                    @endif
                </select>
            </div>

            <!-- List Barang Dinamis -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700 uppercase">Daftar Barang Diminta <span class="text-rose-500">*</span></label>
                    <button type="button" id="btnAddItem" onclick="addItemRow()" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center disabled:text-gray-400 disabled:cursor-not-allowed">
                        + Tambah Barang
                    </button>
                </div>

                <div id="itemContainer" class="space-y-3 max-h-60 overflow-y-auto pr-1">
                    <!-- Dynamic Rows JS Template akan masuk di sini -->
                </div>
            </div>

            <!-- Catatan Tambahan Komando -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Catatan / Alasan Pengajuan (Opsional)</label>
                <textarea name="catatan_komando" rows="3" placeholder="Contoh: Stok di Posko Komando menipis akibat lonjakan jumlah pengungsi di Posko Lapangan A & B." class="w-full py-2 px-3 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>

            <!-- Footer Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeModalCreate()" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit" id="btnSubmitForm" class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 shadow-sm transition disabled:bg-gray-300 disabled:cursor-not-allowed" {{ (empty($barangs) || count($barangs) === 0 || empty($bencanaAktif) || count($bencanaAktif) === 0) ? 'disabled' : '' }}>
                    Kirim Pengajuan ke BPBD
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let itemIndex = 0;
    // Parsing data dari Blade ke JS dengan fallback array kosong
    const masterBarang = @json($barangs ?? []);

    function addItemRow() {
        const container = document.getElementById('itemContainer');
        const rowId = `item-row-${itemIndex}`;

        let barangOptions = '';
        let isBarangEmpty = !Array.isArray(masterBarang) || masterBarang.length === 0;

        // Penanganan jika data barang dari database kosong
        if (isBarangEmpty) {
            barangOptions = '<option value="" disabled selected>-- Stok barang tidak tersedia di gudang --</option>';
        } else {
            barangOptions = '<option value="">-- Pilih Barang Stok Gudang --</option>';
            masterBarang.forEach(b => {
                const kat = b.kategori ? ` (${b.kategori})` : '';
                const totalStok = b.jumlah !== undefined ? b.jumlah : 0;
                barangOptions += `<option value="${b.id}" data-satuan="${b.satuan ?? ''}" data-stok="${totalStok}">${b.nama_barang}${kat} - [Stok: ${totalStok} ${b.satuan ?? ''}]</option>`;
            });
        }

        const disabledAttr = isBarangEmpty ? 'disabled' : '';

        const rowHtml = `
            <div id="${rowId}" class="flex flex-col sm:flex-row items-center gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200">
                <!-- Select Barang -->
                <div class="w-full sm:w-5/12">
                    <select name="items[${itemIndex}][barang_id]" onchange="autoFillSatuan(this, ${itemIndex})" required ${disabledAttr} class="w-full py-1.5 px-2.5 text-xs border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 outline-none bg-white disabled:bg-gray-100 disabled:cursor-not-allowed">
                        ${barangOptions}
                    </select>
                </div>

                <!-- Input Jumlah & Satuan -->
                <div class="w-full sm:w-3/12 flex items-center gap-1">
                    <input type="number" id="jumlah-${itemIndex}" name="items[${itemIndex}][jumlah_diminta]" placeholder="Jumlah" min="1" required ${disabledAttr} class="w-full py-1.5 px-2.5 text-xs border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 outline-none bg-white disabled:bg-gray-100">
                    <input type="text" id="satuan-${itemIndex}" name="items[${itemIndex}][satuan]" placeholder="Satuan" readonly required ${disabledAttr} class="w-24 py-1.5 px-2.5 text-xs border border-gray-300 bg-gray-100 text-gray-500 rounded outline-none cursor-not-allowed">
                </div>

                <!-- Keterangan -->
                <div class="w-full sm:w-3/12">
                    <input type="text" name="items[${itemIndex}][keterangan]" placeholder="Ket (Misal: Mendesak)" ${disabledAttr} class="w-full py-1.5 px-2.5 text-xs border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 outline-none bg-white disabled:bg-gray-100">
                </div>

                <!-- Tombol Hapus Baris -->
                <div class="w-full sm:w-1/12 text-center">
                    <button type="button" onclick="removeItemRow('${rowId}')" class="text-rose-500 hover:text-rose-700 font-bold text-sm">
                        ✕
                    </button>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', rowHtml);
        itemIndex++;
    }

    function autoFillSatuan(selectElem, index) {
        if (!selectElem.value) return;

        const selectedOption = selectElem.options[selectElem.selectedIndex];
        const satuan = selectedOption.getAttribute('data-satuan');
        const stok = selectedOption.getAttribute('data-stok');

        const inputSatuan = document.getElementById(`satuan-${index}`);
        const inputJumlah = document.getElementById(`jumlah-${index}`);

        if (inputSatuan) {
            inputSatuan.value = satuan ? satuan : '';
        }

        if (inputJumlah && stok !== null) {
            inputJumlah.max = stok;
        }
    }

    function removeItemRow(id) {
        const container = document.getElementById('itemContainer');
        const row = document.getElementById(id);
        if (row) row.remove();

        // Jika semua baris dihapus, buat 1 baris baru otomatis
        if (container.children.length === 0) {
            addItemRow();
        }
    }

    function openModalCreate() {
        document.getElementById('modalCreate').classList.remove('hidden');
        
        // Reset container jika baru pertama kali dibuka
        const container = document.getElementById('itemContainer');
        if (container.children.length === 0) {
            addItemRow();
        }
    }

    function closeModalCreate() {
        document.getElementById('modalCreate').classList.add('hidden');
    }
</script>