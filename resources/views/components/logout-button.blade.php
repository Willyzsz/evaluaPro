{{-- resources/views/components/logout-button.blade.php --}}
@props(['variant' => 'filled'])

<form method="POST" action="{{ route('logout') }}">
  @csrf
  <button
    type="submit"
    class="{{ $variant === 'filled'
      ? 'flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white dark:text-red-400 dark:hover:text-red-600 px-4 py-2 rounded-lg'
      : 'flex items-center gap-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600 font-medium text-sm px-3 py-2 rounded-md' }}"
  >
    <i data-feather="log-out" class="w-4 h-4"></i>
    Cerrar Sesión
  </button>
</form>
