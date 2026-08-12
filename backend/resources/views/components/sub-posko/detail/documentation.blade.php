@props(['subPosko'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-slate-900">Dokumentasi Posko</h3>
        <span class="text-xs text-slate-400 font-medium">Foto Lapangan</span>
    </div>

    @error('fotos.*')
        <div class="text-red-500 text-xs bg-red-50 p-2 rounded-lg border border-red-100">{{ $message }}</div>
    @enderror

    <!-- Grid Foto -->
    <div class="grid grid-cols-3 gap-2">
        
        <!-- 1. Looping Semua Foto dari Relasi (Pengecekan Aman isset) -->
        @if(isset($subPosko->fotos) && !empty($subPosko->fotos))
            @foreach($subPosko->fotos as $foto)
                <div class="h-40 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 relative group cursor-pointer"
                     onclick="openLightbox('{{ asset('storage/' . $foto->path_file) }}', '{{ basename($foto->path_file) }}')"
                     title="Klik untuk memperbesar">
                    <img src="{{ asset('storage/' . $foto->path_file) }}" alt="Dokumentasi" class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- 2. Form Upload Foto -->
        <form action="{{ route('lapangan.dokumentasi.upload') }}" method="POST" enctype="multipart/form-data" class="h-40">
            @csrf
            <label class="h-full rounded-lg bg-slate-50 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 hover:bg-slate-100 hover:border-blue-400 hover:text-blue-500 transition cursor-pointer">
                <svg class="w-5 h-5 stroke-2 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-[10px] font-bold uppercase tracking-wider">Upload</span>
                <input type="file" name="fotos[]" class="hidden" accept="image/jpeg, image/png, image/jpg" multiple onchange="this.form.submit()">
            </label>
        </form>

        <!-- 3. Indikator Jumlah Foto Dinamis (Menggunakan Safe Null Coalescing) -->
        <div class="h-40 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 text-xs font-semibold">
            {{ isset($subPosko->fotos) && count($subPosko->fotos) > 0 ? '+' . count($subPosko->fotos) . ' Foto' : '0 Foto' }}
        </div>
    </div>
</div>

<script>
if (typeof window.openLightbox !== 'function') {
    window.openLightbox = function (src, fileName) {
        let modal = document.getElementById('lightboxModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'lightboxModal';
            modal.className = 'fixed inset-0 z-[9999] hidden bg-slate-900/80 backdrop-blur-sm flex items-center justify-center p-4';
            modal.innerHTML = `
                <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center" id="lightboxInner">
                    <button type="button" id="lightboxCloseBtn" class="absolute -top-10 right-0 text-white hover:text-slate-300 font-bold text-2xl leading-none">&times;</button>
                    <img id="lightboxImage" src="" alt="Dokumentasi Full" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-2xl bg-white">
                    <div class="mt-3 bg-white/95 rounded-xl px-4 py-2 text-xs text-slate-700 flex items-center gap-3 shadow">
                        <span id="lightboxFileName" class="font-semibold text-slate-900">-</span>
                        <span class="text-slate-300">|</span>
                        <span id="lightboxDimensions" class="font-mono text-slate-500">memuat ukuran...</span>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            modal.addEventListener('click', function (e) {
                if (e.target === modal) window.closeLightbox();
            });
            modal.querySelector('#lightboxCloseBtn').addEventListener('click', window.closeLightbox);
        }

        const img = modal.querySelector('#lightboxImage');
        const nameEl = modal.querySelector('#lightboxFileName');
        const dimEl = modal.querySelector('#lightboxDimensions');

        nameEl.innerText = fileName || '-';
        dimEl.innerText = 'memuat ukuran...';
        img.src = src;
        img.onload = function () {
            dimEl.innerText = img.naturalWidth + ' x ' + img.naturalHeight + ' px';
        };

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function () {
        const modal = document.getElementById('lightboxModal');
        if (modal) modal.classList.add('hidden');
        document.body.style.overflow = '';
    };
}
</script>