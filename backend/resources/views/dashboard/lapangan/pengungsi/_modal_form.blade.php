<!-- MODAL OVERLAY -->
<div id="modal-pendataan" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <!-- Latar Belakang Blur -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="modal-backdrop"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            
            <!-- PANEL MODAL UTAMA -->
            <div id="modal-panel" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <!-- HEADER MODAL -->
                <div class="bg-blue-600 px-6 py-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-white" id="modal-title">Form Pendataan Pengungsi</h3>
                        <p class="text-blue-100 text-xs mt-1">Pastikan data diisi sesuai kondisi real-time di pos lapangan.</p>
                    </div>
                    <button type="button" onclick="closePendataanModal()" class="text-white hover:text-blue-200 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- FORM BODY -->
                <form id="form-pendataan" action="{{ route('lapangan.pengungsi.store') }}" method="POST">
                    @csrf
                    <div class="max-h-[70vh] overflow-y-auto p-6 md:p-8 space-y-8">
                        
                        <!-- 1. Informasi Dasar -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex justify-between items-center">
                            <div class="flex items-center text-sm text-blue-800 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Tanggal Pendataan
                            </div>
                            <div class="font-bold text-blue-900">{{ now()->format('d/m/Y H:i') }} WIB</div>
                        </div>

                        <!-- 2. Rincian Kategori Khusus -->
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4">Rincian Demografi Pengungsi</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Total Pengungsi <span class="text-red-500">*</span></label>
                                    <input type="number" name="total_pengungsi" value="{{ $pendataan_terakhir->total_pengungsi ?? '' }}" placeholder="0" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Anak Balita (0-5 th) <span class="text-red-500">*</span></label>
                                    <input type="number" name="balita" value="{{ $pendataan_terakhir->balita ?? '' }}" placeholder="0" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Dewasa (18-59 th) <span class="text-red-500">*</span></label>
                                    <input type="number" name="dewasa" value="{{ $pendataan_terakhir->dewasa ?? '' }}" placeholder="0" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Ibu Hamil <span class="text-red-500">*</span></label>
                                    <input type="number" name="ibu_hamil" value="{{ $pendataan_terakhir->ibu_hamil ?? '' }}" placeholder="0" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Lansia (&ge; 60 th) <span class="text-red-500">*</span></label>
                                    <input type="number" name="lansia" value="{{ $pendataan_terakhir->lansia ?? '' }}" placeholder="0" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Disabilitas <span class="text-red-500">*</span></label>
                                    <input type="number" name="disabilitas" value="{{ $pendataan_terakhir->disabilitas ?? '' }}" placeholder="0" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Kondisi & Fasilitas -->
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4">Kondisi & Fasilitas Tempat</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Tipe Tempat <span class="text-red-500">*</span></label>
                                    <select name="tipe_tempat" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                        <option value="">Pilih...</option>
                                        @foreach(['Balai Desa', 'Masjid/Tempat Ibadah', 'Sekolah', 'Tenda/Lapangan'] as $tipe)
                                            <option value="{{ $tipe }}" {{ ($pendataan_terakhir->tipe_tempat ?? '') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Akses Air <span class="text-red-500">*</span></label>
                                    <select name="akses_air" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                        <option value="">Pilih...</option>
                                        @foreach(['Cukup', 'Terbatas', 'Tidak Ada'] as $air)
                                            <option value="{{ $air }}" {{ ($pendataan_terakhir->akses_air ?? '') == $air ? 'selected' : '' }}>{{ $air }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Akses Jalan <span class="text-red-500">*</span></label>
                                    <select name="akses_jalan" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                        <option value="">Pilih...</option>
                                        @foreach(['Mobil/Truk Bisa Masuk', 'Hanya Motor', 'Harus Jalan Kaki'] as $jalan)
                                            <option value="{{ $jalan }}" {{ ($pendataan_terakhir->akses_jalan ?? '') == $jalan ? 'selected' : '' }}>{{ $jalan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-700 mb-1">Lama Pengungsian (Hari) <span class="text-red-500">*</span></label>
                                    <input type="number" name="lama_pengungsian" value="{{ $pendataan_terakhir->lama_pengungsian ?? '1' }}" min="1" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-500 text-sm outline-none" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- FOOTER MODAL (Tombol Submit) -->
                    <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse rounded-b-2xl">
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 sm:ml-3 sm:w-auto">
                            Simpan & Hitung Logistik AI
                        </button>
                        <button type="button" onclick="closePendataanModal()" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openPendataanModal() {
        const modal = document.getElementById('modal-pendataan');
        const backdrop = document.getElementById('modal-backdrop');
        const panel = document.getElementById('modal-panel');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            backdrop.classList.add('opacity-100');
            panel.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        }, 10);
    }

    function closePendataanModal() {
        const modal = document.getElementById('modal-pendataan');
        const backdrop = document.getElementById('modal-backdrop');
        const panel = document.getElementById('modal-panel');
        
        backdrop.classList.remove('opacity-100');
        panel.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>