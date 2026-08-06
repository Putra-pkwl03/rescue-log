@props(['title', 'description', 'backUrl' => route('lapangan.dashboard')])

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <!-- Bagian Kiri: Tombol Kembali, Judul, dan Deskripsi -->
    <div class="flex items-start gap-3.5">
        <!-- Tombol Kembali ke Dashboard -->
        <a href="{{ $backUrl }}" 
           class="mt-0.5 inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition shadow-sm shrink-0" 
           title="Kembali ke Dashboard">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $title }}</h1>
            @if($description)
                <p class="text-gray-600 text-sm mt-0.5">{{ $description }}</p>
            @endif
        </div>
    </div>

    <!-- Bagian Kanan: Slot untuk Tombol Aksi Tambahan (Opsional, misal: Tombol Tambah Data) -->
    @if(isset($slot) && !$slot->isEmpty())
        <div class="flex items-center gap-3 shrink-0">
            {{ $slot }}
        </div>
    @endif
</div>