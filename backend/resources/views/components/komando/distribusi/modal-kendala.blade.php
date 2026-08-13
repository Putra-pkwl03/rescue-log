<div id="kendalaModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center z-50 hidden transition-opacity overflow-y-auto py-6">
    <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 w-full max-w-2xl p-6 m-4 space-y-4 max-h-[90vh] overflow-y-auto">
        
        <!-- HEADER MODAL -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i data-lucide="alert-octagon" class="w-5 h-5 text-rose-600"></i> Laporkan Kendala Jalan Baru
            </h3>
            <button onclick="closeKendalaModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('komando.distribusi.kendala.store') }}" class="space-y-4">
            @csrf
            
            <!-- NAMA LOKASI & JENIS KENDALA -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lokasi / Jalan</label>
                    <input type="text" id="input_nama_lokasi" name="nama_lokasi" required placeholder="Contoh: Jembatan Sungai A, KM 14" class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jenis Kendala</label>
                    <select name="jenis_kendala" required class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                        <option value="longsor">Tanah Longsor</option>
                        <option value="jembatan_putus">Jembatan Putus</option>
                        <option value="banjir">Banjir / Genangan</option>
                        <option value="pohon_tumbang">Pohon Tumbang</option>
                        <option value="jalan_rusak">Jalan Rusak Parah</option>
                    </select>
                </div>
            </div>

            <!-- PETA PEMILIHAN LOKASI (INTERAKTIF) -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Pilih Titik di Peta <span class="text-rose-500">*</span>
                    </label>
                    <button type="button" onclick="getCurrentGPSLocation()" class="inline-flex items-center gap-1 text-[11px] font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-2.5 py-1 rounded-lg transition border border-blue-200/60 cursor-pointer">
                        <i data-lucide="crosshair" class="w-3.5 h-3.5"></i> Gunakan Lokasi Saya
                    </button>
                </div>

                <!-- Container Mini Map -->
                <div id="modalMap" class="w-full h-60 rounded-xl border border-slate-200 overflow-hidden shadow-inner bg-slate-100"></div>
                <p class="text-[11px] text-slate-400 mt-1">💡 Klik atau geser pin merah pada peta di atas untuk menentukan koordinat presisi.</p>
            </div>

            <!-- KOORDINAT (READONLY AUTOMATIC) -->
            <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Latitude</label>
                    <input type="number" step="any" id="input_latitude" name="latitude" required readonly placeholder="-7.797068" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg font-mono text-slate-600 focus:outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Longitude</label>
                    <input type="number" step="any" id="input_longitude" name="longitude" required readonly placeholder="110.370529" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg font-mono text-slate-600 focus:outline-none">
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Deskripsi Keparahan</label>
                <textarea name="deskripsi" rows="2" placeholder="Jelaskan kondisi tingkat keparahan kendala jalan..." class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all"></textarea>
            </div>

            <!-- FOOTER ACTION -->
            <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeKendalaModal()" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-semibold bg-rose-600 hover:bg-rose-700 text-white rounded-xl transition shadow-md shadow-rose-600/20">Simpan Laporan</button>
            </div>
        </form>
    </div>
</div>