{{-- resources/views/dashboard/reticulas.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="text-3xl font-bold text-white mb-6 drop-shadow-lg">Gestión de Reticulas</h1>
        
        <x-success-message />
        <x-error-message />

        <!-- Acciones -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <a href="{{ route('reticulas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                <i data-feather="plus" class="mr-2 w-5 h-5"></i> Crear nuevo reticula
            </a>
            <!-- Search Form --> 
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-1/3">

                <form method="GET" action="{{ route('reticulas.index') }}" class="relative flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Buscar reticula..." 
                        class="w-full border-gray-300 rounded-xl py-2 pl-10 pr-4 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <button type="submit" class="absolute left-3 top-2.5 text-gray-400 hover:text-gray-600">
                        <i data-feather="search" class="w-4 h-4"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('reticulas.index') }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                            <i data-feather="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-sm text-gray-600">
                    <tr>
                        <x-th>Nombre del reticula</x-th>
                        <x-th>Tema</x-th>
                        <x-th>Examen</x-th>
                        <x-th>Puesto</x-th>
                        <x-th>Departamento</x-th>
                        <x-th>Curso</x-th>
                        <x-th class="text-center">Acciones</x-th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($reticulas as $reticula)
                        <tr>
                            <x-td>{{ $reticula->nombre_reticula }}</x-td>
                            <x-td>{{ $reticula->tema ? $reticula->tema->nombre_tema : 'Sin tema' }}</x-td>
                            <x-td>{{ $reticula->examen ? $reticula->examen->nombre_examen : 'Sin examen' }}</x-td>
                            <x-td>{{ $reticula->puesto ? $reticula->puesto->nombre_puesto : 'Sin puesto' }}</x-td>
                            <x-td>{{ $reticula->departamento ? $reticula->departamento->nombre_departamento : 'Sin departamento' }}</x-td>
                            <x-td>{{ $reticula->curso ? $reticula->curso->nombre_curso : 'Sin curso' }}</x-td>
                            <x-td class="text-center">
                                <x-action-links 
                                    :edit-url="route('reticulas.edit', $reticula->idReticula)"
                                    :show-url="route('reticulas.show', $reticula->idReticula)"
                                    :delete-url="route('reticulas.destroy', $reticula->idReticula)"
                                />
                            </x-td>
                        </tr>
                    @empty
                        <tr>
                            <x-td colspan="4" class="text-center text-gray-500 py-8">
                                No hay exámenes registrados
                            </x-td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
