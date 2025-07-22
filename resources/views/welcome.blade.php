<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EvaluaPro - Plataforma de Exámenes</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body class="bg-gradient-to-br from-blue-50 to-cyan-100 min-h-screen font-sans" >

    <a href="/login">Login</a>

    <div class="flex min-h-screen">
      <!-- Menú lateral -->
      <aside class="w-64 bg-white shadow-xl p-6 flex flex-col justify-between">
        <div>
          <h1 class="text-2xl font-bold text-cyan-600 mb-8">📘 EvaluaPro</h1>
          <nav class="space-y-4">
            <a
              href="#"
              class="flex items-center text-gray-700 hover:text-cyan-600 transition"
            >
              <i data-feather="home" class="mr-2"></i> Dashboard
            </a>
            <a
              href="#"
              class="flex items-center text-gray-700 hover:text-cyan-600 transition"
            >
              <i data-feather="file-text" class="mr-2"></i> Exámenes
            </a>
            <a
              href="#"
              class="flex items-center text-gray-700 hover:text-cyan-600 transition"
            >
              <i data-feather="bar-chart-2" class="mr-2"></i> Resultados
            </a>
            <a
              href="#"
              class="flex items-center text-gray-700 hover:text-cyan-600 transition"
            >
              <i data-feather="settings" class="mr-2"></i> Configuración
            </a>
          </nav>
        </div>
        <div class="text-sm text-gray-400">&copy; 2025 EvaluaPro</div>
      </aside>

      <!-- Contenido principal -->
      <main class="flex-1 p-10">
        <header class="flex justify-between items-center mb-10">
          <h2 class="text-3xl font-bold text-gray-800">
            Bienvenido, Juan Pérez
          </h2>
          <span class="text-gray-500">Mi perfil</span>
          
          <div class="bg-white text-pink-800 p-4 rounded-xl shadow-md">
            <h2 class="font-bold text-lg">🚀 Perfil Selectivo</h2>
            <p>Opciones de crecimiento profesional.</p>
          </div>

          <div class="bg-white text-pink-800 p-4 rounded-xl shadow-md">
            <h2 class="font-bold text-lg">📌 Perfil Puesto Actual</h2>
            <p>Rol actual y responsabilidades.</p>
          </div>

        </header>

        <!-- Próximo Examen -->
        <section class="mb-8">
          <div
            class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-cyan-500"
          >
            <h3 class="text-xl font-semibold text-gray-800 mb-1">
              📅 Próximo examen
            </h3>
            <p class="text-gray-700">
              Título: <strong>Seguridad Industrial</strong>
            </p>
            <p class="text-gray-500">Fecha: 20 de mayo de 2025</p>
          </div>
        </section>

        <!-- Estadísticas -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div
            class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-blue-500"
          >
            <h4 class="text-lg font-semibold text-blue-700 mb-2">
              📊 Porcentaje de habilidades obtenidas
            </h4>
            <p class="text-gray-600">
              Último promedio:
              <span class="text-xl font-bold text-blue-600">85%</span>
            </p>
          </div>

          <div
            class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-green-500"
          >
            <h4 class="text-lg font-semibold text-green-700 mb-2">
              📁 Historial de exámenes
            </h4>
            <ul class="list-disc list-inside text-gray-700">
              <li>Introducción a la Empresa (92%)</li>
              <li>Ética Laboral (87%)</li>
            </ul>
          </div>
        </section>

        <!-- Perfil de Puestos -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          <div
            class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-purple-500"
          >
            <h4 class="text-lg font-semibold text-purple-700 mb-2">
              🧩 Perfil de puesto actual
            </h4>
            <p class="text-gray-700">
              Nombre del puesto: <strong>Operador de Producción</strong>
            </p>
            <p class="text-gray-600 mt-2">
              Descripción: Realiza tareas operativas en línea de ensamblaje y
              asegura el cumplimiento de los estándares de calidad.
            </p>
            <p class="text-gray-500 mt-2">Área: Manufactura</p>
          </div>

          <div
            class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-pink-500"
          >
            <h4 class="text-lg font-semibold text-pink-700 mb-2">
              🎯 Perfil de puesto selectivo
            </h4>
            <p class="text-gray-700">
              Nombre del puesto: <strong>Supervisor de Calidad</strong>
            </p>
            <p class="text-gray-600 mt-2">
              Descripción: Responsable de supervisar los procesos de control de
              calidad y coordinar auditorías internas.
            </p>
            <p class="text-gray-500 mt-2">Área: Aseguramiento de Calidad</p>
          </div>
        </section>
      </main>
    </div>

    <script>
      feather.replace();
    </script>
  </body>
</html>