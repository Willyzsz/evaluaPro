{{-- resources/views/dashboard/subReticulas/create.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Añadir Tema</h1>
            <a href="{{ route('subReticulas.index', $reticula) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>
        <x-error-message />

        <div class="bg-white shadow rounded-xl p-6">
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Examen: {{ $reticula->nombre_reticula }}</h3>
                <p class="text-blue-700">{{ $reticula->puesto->nombre_puesto}}</p>
                <p class="text-blue-700">{{ $reticula->departamento->nombre_departamento}}</p>
            </div>

            <form action="{{ route('subReticulas.store', $reticula) }}" method="POST">
                @csrf
                
                <div class="space-y-6">

                    <!-- Tema-Examen-Curso -->
                    <div>
                        <x-input-label for="tipo" value="Elemento a añadir" />
                        <select id="tipo" name="tipo" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            required
                        >
                            <option value="">Seleccionar tipo</option>
                            <option value="tema" {{ old('tipo') == 'tema' ? 'selected' : '' }}>Tema</option>
                            <option value="examen" {{ old('tipo') == 'examen' ? 'selected' : '' }}>Examen</option>
                            <option value="curso" {{ old('tipo') == 'curso' ? 'selected' : '' }}>Curso</option>
                        </select>
                        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                    </div>

                    <!-- Tema -->
                    <div id="tema-container" class="hidden">
                        <x-input-label for="tema_id" value="Tema" />
                        <select id="tema_id" name="tema_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        >
                            <option value="">Seleccionar Tema</option>
                            @foreach($temas as $tema)
                                <option value="{{ $tema->idTema }}" {{ old('tema_id') == $tema->idTema ? 'selected' : '' }}>
                                    {{ $tema->nombre_tema }} | Puesto: {{ $tema->puesto->nombre_puesto }} | Departamento: {{ $tema->departamento->nombre_departamento }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tema_id')" class="mt-2" />
                    </div>

                    <!-- Examen -->
                    <div id="examen-container" class="hidden">
                        <x-input-label for="examen_id" value="Examen" />
                        <select id="examen_id" name="examen_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        >
                            <option value="">Seleccionar Examen</option>
                            @foreach($examenes as $examen)
                                <option value="{{ $examen->idExamen }}" {{ old('examen_id') == $examen->idExamen ? 'selected' : '' }}>
                                    {{ $examen->nombre_examen }} | Tema: {{ $examen->tema->nombre_tema }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('examen_id')" class="mt-2" />
                    </div>

                    <!-- Curso -->
                    <div id="curso-container" class="hidden">
                        <x-input-label for="curso_id" value="Curso" />
                        <select id="curso_id" name="curso_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        >
                            <option value="">Seleccionar Curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->idCurso }}" {{ old('curso_id') == $curso->idCurso ? 'selected' : '' }}>
                                    {{ $curso->nombre_curso }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
                    </div>

                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('subReticulas.index', $reticula) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Añadir
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            const temaContainer = document.getElementById('tema-container');
            const examenContainer = document.getElementById('examen-container');
            const cursoContainer = document.getElementById('curso-container');
            const temaField = document.getElementById('tema_id');
            const examenField = document.getElementById('examen_id');
            const cursoField = document.getElementById('curso_id');

            
            if (this.value === 'tema') {
                temaContainer.classList.remove('hidden');
                examenContainer.classList.add('hidden');
                cursoContainer.classList.add('hidden');
                temaField.required = true;
                examenField.required = false;
                cursoField.required = false;
            } else if (this.value === 'examen') {
                temaContainer.classList.add('hidden');
                examenContainer.classList.remove('hidden');
                cursoContainer.classList.add('hidden');
                temaField.required = false;
                examenField.required = true;
                cursoField.required = false;
            } else if (this.value === 'curso') {
                temaContainer.classList.add('hidden');
                examenContainer.classList.add('hidden');
                cursoContainer.classList.remove('hidden');
                temaField.required = false;
                examenField.required = false;
                cursoField.required = true;
            } else {
                temaContainer.classList.add('hidden');
                examenContainer.classList.add('hidden');
                cursoContainer.classList.add('hidden');
                temaField.required = false;
                examenField.required = false;
                cursoField.required = false;
            }
        });

    </script>
</x-dashboard-layout> 