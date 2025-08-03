{{-- resources/views/admin/usaurios/show.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Detalles del Usuario</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                    <i data-feather="edit" class="mr-2 w-5 h-5"></i> Editar
                </a>
                <a href="{{ route('usuarios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                    <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información Principal -->
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Nombre: {{ $usuario->usuario }}</h2>
                </div>

                <!-- Puesto -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Puesto</h3>
                    <p class="text-gray-600">{{ $usuario->puesto ? $usuario->puesto->nombre_puesto : 'Sin puesto asignado' }}</p>
                </div>

                <!-- Departamento -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Departamento</h3>
                    <p class="text-gray-600">{{ $usuario->puesto  && $usuario->puesto->departamento ? $usuario->puesto->departamento->nombre_departamento : 'Sin departamento asignado' }}</p>
                </div>

                <!-- Rol Usuario -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Rol Usuario</h3>
                    <p class="text-gray-600">{{ $usuario->rol_usuario }} </p>
                </div>

                <!-- Fecha Ingreso -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Fecha de Ingreso</h3>
                    <p class="text-gray-600">{{ $usuario->fecha_ingreso }} </p>
                </div>
                <!-- Estatus -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Estado</h3>
                    @if($usuario->estatus === 1)
                    <p class="text-green-600 font-medium">Activo</p>
                    @else
                    <p class="text-red-600 font-medium">Inactivo</p>
                    @endif
                </div>

                <!-- ID Usuario -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">ID del Usuario</h3>
                    <p class="text-gray-600">{{ $usuario->idUsuario }} </p>
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex items-center justify-end mt-8 gap-4 pt-6 border-t border-gray-200">
                <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" class="inline" 
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                        <i data-feather="trash-2" class="mr-2 w-5 h-5"></i> Eliminar Usuario
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout> 