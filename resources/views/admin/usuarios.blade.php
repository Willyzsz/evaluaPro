{{-- resources/views/admin/usuarios.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="text-3xl font-bold text-white mb-6 drop-shadow-lg">Gestión de Usuarios</h1>
        
        <x-success-message />
        <x-error-message />


        <!-- Acciones -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <a href="{{ route('usuarios.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                <i data-feather="plus" class="mr-2 w-5 h-5"></i> Crear nuevo usuario
            </a>

            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-2/3">
                <!-- Search Form -->
                <form method="GET" action="{{ route('usuarios.index') }}" class="relative flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Buscar usuario..." 
                        class="w-full border-gray-300 rounded-xl py-2 pl-10 pr-4 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <button type="submit" class="absolute left-3 top-2.5 text-gray-400 hover:text-gray-600">
                        <i data-feather="search" class="w-4 h-4"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('usuarios.index') }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                            <i data-feather="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                </form>

                <!-- Filters Form -->
                <form method="GET" action="{{ route('usuarios.index') }}" class="flex gap-2">
                    <!-- Preserve search parameter -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <!-- Estatus Filter -->
                    <select name="estatus_filter" class="border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="none" {{ $estatusFilter === 'none' ? 'selected' : '' }}>Todos</option>
                        <option value="1" {{ $estatusFilter === '1' ? 'selected' : '' }}>Activos</option>
                        <option value="0" {{ $estatusFilter === '0' ? 'selected' : '' }}>Inactivos</option>
                    </select>

                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-sm">
                        <i data-feather="filter" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Resultados de búsqueda y filtros -->
        @if(request('search') || request('estatus_filter'))
            <div class="mb-4 text-sm text-gray-600">
                <span class="font-medium">{{ $usuarios->count() }}</span> resultado(s) encontrado(s)
                @if(request('search'))
                    para "<span class="font-medium">{{ request('search') }}</span>"
                @endif
                @if(request()->has('estatus_filter'))
                    @if(request('estatus_filter') === '1')
                        - <span class="font-medium">Solo Activos</span>
                    @elseif(request('estatus_filter') == '0')
                        - <span class="font-medium">Solo Inactivos</span>
                    @endif
                @endif
                <a href="{{ route('usuarios.index') }}" class="ml-2 text-blue-600 hover:text-blue-800">Limpiar filtros</a>
            </div>
        @endif

        <!-- Tabla -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-sm text-gray-600">
                    <tr>
                        <x-th>Nombre del usuario</x-th>
                        <x-th>Rol Usuario</x-th>
                        <x-th>Puesto</x-th>
                        <x-th>Departamento</x-th>
                        <x-th>Fecha de Ingreso</x-th>
                        <x-th>Estatus</x-th>
                        <x-th class="text-center">Acciones</x-th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($usuarios as $usuario)
                        <tr>
                            <x-td>{{ $usuario->usuario }}</x-td>
                            <x-td>{{ $usuario->rol_usuario }}</x-td>
                            <x-td>{{ $usuario->puesto ? $usuario->puesto->nombre_puesto : 'Sin puesto' }}</x-td>
                            <x-td>{{ $usuario->puesto && $usuario->puesto->departamento ? $usuario->puesto->departamento->nombre_departamento : 'Sin Departamento' }}</x-td>
                            <x-td>{{ $usuario->fecha_ingreso }}</x-td>
                            <x-td>
                                @if($usuario->estatus === 1)
                                <p class="text-green-600 font-medium">Activo</p>
                                @else
                                <p class="text-red-600 font-medium">Inactivo</p>
                                @endif
                            </x-td>
                            <x-td class="text-center">
                                <x-action-links 
                                    :edit-url="route('usuarios.edit', $usuario->idUsuario)"
                                    :show-url="route('usuarios.show', $usuario->idUsuario)"
                                    :delete-url="route('usuarios.destroy', $usuario->idUsuario)"
                                />
                            </x-td>
                        </tr>
                    @empty
                        <tr>
                            <x-td colspan="7" class="text-center text-gray-500 py-8">
                                @if(request('search') || request('estatus_filter'))
                                    No se encontraron usuarios con los filtros aplicados
                                @else
                                    No hay usuarios registrados
                                @endif
                            </x-td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
