{{-- resources/views/dashboard/subReticulas/index.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Temas de la Reticula: {{ $reticula->nombre_reticula }}</h1>

            <a href="{{ route('subReticulas.create', $reticula) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                <i data-feather="plus" class="mr-2 w-5 h-5"></i> Añadir nuevo tema
            </a>
        </div>
        
        <x-success-message />
        <x-error-message />

        @php
            $badge = [
                'tema'   => 'bg-purple-100 text-purple-800',
                'examen' => 'bg-blue-100 text-blue-800',
                'curso'  => 'bg-green-100 text-green-800',
            ];
        @endphp

        <div class="space-y-4">
            @forelse($subReticulas as $item)
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge[$item->tipo] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($item->tipo) }}
                                </span>
                                <span class="text-sm text-gray-500">Orden #{{ $loop->iteration }}</span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->titulo }}</h3>
                            @if(!empty($item->detalle))
                                <p class="text-sm text-gray-600 mb-2">{{ $item->detalle }}</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 ml-4">
                            @isset($item->edit_link)
                                <a href="{{ $item->edit_link }}"
                                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                                    <i data-feather="edit" class="w-4 h-4 mr-1"></i> Editar
                                </a>
                            @endisset

                            <a href="{{ $item->link }}" class="inline-flex items-center text-sm text-blue-600 hover:underline">
                                Ver detalle →
                            </a>

                            @isset($item->delete_link)
                                <form action="{{ $item->delete_link }}" method="POST" class="inline"
                                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este elemento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                                    </button>
                                </form>
                            @endisset
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow rounded-xl p-8 text-center">
                    <div class="text-gray-500 mb-4">
                        <i data-feather="help-circle" class="w-16 h-16 mx-auto text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay elementos registrados</h3>
                    <p class="text-gray-500 mb-4">Comienza añadiendo el primer elemento para esta retícula.</p>
                    <a href="{{ route('subReticulas.create', $reticula) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                        <i data-feather="plus" class="mr-2 w-5 h-5"></i> Añadir primero
                    </a>
                </div>
            @endforelse
        </div>

        
        <!-- Botón Volver -->
        <div class="mt-8">
            <a href="{{ route('reticulas.show', $reticula) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver al reticula
            </a>
        </div>
    </div>
</x-dashboard-layout> 