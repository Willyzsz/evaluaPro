@props([
    'type' => 'submit',
    'icon' => null,
])

<button {{ $attributes->merge([
    'type' => $type,
    'class' => 'w-full flex items-center justify-center gap-2 bg-blue-600 text-white font-medium py-3 rounded-lg hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600'
]) }}>
    {{ $slot }}
    @if ($icon)
        <i data-feather="{{ $icon }}" class="w-5 h-5"></i>
    @endif
</button>
