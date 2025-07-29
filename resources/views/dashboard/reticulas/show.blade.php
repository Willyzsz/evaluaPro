{{-- resources/views/dashboard/reticulas/show.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Detalles del Reticula</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('reticulas.edit', $reticula->idReticula) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    <i data-feather="edit" class="mr-2 w-5 h-5"></i> Editar
                </a>
                <a href="{{ route('reticulas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                    <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Principal -->
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $reticula->nombre_reticula }}</h2>
                </div>

                <!-- Puesto -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Puesto</h3>
                    <p class="text-gray-600">{{ $reticula->puesto ? $reticula->puesto->nombre_puesto : 'Sin puesto asignado' }}</p>
                </div>

                <!-- Departamento -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Departamento</h3>
                    <p class="text-gray-600">{{ $reticula->departamento ? $reticula->departamento->nombre_departamento : 'Sin departamento asignado' }}</p>
                </div>

                <!-- Información Adicional -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Información Adicional</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700">ID del Reticula</h4>
                            <p class="text-gray-600">{{ $reticula->idReticula }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700">Puesto ID</h4>
                            <p class="text-gray-600">{{ $reticula->puesto_id ?? 'No asignado' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700">Departamento ID</h4>
                            <p class="text-gray-600">{{ $reticula->departamento_id ?? 'No asignado' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex items-center justify-end mt-8 gap-4 pt-6 border-t border-gray-200">
                <form action="{{ route('reticulas.destroy', $reticula->idReticula) }}" method="POST" class="inline" 
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este reticula?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                        <i data-feather="trash-2" class="mr-2 w-5 h-5"></i> Eliminar Reticula
                    </button>
                </form>
                <a href="{{ route('preguntas.index', $reticula) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    <i data-feather="plus" class="mr-2 w-5 h-5"></i> Crear/Ver Temas,Examenes y Cursos
                </a>
            </div>
        </div>
    </div>
</x-dashboard-layout> 