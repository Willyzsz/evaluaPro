{{-- resources/views/dashboard/reticulas/edit.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Editar Reticula</h1>
            <a href="{{ route('reticulas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('reticulas.update', $reticula->idReticula) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Reticula -->
                    <div class="md:col-span-2">
                        <x-input-label for="nombre_reticula" value="Nombre del Reticula" />
                        <x-text-input id="nombre_reticula" name="nombre_reticula" type="text" class="mt-1 block w-full" 
                            value="{{ old('nombre_reticula', $reticula->nombre_reticula) }}" required />
                        <x-input-error :messages="$errors->get('nombre_reticula')" class="mt-2" />
                    </div>

                    <!-- Tema -->
                    <div>
                        <x-input-label for="tema_id" value="Tema" />
                        <select id="tema_id" name="tema_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        required>
                            <option value="">Seleccionar tema</option>
                            @foreach($temas as $tema)
                                <option value="{{ $tema->idTema }}" 
                                    {{ old('tema_id', $reticula->tema_id) == $tema->idTema ? 'selected' : '' }}>
                                    {{ $tema->nombre_tema }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tema_id')" class="mt-2" />
                    </div>

                    <!-- Examen -->
                    <div>
                        <x-input-label for="examen_id" value="Examen" />
                        <select id="examen_id" name="examen_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        required>
                            <option value="">Seleccionar examen</option>
                            @foreach($examenes as $examen)
                                <option value="{{ $examen->idExamen }}" 
                                    {{ old('examen_id', $reticula->examen_id) == $examen->idExamen ? 'selected' : '' }}>
                                    {{ $examen->nombre_examen }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('examen_id')" class="mt-2" />
                    </div>

                    <!-- Puesto -->
                    <div>
                        <x-input-label for="puesto_id" value="Puesto" />
                        <select id="puesto_id" name="puesto_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        required>
                            <option value="">Seleccionar puesto</option>
                            @foreach($puestos as $puesto)
                                <option value="{{ $puesto->idPuesto }}" 
                                    {{ old('puesto_id', $reticula->puesto_id) == $puesto->idPuesto ? 'selected' : '' }}>
                                    {{ $puesto->nombre_puesto }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('puesto_id')" class="mt-2" />
                    </div>

                    <!-- Departamento -->
                    <div>
                        <x-input-label for="departamento_id" value="Departamento" />
                        <select id="departamento_id" name="departamento_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        required>
                            <option value="">Seleccionar departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->idDepartamento }}" 
                                    {{ old('departamento_id', $reticula->departamento_id) == $departamento->idDepartamento ? 'selected' : '' }}>
                                    {{ $departamento->nombre_departamento }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
                    </div>

                    <!-- Curso -->
                    <div>
                        <x-input-label for="curso_id" value="Curso" />
                        <select id="curso_id" name="curso_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                        required>
                            <option value="">Seleccionar curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->idCurso }}" 
                                    {{ old('curso_id', $reticula->curso_id) == $curso->idCurso ? 'selected' : '' }}>
                                    {{ $curso->nombre_curso }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('reticulas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Actualizar Reticula
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout> 