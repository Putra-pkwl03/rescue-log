@props([
    'title' => '',
    'value' => 0,
    'icon' => 'bi bi-box',
    'color' => 'blue', // Opsi warna: blue, emerald, amber, rose, indigo, purple
])

@php
    // Mapping warna dinamis agar aman digunakan di Tailwind CSS
    $colorClasses = [
        'blue'    => 'bg-blue-50 text-blue-600 border-blue-100',
        'emerald' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
        'amber'   => 'bg-amber-50 text-amber-600 border-amber-100',
        'rose'    => 'bg-rose-50 text-rose-600 border-rose-100',
        'indigo'  => 'bg-indigo-50 text-indigo-600 border-indigo-100',
        'purple'  => 'bg-purple-50 text-purple-600 border-purple-100',
    ];

    $selectedColor = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-200 flex items-center justify-between">
    <div class="space-y-1">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ $title }}</p>
        <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">{{ number_format($value) }}</h3>
    </div>
    
    <div class="w-12 h-12 rounded-2xl border flex items-center justify-center shrink-0 {{ $selectedColor }}">
        <i class="{{ $icon }} text-xl"></i>
    </div>
</div>