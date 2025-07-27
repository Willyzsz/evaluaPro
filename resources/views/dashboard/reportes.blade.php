{{-- resources/views/dashboard/reports.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h1 class="text-3xl font-bold text-white mb-6 drop-shadow-lg">Gestión de Reportes</h1>

        <!-- Acciones -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
            <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                <i data-feather="plus" class="mr-2 w-5 h-5"></i> Crear nuevo examen
            </a>

            <div class="relative w-full sm:w-1/3">
                <input type="text" placeholder="Buscar examen..." class="w-full border-gray-300 rounded-xl py-2 pl-10 pr-4 focus:ring-blue-500 focus:border-blue-500">
                <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400 w-4 h-4"></i>
            </div>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-sm text-gray-600">
                    <tr>
                        <x-th>Nombre del examen</x-th>
                        <x-th>Temas</x-th>
                        <x-th>Última edición</x-th>
                        <x-th class="text-center">Acciones</x-th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <tr>
                        <x-td>Examen de Seguridad</x-td>
                        <x-td>EPP, Normas, Protocolos</x-td>
                        <x-td>20 Jul 2025</x-td>
                        <x-td class="text-center">
                            <x-action-links />
                            {{-- <x-action-links :id="$examen->id" /> --}}
                        </x-td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
