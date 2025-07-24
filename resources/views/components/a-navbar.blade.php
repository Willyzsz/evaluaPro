@props(['href', 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' =>
       'text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium transition' .
       ($active ? ' font-semibold underline text-blue-700' : '')
   ]) }}>
    {{ $slot }}
</a>
