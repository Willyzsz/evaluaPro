{{-- resources/views/dashboard/preguntas/index.blade.php --}}
<x-welcome-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-black drop-shadow-lg">Preguntas del Examen: {{ $examen->nombre_examen }}</h1>
            <span class="text-lg font-semibold text-blue-200 bg-blue-900/60 px-4 py-1 rounded-lg ml-4">
                Total puntos: {{ $totalPuntos }}
            </span>
        </div>
        

        <!-- Lista de Preguntas -->
        <form action="/respuesta_examen/{{ $examen->idExamen }}" method="POST">
        @csrf
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

                                    <div class="ml-auto text-right">
                                        <h4 class="text-sm font-medium text-gray-700 mb-1">Valor:</h4>
                                        <p class="text-sm text-green-600 font-medium">{{ $pregunta->puntos }}</p>
                                    </div>
                                </div>

                                
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $pregunta->texto }}</h3>
                                @if($pregunta->imagen)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $pregunta->imagen) }}" alt="Imagen de la pregunta" class="w-48 mt-2 rounded-md">
                                    </div>
                                @endif
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
                                <br>
                                <!-- Respuesta -->
                                <div id="respuesta-container">
                                    <x-input-label for="respuesta_{{ $pregunta->idPregunta }}" value="Respuesta" />
                                    @if($pregunta->tipo === 'opcion_multiple')
                                        @foreach(['A','B','C','D'] as $opc)
                                        <label class="inline-flex items-center mr-4">
                                            <input type="radio"
                                                name="respuestas[{{ $pregunta->idPregunta }}]"
                                                value="{{ $opc }}"
                                                {{ old('respuestas.'.$pregunta->idPregunta) === $opc ? 'checked' : '' }}>
                                            <span class="ml-1">{{ $opc }}) {{ $opciones[$opc] ?? '' }}</span>
                                        </label>
                                        @endforeach
                                    @elseif($pregunta->tipo === 'verdadero_falso')
                                        @foreach(['Verdadero','Falso'] as $opc)
                                        <label class="inline-flex items-center mr-4">
                                            <input type="radio"
                                                name="respuestas[{{ $pregunta->idPregunta }}]"
                                                value="{{ $opc }}"
                                                {{ old('respuestas.'.$pregunta->idPregunta) === $opc ? 'checked' : '' }}>
                                            <span class="ml-1">{{ $opc }} {{ $opciones[$opc] ?? '' }}</span>
                                        </label>
                                        @endforeach
                                    @else
                                    <x-text-input 
                                        id="respuesta_{{ $pregunta->idPregunta }}" 
                                        name="respuestas[{{ $pregunta->idPregunta }}]" 
                                        type="text" 
                                        class="mt-1 block w-full" 
                                        value="{{ old('respuesta.$pregunta->idPregunta') }}" 
                                        placeholder="Escribe la respuesta correcta..."
                                        required 
                                    />
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span id="respuesta-hint">Para opción múltiple, escribe la letra (A, B, C, D). Para verdadero/falso, escribe "Verdadero" o "Falso".</span>
                                    </p>
                                    @endif
                                    <x-input-error :messages="$errors->get('respuestas{{ $pregunta->idPregunta }}')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white shadow rounded-xl p-8 text-center">
                        <div class="text-gray-500 mb-4">
                            <i data-feather="help-circle" class="w-16 h-16 mx-auto text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay preguntas registradas</h3>
                    </div>
                @endforelse
            </div>
            <!-- Botón Enviar -->
            <div class="mt-8 text-right">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-gray-700 transition">
                    <i data-feather="arrow-right" class="mr-2 w-5 h-5"></i> Enviar
                </button>
            </div>
        </form>    
    </div>
</x-welcome-layout> 