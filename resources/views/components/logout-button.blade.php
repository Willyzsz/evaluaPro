{{-- resources/views/components/logout-button.blade.php --}}
@props(['variant' => 'filled'])

<form method="POST" action="{{ route('logout') }}">
  @csrf
  <button
    type="submit"
    class="flex items-center gap-2 dark:text-red-400 dark:hover:text-red-600
    {{ $variant === 'filled'
      ? 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg'
      : 'text-red-600 hover:text-red-700  font-medium text-sm px-3 py-2 rounded-md' }}"
  >
    <i data-feather="log-out" class="w-4 h-4"></i>
    Cerrar Sesión
  </button>
</form>
