@props(['armadas' => []])

<div id="scheduleModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100">
        
        <!-- HEADER MODAL -->
        <div class="p-6 bg-slate-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-400">
                    <i data-lucide="truck" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Jadwalkan Armada Pengiriman</h3>
                    <p id="scheduleModalSubtitle" class="text-xs text-slate-300 mt-0.5">Pengajuan: -</p>
                </div>
            </div>
            <button onclick="closeScheduleModal()" type="button" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- FORM SUBMIT -->
        <form id="scheduleForm" method="POST" action="{{ route('komando.logistik.pengiriman.store') }}" class="p-6 space-y-4">
            @csrf
            
            <!-- Hidden Input ID Pengajuan (Disesuaikan name-nya dengan Controller) -->
            <input type="hidden" name="pengajuan_id" id="schedule_pengajuan_id">

            <!-- PILIH ARMADA -->
            <div>
                <label for="armada_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Pilih Armada / Kendaraan <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <select name="armada_id" id="armada_id" required class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:outline-none appearance-none">
                        <option value="" disabled selected>-- Pilih Truk / Kendaraan Lapangan --</option>
                        @forelse($armadas as $armada)
                            <option value="{{ $armada->id }}">
                                {{ $armada->nama_kendaraan ?? $armada->plat_nomor }} - {{ $armada->jenis_kendaraan ?? 'Truk Bantuan' }}
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada armada yang tersedia</option>
                        @endforelse
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-400">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>
            </div>

            <!-- TANGGAL KEBERANGKATAN -->
            <div>
                <label for="tanggal_kirim" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Estimasi Tanggal Keberangkatan <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                    </span>
                    <input type="date" name="tanggal_kirim" id="tanggal_kirim" required class="w-full pl-9 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:outline-none">
                </div>
            </div>

            <!-- CATATAN -->
            <div>
                <label for="catatan_rute" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Catatan Pengiriman / Rute (Opsional)
                </label>
                <textarea name="catatan_rute" id="catatan_rute" rows="3" placeholder="Contoh: Rute via jalur selatan..." class="w-full p-3 text-sm bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 focus:outline-none resize-none"></textarea>
            </div>

            <!-- BUTTONS -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeScheduleModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded-xl transition-colors shadow-lg shadow-amber-500/20 flex items-center gap-2 cursor-pointer">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span>Kirim Logistik Sekarang</span>
                </button>
            </div>
        </form>

    </div>
</div>