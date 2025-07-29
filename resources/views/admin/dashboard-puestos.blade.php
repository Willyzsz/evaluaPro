{{-- resources/views/dashboard.blade.php --}}
<x-dashboard-layout>
  <!-- DASHBOARD ADMINISTRADOR -->
  <div class="flex items-start justify-center min-h-screen pt-32">
      <div class="w-full max-w-7xl mx-auto p-6 text-white ">
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
      <div>
        <h1 class="text-2xl font-bold">Gestion de Puestos, Departamentos y Direcciones</h1>
    </header>

    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <!-- Card 1 - Gestión de Exámenes (Admin & Capacitador) -->
      <x-card-dashboard 
        color="blue"
        icon="briefcase"
        title="Puestos"
        description="Crear, editar y revisar puestos para los empleados."
        link="{{ route('puestos.index') }}"
        linkLabel="Ver Puestos →"
      />

      <!-- Card 5 - Reportes y Estadísticas (Admin & Capacitador) -->
      <x-card-dashboard 
        color="purple"
        icon="octagon"        
        title="Departamentos"
        description="Crear, editar y revisar departamentos para los empleados."
        link="{{ route('departamentos.index') }}"
        linkLabel="Ver departamentos →"
      />
        <!-- Card 5 - Reportes y Estadísticas (Admin & Capacitador) -->
        <x-card-dashboard 
        color="red"
        icon="trello"        
        title="Direcciones"
        description="Crear, editar y revisar direcciones para los empleados."
        link="{{ route('direcciones.index') }}"
        linkLabel="Ver direcciones →"
      />
    </div>
  </div>
  </div>
</x-dashboard-layout>