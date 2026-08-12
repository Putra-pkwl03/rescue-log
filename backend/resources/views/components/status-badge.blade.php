@props(['status'])

@php
    $badges = [
        'pending' => [
            'label' => 'Pending',
            'class' => 'bg-amber-50 text-amber-600 border-amber-200/60',
            'dot' => 'bg-amber-400',
        ],
        'disetujui' => [
            'label' => 'Disetujui',
            'class' => 'bg-emerald-50 text-emerald-600 border-emerald-200/60',
            'dot' => 'bg-emerald-500',
        ],
        'disetujui_sebagian' => [
            'label' => 'Disetujui Sebagian',
            'class' => 'bg-blue-50 text-blue-600 border-blue-200/60',
            'dot' => 'bg-blue-500',
        ],
        'ditolak' => [
            'label' => 'Ditolak',
            'class' => 'bg-rose-50 text-rose-600 border-rose-200/60',
            'dot' => 'bg-rose-500',
        ],
    ];

    $config = $badges[$status] ?? [
        'label' => ucfirst($status),
        'class' => 'bg-slate-50 text-slate-600 border-slate-200',
        'dot' => 'bg-slate-400',
    ];
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $config['class'] }}">
    <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }}"></span>
    {{ $config['label'] }}
</span>