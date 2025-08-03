{{-- resources/views/dashboard/preguntas/index.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Preguntas del Examen: {{ $examen->nombre_examen }}</h1>
            <span class="text-lg font-semibold text-blue-200 bg-blue-900/60 px-4 py-1 rounded-lg ml-4">
                Total puntos: {{ $totalPuntos }}
            </span>
            <a href="{{ route('preguntas.create', $examen) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                <i data-feather="plus" class="mr-2 w-5 h-5"></i> Crear nueva pregunta
            </a>
        </div>
        
        <x-success-message />
        <x-error-message />

        <!-- Lista de Preguntas -->
        <div class="space-y-4">
            @forelse($preguntas as $pregunta)
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($pregunta->tipo === 'opcion_multiple') bg-blue-100 text-blue-800
                                    @elseif($pregunta->tipo === 'verdadero_falso') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $pregunta->tipo)) }}
                                </span>
                                <span class="text-sm text-gray-500">Pregunta #{{ $loop->iteration }}</span>
                            </div>
                            
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $pregunta->texto }}</h3>
                            
                            @php
                                $opciones = json_decode($pregunta->opciones, true);
                            @endphp

                            @if (is_array($opciones))
                                <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
                                    @foreach ($opciones as $clave => $valor)
                                        <li><strong>{{ $clave }})</strong> {{ $valor }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-sm text-gray-600">
                                    {!! nl2br(e($pregunta->opciones)) !!}
                                </div>
                            @endif
                            
                            @if ($pregunta->tipo !== 'abierta')
                            <div class="mt-3">
                                <h4 class="text-sm font-medium text-gray-700 mb-1">Respuesta correcta:</h4>
                                <p class="text-sm text-green-600 font-medium">{{ $pregunta->respuesta_correcta }}</p>
                            </div>
                            @endif

                            @if($pregunta->imagen)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $pregunta->imagen) }}" alt="Imagen de la pregunta" class="w-48 mt-2 rounded-md">
                                </div>
                            @endif
                            <div class="mt-3">
                                <h4 class="text-sm font-medium text-gray-700 mb-1">Valor:</h4>
                                <p class="text-sm text-green-600 font-medium">{{ $pregunta->puntos }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 ml-4">
                            <a href="{{ route('preguntas.edit', [$examen, $pregunta]) }}" 
                               class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                                <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                                Editar
                            </a>
                            
                            <form action="{{ route('preguntas.destroy', [$examen, $pregunta]) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta pregunta?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow rounded-xl p-8 text-center">
                    <div class="text-gray-500 mb-4">
                        <i data-feather="help-circle" class="w-16 h-16 mx-auto text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay preguntas registradas</h3>
                    <p class="text-gray-500 mb-4">Comienza creando la primera pregunta para este examen.</p>
                    <a href="{{ route('preguntas.create', $examen) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                        <i data-feather="plus" class="mr-2 w-5 h-5"></i> Crear primera pregunta
                    </a>
                </div>
            @endforelse
        </div>
        
        <!-- Botón Volver -->
        <div class="mt-8">
            <a href="{{ route('examenes.show', $examen) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver al examen
            </a>
        </div>
    </div>
</x-dashboard-layout> 