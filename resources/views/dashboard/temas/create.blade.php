{{-- resources/views/dashboard/temas/create.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Crear Nuevo Tema</h1>
            <a href="{{ route('temas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('temas.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Tema -->
                    <div class="md:col-span-2">
                        <x-input-label for="nombre_tema" value="Nombre del Tema" />
                        <x-text-input id="nombre_tema" name="nombre_tema" type="text" class="mt-1 block w-full" 
                            value="{{ old('nombre_tema') }}" required />
                        <x-input-error :messages="$errors->get('nombre_tema')" class="mt-2" />
                    </div>

                    <!-- Curso -->
                    <div>
                        <x-input-label for="curso_id" value="Curso" />
                        <select id="curso_id" name="curso_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                            
                        >
                            <option value="">Seleccionar curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->idCurso }}" {{ old('curso_id') == $curso->idCurso ? 'selected' : '' }}>
                                    {{ $curso->nombre_curso }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('curso_id')" class="mt-2" />
                    </div>

                    <!-- Puesto -->
                    <div>
                        <x-input-label for="puesto_id" value="Puesto" />
                        <select id="puesto_id" name="puesto_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                            required
                        >
                            <option value="">Seleccionar puesto</option>
                            @foreach($puestos as $puesto)
                                <option value="{{ $puesto->idPuesto }}" {{ old('puesto_id') == $puesto->idPuesto ? 'selected' : '' }}>
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
                            required
                        >
                            <option value="">Seleccionar departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->idDepartamento }}" {{ old('departamento_id') == $departamento->idDepartamento ? 'selected' : '' }}>
                                    {{ $departamento->nombre_departamento }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
                    </div>

                    <!-- Tema URL -->
                    <div>
                        <x-input-label for="tema_url" value="Tema URL" />
                        <x-text-input id="tema_url" name="tema_url" type="text" class="mt-1 block w-full" 
                            value="{{ old('tema_url') }}"/>
                        <x-input-error :messages="$errors->get('tema_url')" class="mt-2" />
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <x-input-label for="descripcion_tema" value="Descripción" />
                        <textarea id="descripcion_tema" name="descripcion_tema" rows="4" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required 
                            >{{ old('descripcion_tema') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion_tema')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('temas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Crear Tema
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout> 