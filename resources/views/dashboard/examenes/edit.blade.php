{{-- resources/views/dashboard/examenes/edit.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Editar Examen</h1>
            <a href="{{ route('examenes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('examenes.update', $examen->idExamen) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Examen -->
                    <div class="md:col-span-2">
                        <x-input-label for="nombre_examen" value="Nombre del Examen" />
                        <x-text-input id="nombre_examen" name="nombre_examen" type="text" class="mt-1 block w-full" 
                            value="{{ old('nombre_examen', $examen->nombre_examen) }}" required />
                        <x-input-error :messages="$errors->get('nombre_examen')" class="mt-2" />
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
                                    {{ old('tema_id', $examen->tema_id) == $tema->idTema ? 'selected' : '' }}>
                                    {{ $tema->nombre_tema }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tema_id')" class="mt-2" />
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <x-input-label for="descripcion_examen" value="Descripción" />
                        <textarea id="descripcion_examen" name="descripcion_examen" rows="4" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            >{{ old('descripcion_examen', $examen->descripcion_examen) }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion_examen')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('examenes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Actualizar Examen
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout> 