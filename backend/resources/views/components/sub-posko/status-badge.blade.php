@props(['status'])

@php
    $classes = match($status) {
        'aktif', 'disetujui'            => 'bg-emerald-100 text-emerald-700 border-emerald-200',
        'pending'                       => 'bg-amber-100 text-amber-700 border-amber-200',
        'disetujui_sebagian', 'penuh'   => 'bg-sky-100 text-sky-700 border-sky-200',
        'nonaktif', 'ditutup', 'ditolak'=> 'bg-rose-100 text-rose-700 border-rose-200',
        default                         => 'bg-gray-100 text-gray-700 border-gray-200',
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $classes }}">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>