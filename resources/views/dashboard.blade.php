{{-- resources/views/dashboard.blade.php --}}
<x-gradient-layout>
  <!-- DASHBOARD ADMINISTRADOR -->
  <div class="w-full max-w-7xl mx-auto p-6 text-white">
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
      <div>
        <h1 class="text-2xl font-bold">Bienvenido, {{ auth()->user()->usuario }}</h1>
        <p class="text-blue-200">
          @if(auth()->user()->rol_usuario === 'admin')
            Panel de control - Administrador
          @else
            Panel de control - Capacitador
          @endif
        </p>
      </div>
      <div class="flex items-center gap-2">
        <x-welcome-button/>
        <x-logout-button/>
      </div>
    </header>

    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <!-- Card 1 - Gestión de Exámenes (Admin & Capacitador) -->
      <x-card-dashboard 
        color="blue"
        icon="file-text"
        title="Gestión de Exámenes"
        description="Crear, editar y revisar exámenes para los empleados."
        link="/gestion_examenes"
        linkLabel="Ver exámenes →"
      />

      <!-- Card 2 - Gestión de Usuarios (Admin only) -->
      @if(auth()->user()->rol_usuario === 'admin')
      <x-card-dashboard 
        color="green"
        icon="users"        
        title="Gestión de Usuarios"
        description="Administrar empleados registrados y sus permisos."
        link="/gestion_usuarios"
        linkLabel="Ver usuarios →"
      />
      @endif

      <!-- Card 3 - Gestión de Temas (Admin & Capacitador) -->
      <x-card-dashboard 
        color="red"
        icon="book"        
        title="Gestión de Temas"
        description="Crear, editar y revisar Temas/Cursos"
        link="/gestion_temas"
        linkLabel="Ver Temas →"
      />
      
      <!-- Card 4 - Gestión de Puestos (Admin only) -->
      @if(auth()->user()->rol_usuario === 'admin')
      <x-card-dashboard 
        color="yellow"
        icon="briefcase"        
        title="Gestión de Puestos"
        description="Crear, editar, revisar y asignar Puestos, Departamentos y Direcciones"
        link="/gestion_puestos"
        linkLabel="Ver Puestos →"
      />
      @endif

      <!-- Card 5 - Reportes y Estadísticas (Admin & Capacitador) -->
      <x-card-dashboard 
        color="purple"
        icon="bar-chart-2"        
        title="Reticulas"
        description="Generar reticulas por puesto y departamento."
        link="/gestion_reticula"
        linkLabel="Ver reticulas →"
      />
    </div>
  </div>
</x-gradient-layout>