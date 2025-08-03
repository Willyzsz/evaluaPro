{{-- resources/views/components/welcome-button.blade.php --}}
@props(['variant' => 'filled'])

<a
  href="{{ url('/welcome') }}"
  class="flex items-center gap-2 px-5 py-2 rounded-lg font-semibold text-white transition-all duration-300 ease-in-out
    {{ $variant === 'filled'
      ? 'bg-gradient-to-r from-blue-900 via-black to-blue-800 hover:-translate-y-1 hover:shadow-lg'
      : 'text-blue-100 hover:text-white' }}"
>
  <i data-feather="home" class="w-5 h-5"></i>
  Página principal
</a>
