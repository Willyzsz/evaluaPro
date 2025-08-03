{{-- resources/views/generales/reticulas/index.blade.php --}}
<x-welcome-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-black drop-shadow-lg">Temas de la Reticula: {{ $reticula->nombre_reticula }}</h1>            
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
                        @if($item->tipo === 'examen')
                            @if(!in_array($item->id, $examenesRealizados))
                                <div>
                                    <a href="{{ $item->link }}" class="inline-flex items-center text-sm text-blue-600 hover:underline">
                                        Contestar Examen →
                                    </a>
                                </div>
                            @else
                                <div class="text-sm text-gray-500 italic">
                                    Examen ya contestado
                                </div>
                            @endif
                        @else
                        <div>
                            <a href="{{ $item->link }}" class="inline-flex items-center text-sm text-blue-600 hover:underline">
                                URL →
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white shadow rounded-xl p-8 text-center">
                    <div class="text-gray-500 mb-4">
                        <i data-feather="help-circle" class="w-16 h-16 mx-auto text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay Reticula para este Puesto y/o Departamento</h3>
            @endforelse
        </div>
    </div>
</x-welcome-layout> 