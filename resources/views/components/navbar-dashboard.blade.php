<nav class="bg-gradient-to-r from-blue-900 via-black to-blue-900 shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <div class="flex items-center space-x-8">
        <a href="{{ url('/dashboard') }}" class="flex items-center text-xl font-bold text-white">
          Dashboard
        </a>
        <x-a-navbar href="{{ url('/gestion_examenes') }}">Ver Examenes</x-a-navbar>
        @if(auth()->user()->rol_usuario === 'admin')
        <x-a-navbar href="{{ url('/gestion_usuarios') }}">Ver Usuarios</x-a-navbar>
        @endif
        <x-a-navbar href="{{ url('/gestion_temas') }}">Ver Temas</x-a-navbar>
        @if(auth()->user()->rol_usuario === 'admin')
        <x-a-navbar href="{{ url('/gestion_puestos') }}">Ver Puestos</x-a-navbar>
        @endif
        <x-a-navbar href="{{ url('/gestion_reportes') }}">Ver Reportes</x-a-navbar>
      </div>
      <div class="flex items-center">
        <x-welcome-button variant="minimalist" />
        <x-logout-button variant="minimalist" />
      </div>
    </div>
  </div>
</nav>