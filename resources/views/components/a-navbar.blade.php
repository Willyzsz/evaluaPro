@props(['href', 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' =>
       'text-white hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium transition' .
       ($active ? ' font-semibold underline text-blue-700' : '')
   ]) }}>
    {{ $slot }}
</a>
