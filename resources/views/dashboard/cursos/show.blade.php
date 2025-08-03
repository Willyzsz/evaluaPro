{{-- resources/views/dashboard/cursos/show.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Detalles del Curso</h1>
            <div class="flex items-center gap-3">
                @if(request()->query('reticula'))
                <a href="{{ route('subReticulas.index', ['reticula' => request()->query('reticula')]) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                    <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver a la Reticula
                </a>
                @endif
                <a href="{{ route('cursos.edit', $curso->idCurso) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    <i data-feather="edit" class="mr-2 w-5 h-5"></i> Editar
                </a>
                <a href="{{ route('cursos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                    <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Principal -->
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $curso->nombre_curso }}</h2>
                </div>

                <!-- Curso URL -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Curso URL</h3>
                    <p class="text-gray-600">{{ $curso->curso_url  }}</p>
                </div>

                <!-- Descripción -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Descripción</h3>
                    <p class="text-gray-600 whitespace-pre-wrap">{{ $curso->descripcion_curso }}</p>
                </div>

                <!-- Información Adicional -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Información Adicional</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-700">ID del Curso</h4>
                            <p class="text-gray-600">{{ $curso->idCurso }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex items-center justify-end mt-8 gap-4 pt-6 border-t border-gray-200">
                <form action="{{ route('cursos.destroy', $curso->idCurso) }}" method="POST" class="inline" 
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este curso?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                        <i data-feather="trash-2" class="mr-2 w-5 h-5"></i> Eliminar Curso
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout> 