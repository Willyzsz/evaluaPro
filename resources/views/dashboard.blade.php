  <!-- DASHBOARD ADMINISTRADOR -->
  <div id="adminDashboard" class="hidden w-full max-w-7xl mx-auto p-6 text-white">
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
      <div>
        <h1 class="text-2xl font-bold" id="adminWelcome">Bienvenido, Administrador</h1>
        <p class="text-blue-200">Panel de control - Resumen del sistema</p>
      </div>
      <button
        onclick="cerrarSesion()"
        class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition"
      >
        <i data-feather="log-out" class="w-4 h-4"></i>
        Cerrar sesión
      </button>
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
        <button class="mt-4 text-blue-600 text-sm font-medium hover:underline">Ver exámenes →</button>
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
        <button class="mt-4 text-green-600 text-sm font-medium hover:underline">Ver usuarios →</button>
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
        <button class="mt-4 text-purple-600 text-sm font-medium hover:underline">Ver reportes →</button>
      </div>

      <!-- Card 4 -->
      <div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 border-yellow-500">
        <div class="flex items-center gap-3 mb-3">
          <div class="bg-yellow-100 p-2 rounded-lg">
            <i data-feather="briefcase" class="text-yellow-600 w-5 h-5"></i>
          </div>
          <h2 class="font-bold text-lg text-gray-800">Perfil de Puesto</h2>
        </div>
        <p class="text-gray-600 text-sm">Revisar las funciones y responsabilidades del rol actual.</p>
        <button class="mt-4 text-yellow-600 text-sm font-medium hover:underline">Ver perfil →</button>
      </div>

      <!-- Card 5 -->
      <div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 border-red-500">
        <div class="flex items-center gap-3 mb-3">
          <div class="bg-red-100 p-2 rounded-lg">
            <i data-feather="award" class="text-red-600 w-5 h-5"></i>
          </div>
          <h2 class="font-bold text-lg text-gray-800">Requisitos de Ascenso</h2>
        </div>
        <p class="text-gray-600 text-sm">Consultar los requisitos necesarios para promociones.</p>
        <button class="mt-4 text-red-600 text-sm font-medium hover:underline">Ver requisitos →</button>
      </div>

      <!-- Card 6 -->
      <div class="bg-white p-5 rounded-xl shadow-md card-hover border-l-4 border-indigo-500">
        <div class="flex items-center gap-3 mb-3">
          <div class="bg-indigo-100 p-2 rounded-lg">
            <i data-feather="trending-up" class="text-indigo-600 w-5 h-5"></i>
          </div>
          <h2 class="font-bold text-lg text-gray-800">Progreso de Habilidades</h2>
        </div>
        <div class="space-y-2">
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-indigo-600 h-2 rounded-full" style="width: 85%"></div>
          </div>
          <p class="text-gray-600 text-sm">Avance general: <span class="font-medium">85%</span></p>
          <p class="text-gray-600 text-xs">Próxima evaluación: 15/06/2025</p>
        </div>
      </div>
    </div>
  </div>
