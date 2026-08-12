@php
    $dataPengajuan = $pengajuans ?? $pengajuan ?? collect();
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 w-full">
    
    <!-- 1. Total Permintaan Masuk -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4 shrink-0">
                <x-heroicon-o-clipboard-document-list class="w-6 h-6 stroke-[2.5]" />
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Total Permintaan</p>
                <h3 class="text-xl font-bold text-gray-800">
                    {{ method_exists($dataPengajuan, 'total') ? $dataPengajuan->total() : $dataPengajuan->count() }}
                </h3>
            </div>
        </div>
    </div>

    <!-- 2. Menunggu Verifikasi BPBD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-amber-50 text-amber-600 mr-4 shrink-0">
                <x-heroicon-o-clock class="w-6 h-6 stroke-[2.5]" />
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Menunggu BPBD</p>
                <h3 class="text-xl font-bold text-amber-600">
                    {{ $dataPengajuan->whereIn('status', ['pending', 'menunggu'])->count() }}
                </h3>
            </div>
        </div>
    </div>

    <!-- 3. Disetujui BPBD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600 mr-4 shrink-0">
                <x-heroicon-o-check-circle class="w-6 h-6 stroke-[2.5]" />
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Disetujui BPBD</p>
                <h3 class="text-xl font-bold text-emerald-600">
                    {{ $dataPengajuan->whereIn('status', ['approved', 'disetujui'])->count() }}
                </h3>
            </div>
        </div>
    </div>

    <!-- 4. Ditolak BPBD -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-rose-50 text-rose-600 mr-4 shrink-0">
                <x-heroicon-o-x-circle class="w-6 h-6 stroke-[2.5]" />
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium whitespace-nowrap">Ditolak BPBD</p>
                <h3 class="text-xl font-bold text-rose-600">
                    {{ $dataPengajuan->whereIn('status', ['rejected', 'ditolak'])->count() }}
                </h3>
            </div>
        </div>
    </div>

</div>