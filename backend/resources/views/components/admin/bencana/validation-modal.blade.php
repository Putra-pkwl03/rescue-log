<div id="modalValidasi" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100 transform transition-all">
        
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 text-white px-6 py-4 flex justify-between items-center shadow-md">
            <div class="flex items-center gap-2">
                <span class="text-lg">🚨</span>
                <h3 class="font-bold text-base">Validasi & Aktivasi Bencana</h3>
            </div>
            <button onclick="closeModal()" class="text-amber-200 hover:text-white font-bold text-xl transition-colors cursor-pointer">&times;</button>
        </div>

        <form id="formValidasi" action="" method="POST" class="p-6 space-y-4">
            @csrf

            <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-4 text-xs text-slate-700 space-y-2.5">
                <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                    <span class="font-bold text-slate-900 uppercase tracking-wider text-[11px]">📍 Informasi Deteksi BMKG</span>
                    <span id="valJenisBadge" class="px-2 py-0.5 font-bold bg-amber-100 text-amber-800 rounded uppercase">Bencana</span>
                </div>
                
                <div class="grid grid-cols-3 gap-2 pt-1">
                    <span class="text-slate-500">Jenis Bencana:</span>
                    <span id="valJenis" class="col-span-2 font-semibold text-slate-800">-</span>
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <span class="text-slate-500">Wilayah / Lokasi:</span>
                    <span id="valWilayah" class="col-span-2 font-semibold text-slate-800">-</span>
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <span class="text-slate-500">Koordinat (Lat, Lng):</span>
                    <span class="col-span-2 font-mono text-slate-700"><span id="valLat">-</span>, <span id="valLng">-</span></span>
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <span class="text-slate-500">Waktu Terdeteksi:</span>
                    <span id="valWaktu" class="col-span-2 font-medium text-slate-800">-</span>
                </div>
            </div>

            <div class="bg-amber-50/70 border border-amber-200/60 p-3 rounded-xl flex items-start gap-2.5">
                <span class="text-amber-600 text-sm mt-0.5">⚠️</span>
                <p class="text-xs text-amber-900 leading-relaxed">
                    Dengan mengaktifkan bencana ini, status akan diubah menjadi <strong>Sedang Berjalan</strong> dan resmi membuka komando tanggap darurat di sistem BPBD.
                </p>
            </div>

            <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-semibold shadow-sm transition-all flex items-center gap-1.5 cursor-pointer">
                    <span>🚀</span> Aktifkan Bencana
                </button>
            </div>
        </form>

    </div>
</div>