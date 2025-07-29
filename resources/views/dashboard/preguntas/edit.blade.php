{{-- resources/views/dashboard/preguntas/edit.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Editar Pregunta</h1>
            <a href="{{ route('preguntas.index', $examen) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('preguntas.update', [$examen, $pregunta]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Tipo de Pregunta -->
                    <div>
                        <x-input-label for="tipo" value="Tipo de Pregunta" />
                        <select id="tipo" name="tipo" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                            <option value="">Seleccionar tipo</option>
                            <option value="opcion_multiple" {{ old('tipo', $pregunta->tipo) == 'opcion_multiple' ? 'selected' : '' }}>Opción Múltiple</option>
                            <option value="verdadero_falso" {{ old('tipo', $pregunta->tipo) == 'verdadero_falso' ? 'selected' : '' }}>Verdadero/Falso</option>
                            <option value="abierta" {{ old('tipo', $pregunta->tipo) == 'abierta' ? 'selected' : '' }}>Pregunta Abierta</option>
                        </select>
                        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                    </div>

                    <!-- Texto de la Pregunta -->
                    <div>
                        <x-input-label for="texto" value="Texto de la Pregunta" />
                        <textarea id="texto" name="texto" rows="4" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Escribe aquí la pregunta..."
                            required>{{ old('texto', $pregunta->texto) }}</textarea>
                        <x-input-error :messages="$errors->get('texto')" class="mt-2" />
                    </div>

                    <!-- Opciones (condicional) -->
                    <div id="opciones-container" class="{{ $pregunta->tipo === 'opcion_multiple' ? '' : 'hidden' }}">
                        <x-input-label for="opciones" value="Opciones de Respuesta" />
                        <textarea id="opciones" name="opciones" rows="6" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Escribe cada opción en una línea separada...&#10;Ejemplo:&#10;A) Primera opción&#10;B) Segunda opción&#10;C) Tercera opción&#10;D) Cuarta opción">{{ old('opciones', $pregunta->opciones) }}</textarea>
                        <p class="mt-2 text-sm text-gray-600">Escribe cada opción en una línea separada. Para opción múltiple, incluye la letra (A, B, C, D).</p>
                        <x-input-error :messages="$errors->get('opciones')" class="mt-2" />
                    </div>

                    <!-- Respuesta Correcta -->
                    @if($pregunta->tipo !== 'abierta')
                    <div>
                        <x-input-label for="respuesta_correcta" value="Respuesta Correcta" />
                        <x-text-input id="respuesta_correcta" name="respuesta_correcta" type="text" class="mt-1 block w-full" 
                            value="{{ old('respuesta_correcta', $pregunta->respuesta_correcta) }}" 
                            placeholder="Escribe la respuesta correcta..."
                            required />
                        <p class="mt-2 text-sm text-gray-600">
                            <span id="respuesta-hint">
                                @if($pregunta->tipo === 'opcion_multiple')
                                    Para opción múltiple, escribe la letra (A, B, C, D).
                                @elseif($pregunta->tipo === 'verdadero_falso')
                                    Para verdadero/falso, escribe "Verdadero" o "Falso".
                                @else
                                    Para pregunta abierta, escribe la respuesta esperada.
                                @endif
                            </span>
                        </p>
                        <x-input-error :messages="$errors->get('respuesta_correcta')" class="mt-2" />
                    </div>
                    @endif
                    
                    @if($pregunta->imagen)
                    <div class="mt-2">
                        <span class="block text-sm text-gray-700 mb-1">Imagen actual:</span>
                            <img src="{{ asset('storage/' . $pregunta->imagen) }}" alt="Imagen de la pregunta" class="max-w-xs rounded border mb-2">
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row gap-6 mt-2">
                        <!-- Imagen -->
                        <div class="w-full md:w-1/2">
                            <label for="imagen" class="block text-sm font-medium text-gray-700">Carga una imagen</label>
                            
                            <div class="mt-1 flex items-center">
                                <label for="imagen" class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Seleccionar Imagen
                                </label>
                                <span id="file-name" class="ml-4 text-sm text-gray-600">Ningún archivo seleccionado</span>
                            </div>
                            <input id="imagen" name="imagen" type="file" accept="image/*" value="{{ old('imagen', $pregunta->imagen) }}" class="hidden"/>
                        </div>
                        
                        <!-- Puntos -->
                        <div class="w-full md:w-1/2">
                            <x-input-label for="puntos" class="block text-sm font-medium text-gray-700" value="Valor de la Pregunta"/>
                            <x-text-input id="puntos" name="puntos" type="number" step="0.5" class="mt-1 block w-full" 
                                value="{{ old('puntos', $pregunta->puntos) }}" 
                                required />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('preguntas.index', $examen) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Actualizar Pregunta
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            const opcionesContainer = document.getElementById('opciones-container');
            const respuestaContainer = document.getElementById('respuesta-container');
            const respuestaHint = document.getElementById('respuesta-hint');
            const opcionesField = document.getElementById('opciones');
            const respuestaField = document.getElementById('respuesta_correcta');
            
            if (this.value === 'opcion_multiple') {
                opcionesContainer.classList.remove('hidden');
                respuestaContainer.classList.remove('hidden');
                respuestaHint.textContent = 'Para opción múltiple, escribe la letra (A, B, C, D).';
                opcionesField.required = true;
            } else if (this.value === 'verdadero_falso') {
                opcionesContainer.classList.add('hidden');
                respuestaContainer.classList.remove('hidden');
                respuestaHint.textContent = 'Para verdadero/falso, escribe "Verdadero" o "Falso".';
                opcionesField.required = false;
            } else if (this.value === 'abierta') {
                opcionesContainer.classList.add('hidden');
                respuestaContainer.classList.add('hidden');
                opcionesField.required = false;
                respuestaField.required = false;
            } else {
                opcionesContainer.classList.add('hidden');
                respuestaHint.textContent = 'Selecciona un tipo de pregunta.';
                opcionesField.required = false;
            }
        });
        document.getElementById('imagen').addEventListener('change', function(e) {
            const fileNameSpan = document.getElementById('file-name');
            if (this.files && this.files.length > 0) {
                fileNameSpan.textContent = this.files[0].name;
            } else {
                fileNameSpan.textContent = 'Ningún archivo seleccionado';
            }
        });
    </script>
</x-dashboard-layout> 