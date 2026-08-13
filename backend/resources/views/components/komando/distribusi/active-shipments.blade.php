@props(['pengirimans'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs">
    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
            <i data-lucide="navigation-2" class="w-5 h-5 text-blue-600"></i> Status Pengiriman Aktif
        </h2>
        <span class="text-xs bg-slate-100 text-slate-600 font-bold px-2 py-1 rounded-md">Live Tracking</span>
    </div>

    <div class="space-y-3 max-h-[620px] overflow-y-auto pr-1">
        @forelse($pengirimans->where('status_pengiriman', 'dalam_perjalanan') as $shipment)
            @php
                // --- 1. KOORDINAT & NAMA POSKO ASAL (PENGIRIM) ---
                $latAsal = $shipment->lat_asal 
                    ?? $shipment->poskoAsal->latitude 
                    ?? $shipment->posko_asal->latitude 
                    ?? -7.7956;

                $longAsal = $shipment->long_asal 
                    ?? $shipment->poskoAsal->longitude 
                    ?? $shipment->posko_asal->longitude 
                    ?? 110.3695;

                $namaPoskoAsal = $shipment->poskoAsal->nama_posko 
                    ?? $shipment->posko_asal->nama_posko 
                    ?? 'Posko Utama Komando';

                // --- 2. KOORDINAT & NAMA POSKO TUJUAN ---
                $latTujuan = $shipment->lat_tujuan 
                    ?? $shipment->poskoTujuan->latitude 
                    ?? $shipment->pengajuan->posko->latitude 
                    ?? -7.7970;

                $longTujuan = $shipment->long_tujuan 
                    ?? $shipment->poskoTujuan->longitude 
                    ?? $shipment->pengajuan->posko->longitude 
                    ?? 110.3700;

                $namaPoskoTujuan = $shipment->poskoTujuan->nama_posko 
                    ?? $shipment->pengajuan->posko->nama_posko 
                    ?? $shipment->pengajuan->user->name 
                    ?? 'Posko Lapangan Tujuan';
            @endphp

            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:border-blue-200 hover:shadow-sm transition-all space-y-3">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <span class="text-[11px] font-bold font-mono text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">
                            #{{ $shipment->kode_pengiriman ?? 'SHIP-'.$shipment->id }}
                        </span>
                        
                        <!-- Info Rute: Asal -> Tujuan -->
                        <div class="mt-1.5 space-y-0.5">
                            <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Dari: {{ $namaPoskoAsal }}
                            </p>
                            <h4 class="font-bold text-slate-900 text-sm flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Ke: {{ $namaPoskoTujuan }}
                            </h4>
                        </div>
                    </div>
                    
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold bg-amber-100 text-amber-800 px-2.5 py-1 rounded-full shrink-0">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span> On Delivery
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-2 text-xs text-slate-600 bg-white p-2.5 rounded-lg border border-slate-100">
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold uppercase">Armada</p>
                        <p class="font-bold text-slate-800 flex items-center gap-1 mt-0.5">
                            <i data-lucide="truck" class="w-3.5 h-3.5 text-slate-500"></i>
                            {{ $shipment->armada->nama_armada ?? 'Truk Box BPBD' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold uppercase">Driver / No.Pol</p>
                        <p class="font-bold text-slate-800 mt-0.5">
                            {{ $shipment->armada->plat_nomor ?? 'AB 8012 YX' }}
                        </p>
                    </div>
                </div>

                <!-- Tombol Interaktif ke Peta dengan 6 Parameter Presisi -->
                <button type="button"
                        onclick="drawDeliveryRoute({{ $latAsal }}, {{ $longAsal }}, {{ $latTujuan }}, {{ $longTujuan }}, '{{ addslashes($namaPoskoAsal) }}', '{{ addslashes($namaPoskoTujuan) }}')"
                        class="w-full flex items-center justify-center gap-1.5 text-xs font-semibold bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white py-2 px-3 rounded-lg border border-blue-200 transition-colors cursor-pointer">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                    Tampilkan Rute Presisi di Peta
                </button>
            </div>
        @empty
            <div class="py-12 text-center text-slate-400 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                <i data-lucide="truck" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                <p class="text-xs font-semibold">Belum ada pengiriman logistik dalam perjalanan.</p>
            </div>
        @endforelse
    </div>
</div>