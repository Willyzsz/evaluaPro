{{-- resources/views/admin/direcciones/create.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Crear Nueva Direccion</h1>
            <a href="{{ route('direcciones.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('direcciones.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Direccion -->
                    <div class="md:col-span-2">
                        <x-input-label for="nombre_direccion" value="Nombre de la Direccion" />
                        <x-text-input id="nombre_direccion" name="nombre_direccion" type="text" class="mt-1 block w-full" 
                            value="{{ old('nombre_direccion') }}" required />
                        <x-input-error :messages="$errors->get('nombre_direccion')" class="mt-2" />
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <x-input-label for="descripcion_direccion" value="Descripción" />
                        <textarea id="descripcion_direccion" name="descripcion_direccion" rows="4" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            >{{ old('descripcion_direccion') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion_direccion')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('direcciones.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Crear Direccion
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout> 