<x-welcome-layout>
      <!-- Contenido principal -->
      <main class="flex-1 p-10">
        <header class="flex justify-between items-center mb-10">
          <h2 class="text-3xl font-bold text-gray-800">
            Bienvenido, {{ $usuario->usuario }}
          </h2>
          
          <div class="bg-white text-pink-800 p-4 rounded-xl shadow-md">
            <h2 class="font-bold text-lg">👤 Perfil </h2>
            <p>Informacion de perfil.</p>
          </div>          

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
</x-welcome-layout>