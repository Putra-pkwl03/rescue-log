@props(['pengirimans'])

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
        Status Pengiriman Logistik dari Posko Komando
    </h3>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    <th class="py-3 px-4">ID Pengajuan</th>
                    <th class="py-3 px-4">Item Dikirim</th>
                    <th class="py-3 px-4">Status Distribusi</th>
                    <th class="py-3 px-4">Estimasi / Waktu Sampai</th>
                    <th class="py-3 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($pengirimans as $item)
                    @php
                        $p = $item->pengajuan;
                        $details = [];
                        if($p) {
                            if($p->beras_kg > 0) $details[] = ['nama' => 'Beras', 'jumlah' => $p->beras_kg . ' Kg', 'kategori' => 'Makanan Pokok'];
                            if($p->air_minum_dus > 0) $details[] = ['nama' => 'Air Minum', 'jumlah' => $p->air_minum_dus . ' Dus', 'kategori' => 'Konsumsi'];
                            if($p->makanan_kaleng_pack > 0) $details[] = ['nama' => 'Makanan Kaleng', 'jumlah' => $p->makanan_kaleng_pack . ' Pack', 'kategori' => 'Makanan Cepat Saji'];
                            if($p->makanan_bayi_pack > 0) $details[] = ['nama' => 'Makanan Bayi', 'jumlah' => $p->makanan_bayi_pack . ' Pack', 'kategori' => 'Nutrisi Bayi'];
                            if($p->minyak_goreng_liter > 0) $details[] = ['nama' => 'Minyak Goreng', 'jumlah' => $p->minyak_goreng_liter . ' Liter', 'kategori' => 'Bahan Pokok'];
                            if($p->popok_bayi_pcs > 0) $details[] = ['nama' => 'Popok Bayi', 'jumlah' => $p->popok_bayi_pcs . ' Pcs', 'kategori' => 'Kebutuhan Bayi'];
                            if($p->popok_dewasa_pcs > 0) $details[] = ['nama' => 'Popok Dewasa', 'jumlah' => $p->popok_dewasa_pcs . ' Pcs', 'kategori' => 'Sanitasi'];
                            if($p->pembalut_wanita_pack > 0) $details[] = ['nama' => 'Pembalut Wanita', 'jumlah' => $p->pembalut_wanita_pack . ' Pack', 'kategori' => 'Sanitasi'];
                            if($p->hygiene_kit_paket > 0) $details[] = ['nama' => 'Hygiene Kit', 'jumlah' => $p->hygiene_kit_paket . ' Paket', 'kategori' => 'Kebersihan'];
                            if($p->selimut_pcs > 0) $details[] = ['nama' => 'Selimut', 'jumlah' => $p->selimut_pcs . ' Pcs', 'kategori' => 'Perlengkapan'];
                            if($p->matras_terpal_pcs > 0) $details[] = ['nama' => 'Matras / Terpal', 'jumlah' => $p->matras_terpal_pcs . ' Pcs', 'kategori' => 'Tenda/Perlengkapan'];
                            if($p->obat_p3k_paket > 0) $details[] = ['nama' => 'Obat-obatan / P3K', 'jumlah' => $p->obat_p3k_paket . ' Paket', 'kategori' => 'Kesehatan'];
                        }

                        $statusDistribusi = strtolower($item->status_distribusi ?? '');
                        $statusPengajuan = strtolower($p->status ?? '');

                        // Penentuan flag status
                        $isSelesai = in_array($statusDistribusi, ['selesai', 'diterima di posko']) || $statusPengajuan == 'selesai';
                        $isDalamPengiriman = in_array($statusDistribusi, ['dalam_pengiriman', 'dalam_perjalanan']) || $statusPengajuan == 'dalam_pengiriman';
                        $isDisetujui = in_array($statusPengajuan, ['disetujui', 'disetujui_sebagian']) && !$isDalamPengiriman && !$isSelesai;
                    @endphp

                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-3.5 px-4 font-bold text-gray-900">
                            #{{ $p->kode_pengajuan ?? 'REQ-' . $item->id }}
                        </td>

                        <td class="py-3.5 px-4 max-w-xs">
                            <div class="truncate text-gray-800 font-medium">
                                @if(count($details) > 0)
                                    {{ implode(', ', array_map(fn($d) => $d['nama'] . ' (' . $d['jumlah'] . ')', array_slice($details, 0, 3))) }}
                                    @if(count($details) > 3) <span class="text-xs text-blue-600 font-bold">+{{ count($details) - 3 }} barang lagi</span> @endif
                                @else
                                    Logistik Bantuan Bencana
                                @endif
                            </div>
                        </td>

                        <td class="py-3.5 px-4">
                            @if($isSelesai)
                                <span class="px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-full inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Diterima di Posko
                                </span>
                            @elseif($isDalamPengiriman)
                                <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                    Dalam Pengiriman
                                </span>
                            @elseif($isDisetujui)
                                <span class="px-3 py-1 text-xs font-semibold bg-amber-100 text-amber-700 rounded-full inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Disetujui (Menunggu Armada)
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded-full inline-flex items-center gap-1.5">
                                    {{ ucfirst(str_replace('_', ' ', $item->status_distribusi)) }}
                                </span>
                            @endif
                        </td>

                        <td class="py-3.5 px-4 text-gray-600">
                            @if($item->waktu_diterima)
                                <span class="text-emerald-700 font-medium">{{ \Carbon\Carbon::parse($item->waktu_diterima)->format('d M Y, H:i') }} WIB</span>
                            @elseif($isDalamPengiriman)
                                <span class="text-blue-700 font-medium">{{ $item->estimasi_waktu ?? 'Dalam Perjalanan' }}</span>
                            @else
                                <span class="text-gray-400 italic">Menunggu Pengiriman</span>
                            @endif
                        </td>

                        <td class="py-3.5 px-4 text-right">
                            @if($isDalamPengiriman)
                                <button 
                                    type="button" 
                                    onclick="openDetailModal('{{ $p->kode_pengajuan ?? 'REQ-' . $item->id }}', '{{ route('lapangan.stok.konfirmasi', $item->id) }}', {{ json_encode($details) }}, '{{ $item->status_distribusi }}', '{{ $p->catatan_komando ?? '' }}')" 
                                    class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Konfirmasi Sampai
                                </button>
                            @else
                                <button 
                                    type="button" 
                                    onclick="openDetailModal('{{ $p->kode_pengajuan ?? 'REQ-' . $item->id }}', null, {{ json_encode($details) }}, '{{ $item->status_distribusi }}', '{{ $p->catatan_komando ?? '' }}')" 
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-semibold transition cursor-pointer">
                                    Lihat Detail
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400 text-xs font-medium">
                            Belum ada pengiriman logistik aktif dari Posko Komando.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>