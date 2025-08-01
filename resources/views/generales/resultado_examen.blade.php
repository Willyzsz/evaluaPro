{{-- resources/views/dashboard/preguntas/index.blade.php --}}
<x-welcome-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-black drop-shadow-lg">Preguntas del Examen: {{ $examen->nombre_examen }}</h1>
            <span class="text-lg font-semibold text-yellow-200 bg-blue-900/60 px-4 py-1 rounded-lg ml-4">
                Total puntos: {{ $totalPuntos }}
            </span>
        </div>
        @if(is_null($examenRealizado->usuarioCalificador))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
                <p><strong>Este examen aún está pendiente de calificación.</strong></p>
                <p>Algunas respuestas abiertas no han sido evaluadas todavía.</p>
            </div>
        @else
        <span class="text-lg font-semibold text-black-200 bg-blue-900/60 px-4 py-1 rounded-lg ml-4">
            Calificacion del usuario: {{$examenRealizado->calificacion}}
        </span>
        @endif

        <x-success-message />
        <x-error-message />

        <!-- Lista de Preguntas -->
        <div class="space-y-4">
            @forelse($preguntas as $pregunta)
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                            @php
                                $colorClass = 'bg-purple-100 text-purple-800';
                                if ($pregunta->tipo === 'opcion_multiple') {
                                    $colorClass = 'bg-blue-100 text-blue-800';
                                } elseif ($pregunta->tipo === 'verdadero_falso') {
                                    $colorClass = 'bg-green-100 text-green-800';
                                }
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
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

                            <div class="mt-3">
                                <h4 class="text-sm font-medium text-gray-700 mb-1">Respuesta Usuario:</h4>
                                <p class="text-sm text-black-600 font-medium">
                                    {{ optional($respuestasUsuario->firstWhere('pregunta_id', $pregunta->idPregunta))->respuesta ?? 'Sin respuesta' }}
                                </p>

                                @php
                                    $respuesta = $respuestasUsuario->firstWhere('pregunta_id', $pregunta->idPregunta);
                                @endphp

                                @if($respuesta)
                                    @if(!is_null($respuesta->correcta))
                                        @if($respuesta->correcta == 1)
                                            <p class="text-sm text-green-600 font-medium">Correcta</p>
                                        @elseif(is_null($examenRealizado->calificacion) && is_null($examenRealizado->usuarioCalificador))
                                            <p class="text-sm text-yellow-600 font-medium">Aún no calificada</p>
                                        @elseif($examenRealizado->calificacion && $examenRealizado->usuarioCalificador)
                                        @else
                                            <p class="text-sm text-red-600 font-medium">Incorrecta</p>
                                        @endif
                                    @else
                                        <p class="text-sm text-yellow-600 font-medium">Aún no calificada</p>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-600 font-medium">Sin respuesta</p>
                                @endif
                                                    
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-gray-500 text-center py-8">
                    No hay preguntas para este examen.
                </div>
            @endforelse
        </div>
        
        <!-- Botón Volver -->
        <div class="mt-8">
            <a href="/resultados_usuario" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver al examen
            </a>
        </div>
    </div>
</x-welcome-layout> 