@props(['subPosko'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-slate-900">Dokumentasi Posko</h3>
        <span class="text-xs text-slate-400 font-medium">Foto Lapangan</span>
    </div>

    <!-- Menampilkan Error jika file terlalu besar / bukan gambar -->
    @error('foto')
        <div class="text-red-500 text-xs bg-red-50 p-2 rounded-lg border border-red-100">{{ $message }}</div>
    @enderror

    <div class="grid grid-cols-3 gap-2">
        <!-- 1. Tampilkan Foto jika ada di Database -->
        @if($subPosko && $subPosko->foto)
            <div class="h-20 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 relative group">
                <img src="{{ asset('storage/' . $subPosko->foto) }}" alt="Dokumentasi" class="w-full h-full object-cover">
            </div>
        @endif

        <!-- 2. Form Upload Foto (Auto Submit) -->
        <form action="{{ route('lapangan.dokumentasi.upload') }}" method="POST" enctype="multipart/form-data" class="h-20">
            @csrf
            <!-- Label bertindak sebagai tombol yang bisa di-klik -->
            <label class="h-full rounded-lg bg-slate-50 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 hover:bg-slate-100 hover:border-blue-400 hover:text-blue-500 transition cursor-pointer">
                <svg class="w-5 h-5 stroke-2 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-[10px] font-bold uppercase tracking-wider">Upload</span>
                
                <!-- Input File Disembunyikan, auto-submit dengan onchange -->
                <input type="file" name="foto" class="hidden" accept="image/jpeg, image/png, image/jpg" onchange="this.form.submit()">
            </label>
        </form>

        <!-- 3. Placeholder / Info -->
        <div class="h-20 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 text-xs font-semibold">
            {{ $subPosko && $subPosko->foto ? '+1 Foto' : '0 Foto' }}
        </div>
    </div>
</div>