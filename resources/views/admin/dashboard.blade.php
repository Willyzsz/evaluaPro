{{-- resources/views/admin/dashboard.blade.php --}}
<x-gradient-layout>
  <!-- DASHBOARD ADMINISTRADOR -->
  <div id="adminDashboard" class="w-full max-w-7xl mx-auto p-6 text-white">
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
      <div>
        <h1 class="text-2xl font-bold" id="adminWelcome">Bienvenido, Administrador</h1>
        <p class="text-blue-200">Panel de control - Resumen del sistema</p>
      </div>
      <x-logout-button/>
    </header>

    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <!-- Card 1 -->
      <div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 border-blue-500">
        <div class="flex items-center gap-3 mb-3">
          <div class="bg-blue-100 p-2 rounded-lg">
            <i data-feather="file-text" class="text-blue-600 w-5 h-5"></i>
          </div>
          <h2 class="font-bold text-lg text-gray-800">Gestión de Exámenes</h2>
        </div>
        <p class="text-gray-600 text-sm">Crear, editar y revisar exámenes para los empleados.</p>
        <a href="admin_examenes" class="mt-4 text-blue-600 text-sm font-medium hover:underline inline-block">
            Ver exámenes →
        </a>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 border-green-500">
        <div class="flex items-center gap-3 mb-3">
          <div class="bg-green-100 p-2 rounded-lg">
            <i data-feather="users" class="text-green-600 w-5 h-5"></i>
          </div>
          <h2 class="font-bold text-lg text-gray-800">Gestión de Usuarios</h2>
        </div>
        <p class="text-gray-600 text-sm">Administrar empleados registrados y sus permisos.</p>
        <a href="admin_usuarios" class="mt-4 text-green-600 text-sm font-medium hover:underline inline-block">Ver usuarios →</a>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 border-purple-500">
        <div class="flex items-center gap-3 mb-3">
          <div class="bg-purple-100 p-2 rounded-lg">
            <i data-feather="bar-chart-2" class="text-purple-600 w-5 h-5"></i>
          </div>
          <h2 class="font-bold text-lg text-gray-800">Reportes y Estadísticas</h2>
        </div>
        <p class="text-gray-600 text-sm">Generar reportes detallados y visualizar métricas.</p>
        <a href="admin_reportes" class="mt-7 text-purple-600 text-sm font-medium hover:underline inline-block">Ver reportes →</a>
      </div>
    </div>
  </div>
</x-gradient-layout>