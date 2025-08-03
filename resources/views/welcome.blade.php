<x-welcome-layout>
      <!-- Contenido principal -->
      <main class="flex-1 p-10">
        <header class="flex justify-between items-center mb-10">
          <h2 class="text-3xl font-bold text-gray-800">
            Bienvenido, {{ $usuario->usuario }}
          </h2>
        </header>

        <!-- Próximo Examen -->
        <section class="mb-8">
          <div
            class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-cyan-500"
          >
            <h3 class="text-xl font-semibold text-gray-800 mb-1">
              📅 Próximo examen
            </h3>
            @if($primerExamen)
            <p class="text-gray-700">
              Título: <strong>{{$primerExamen->nombre_examen}}</strong>
            </p>
            @else
            <p class="text-gray-700">
              No tienes exámenes pendientes.
            </p>
            @endif
          </div>
        </section>

        <!-- Estadísticas -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div
          class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-green-500"
          >
          <h4 class="text-lg font-semibold text-green-700 mb-2">
            📁 Historial de exámenes
          </h4>
          @foreach($examenesRealizados as $examenRealizado)
            <ul class="list-disc list-inside text-gray-700">
             <li>
                {{ $examenRealizado->examen->nombre_examen }} 
                @if($examenRealizado->calificacion)
                    - Calificación: {{ $examenRealizado->calificacion }}
                @endif
              </li>
            </ul>
          </div>
          @endforeach
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
              Nombre del puesto: <strong>{{$infoPuesto->nombre_puesto}} </strong>
            </p>
            <p class="text-gray-600 mt-2">
              Descripción de puesto: {{$infoPuesto->descripcion_puesto ? $infoPuesto->descripcion_puesto : 'No hay descripcion de puesto' }} 
            </p>
            <p class="text-gray-600 mt-2">
              Descripcion de departamento: {{$infoPuesto->departamento->descripcion_departamento ? $infoPuesto->descripcion_puesto : 'No hay descripcion de departamento' }}
            </p>
            <p class="text-gray-500 mt-2">Departamento:{{$infoPuesto->departamento->nombre_departamento}}</p>
          </div>
        </section>
      </main>
</x-welcome-layout>