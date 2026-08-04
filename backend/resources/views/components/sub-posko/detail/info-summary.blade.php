@props(['subPosko'])

<div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
    <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Ringkasan Posko</h3>
    <div class="grid grid-cols-2 gap-3">
       <div class="bg-indigo-50/50 p-3 rounded-xl border border-indigo-100/60 text-center">
    <span class="text-xl font-bold text-indigo-700 block">{{ $subPosko->jumlah_petugas ?? 0 }}</span>
    <span class="text-[11px] text-indigo-600 font-medium">Petugas Aktif</span>
</div>
        <div class="bg-emerald-50/50 p-3 rounded-xl border border-emerald-100/60 text-center">
            <span class="text-xl font-bold text-emerald-700 block">{{ $subPosko->kapasitas_maksimal ?? 0 }}</span>
            <span class="text-[11px] text-emerald-600 font-medium">Kapasitas Maksimal</span>
        </div>
    </div>

    <div class="space-y-1">
        <span class="text-xs font-semibold text-slate-700">Deskripsi</span>
        <p class="text-xs text-slate-500 leading-relaxed">
            {{ $subPosko->keterangan ?? 'Posko lapangan didirikan sebagai pusat koordinasi penanganan bencana di area sekitar lokasi terdaftar.' }}
        </p>
    </div>

    <div class="pt-3 border-t border-slate-100 space-y-2">
        <span class="text-xs font-semibold text-slate-700 block">Kontak Posko</span>
        <div class="flex items-center justify-between text-xs">
            <span class="text-slate-500">Penanggung Jawab</span>
            <span class="font-medium text-slate-800">{{ $subPosko->penanggung_jawab }}</span>
        </div>
        <div class="flex items-center justify-between text-xs">
            <span class="text-slate-500">Nomor Telepon</span>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $subPosko->kontak_hp) }}" target="_blank" class="font-medium text-indigo-600 hover:underline flex items-center gap-1">
                {{ $subPosko->kontak_hp ?? '-' }}
            </a>
        </div>
    </div>
</div>