<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EvaluaPro - Plataforma de Evaluación</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .gradient-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #000000 50%, #1e40af 100%);
    }
  </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center font-sans text-gray-800">
  <!-- LOGIN CONTAINER -->
  <div id="loginBox" class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md mx-4">
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center bg-blue-100 p-4 rounded-full mb-4">
        <i data-feather="lock" class="text-blue-600 w-6 h-6"></i>
      </div>
      <h1 class="text-2xl font-bold text-gray-800">EvaluaPro</h1>
      <p class="text-gray-500 mt-1">Sistema de Evaluación de Personal</p>
    </div>

    <form id="loginForm" class="space-y-5" onsubmit="return login(event)">
      <div>
        <label for="usuario" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
        <input
          type="text"
          id="usuario"
          placeholder="Ingrese su usuario"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
        />
      </div>
      
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
        <input
          type="password"
          id="password"
          placeholder="Ingrese su contraseña"
          required
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
        />
      </div>

      <button
        type="submit"
        onclick="handleLogin()"
        class="w-full bg-blue-600 text-white font-medium py-3 rounded-lg hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
      >
        Iniciar sesión
      </button>
      
      <div class="text-center text-sm text-gray-500">
        ¿Problemas para ingresar? <a href="#" class="text-blue-600 hover:underline">Contactar soporte</a>
      </div>
    </form>

    <p id="loginMsg" class="text-center text-red-600 mt-4 text-sm hidden">
      Credenciales incorrectas. Por favor intente nuevamente.
    </p>
  </div>

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

  <script>
    feather.replace();
    
    function login(e) {
      e.preventDefault();
      // Simulate login
      document.getElementById('loginBox').classList.add('hidden');
      document.getElementById('adminDashboard').classList.remove('hidden');
      return false;
    }
    
    function cerrarSesion() {
      document.getElementById('adminDashboard').classList.add('hidden');
      document.getElementById('loginBox').classList.remove('hidden');
    }
  </script>
</body>
</html>