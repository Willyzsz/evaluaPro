@props(['color', 'icon', 'title', 'description', 'link', 'linkLabel'])

@php
    $borderColor = 'border-' . $color . '-500';
    $iconBg = 'bg-' . $color . '-100';
    $iconColor = 'text-' . $color . '-600';
    $linkColor = 'text-' . $color . '-600';
@endphp

<div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 {{ $borderColor }}">
    <div class="flex items-center gap-3 mb-3">
        <div class="{{ $iconBg }} p-2 rounded-lg">
            <i data-feather="{{ $icon }}" class="{{ $iconColor }} w-5 h-5"></i>
        </div>
        <h2 class="font-bold text-lg text-gray-800">{{ $title }}</h2>
    </div>
    <p class="text-gray-600 text-sm">{{ $description }}</p>
    <a href="{{ $link }}" class="mt-4 {{ $linkColor }} text-sm font-medium hover:underline inline-block">
        {{ $linkLabel }}
    </a>
</div>
