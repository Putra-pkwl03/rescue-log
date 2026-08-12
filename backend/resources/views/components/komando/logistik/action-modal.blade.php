<!-- MODAL POP-UP MENU AKSI TERPUSAT -->
<div id="actionModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all space-y-4">
        
        <!-- Header Modal -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h3 class="text-base font-bold text-slate-900">Konfirmasi Proses Pengajuan</h3>
                <p id="actionModalSubtitle" class="text-xs text-blue-600 font-semibold mt-0.5">-</p>
            </div>
            <button type="button" onclick="closeActionModal()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Opsi Pilihan Aksi -->
        <div class="space-y-2.5 pt-2">
            <!-- 1. Setujui Penuh (Harus berupa Form POST) -->
            <form id="formApproveFull" method="POST" action="">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between px-4 py-3 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                    <span class="flex items-center gap-2.5">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i> Setujui Penuh (Full)
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-emerald-500"></i>
                </button>
            </form>

            <!-- 2. Setujui Sebagian -->
            <button type="button" onclick="switchToPartialModal()" class="w-full flex items-center justify-between px-4 py-3 bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-800 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                <span class="flex items-center gap-2.5">
                    <i data-lucide="sliders" class="w-4 h-4 text-blue-600"></i> Setujui Sebagian (Atur Jumlah)...
                </span>
                <i data-lucide="chevron-right" class="w-4 h-4 text-blue-500"></i>
            </button>

            <!-- 3. Tolak Pengajuan (Harus berupa Form POST) -->
            <form id="formReject" method="POST" action="">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between px-4 py-3 bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-800 rounded-xl text-xs font-bold transition-colors cursor-pointer">
                    <span class="flex items-center gap-2.5">
                        <i data-lucide="x-circle" class="w-4 h-4 text-rose-600"></i> Tolak Pengajuan
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-rose-500"></i>
                </button>
            </form>
        </div>

        <!-- Tombol Batal -->
        <div class="pt-3 border-t border-slate-100 flex justify-end">
            <button type="button" onclick="closeActionModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-slate-700 text-xs font-semibold transition-colors cursor-pointer">
                Batal
            </button>
        </div>
    </div>
</div>