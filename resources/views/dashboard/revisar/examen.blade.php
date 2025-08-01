<x-dashboard-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-black drop-shadow-lg">Examenes Realizados</h1>  
            <a href="{{ route('revisar.show', $usuario) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
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
            @forelse($examenesRealizados as $item)
                <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge[$item->tipo] ?? 'bg-gray-100 text-gray-800' }}">
                                    Examen
                                </span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->examen->nombre_examen }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $item->examen->descripcion_examen ? $item->examen->descripcion_examen : 'No hay descripcion' }}</p>
                        </div>
                            <div>
                                <a href="{{ route('revisar_info_examen', ['usuario' => $usuario, 'examen' => $item->examen->idExamen] ) }}" class="inline-flex items-center text-sm text-blue-600 hover:underline">
                                    Ver Resultados →
                                </a>
                            </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow rounded-xl p-8 text-center">
                    <div class="text-gray-500 mb-4">
                        <i data-feather="help-circle" class="w-16 h-16 mx-auto text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">El usuario no ha contestado Examenes</h3>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>