<nav class="bg-white shadow dark:bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <div class="flex items-center space-x-8">
        <a href="{{ url('/dashboard') }}" class="flex items-center text-xl font-bold text-blue-700 dark:text-white">
          DashBoard
        </a>
        <x-a-navbar href="{{ url('/admin/usuarios') }}">Ver Usuarios</x-a-navbar>
        <x-a-navbar href="{{ url('/admin/reportes') }}">Ver Reportes</x-a-navbar>
        <x-a-navbar href="{{ url('/') }}">Página Principal</x-a-navbar>
      </div>
      <div class="flex items-center">
        <x-logout-button variant="minimalist">
</x-logout-button>
      </div>
    </div>
  </div>
</nav>
