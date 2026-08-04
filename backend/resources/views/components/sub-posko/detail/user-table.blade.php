@props(['kebutuhans' => collect()])

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden p-5">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
        <div class="flex items-center gap-2">
            <h3 class="text-sm font-bold text-slate-900">Kebutuhan Mendesak</h3>
            <span class="inline-flex items-center justify-center w-5 h-5 bg-rose-50 text-rose-600 rounded-full text-xs font-bold border border-rose-100">
                {{ $kebutuhans->count() }}
            </span>
        </div>
        <a href="#" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">Lihat Semua Kebutuhan</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($kebutuhans as $item)
            @php
                $jumlahDibutuhkan = $item->jumlah_dibutuhkan ?? 1;
                $jumlahTerpenuhi = $item->jumlah_terpenuhi ?? 0;
                $persen = min(100, round(($jumlahTerpenuhi / max(1, $jumlahDibutuhkan)) * 100));
            @endphp
            <div class="bg-slate-50/50 rounded-xl border border-slate-200/60 p-4 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <h4 class="text-xs font-bold text-slate-900">{{ $item->nama_barang ?? $item->nama ?? 'Nama Barang' }}</h4>
                        <span class="text-[10px] font-medium px-2 py-0.5 bg-white text-slate-600 rounded border border-slate-200">
                            {{ $item->kategori ?? 'Logistik' }}
                        </span>
                    </div>
                    <div class="space-y-1 text-[11px] text-slate-500 mb-3">
                        <div class="flex justify-between">
                            <span>Kebutuhan:</span>
                            <strong class="text-slate-700">{{ $jumlahDibutuhkan }} {{ $item->satuan ?? '' }}</strong>
                        </div>
                        <div class="flex justify-between">
                            <span>Terpenuhi:</span>
                            <strong class="text-slate-700">{{ $jumlahTerpenuhi }} {{ $item->satuan ?? '' }}</strong>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-1">
                    <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                    </div>
                    <div class="flex justify-end text-[10px] font-bold text-slate-600">
                        {{ $persen }}%
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-8 text-center text-slate-400 text-xs">
                Belum ada data kebutuhan mendesak untuk posko ini.
            </div>
        @endforelse
    </div>
</div>