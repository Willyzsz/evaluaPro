{{-- resources/views/admin/usuarios/edit.blade.php --}}
<x-dashboard-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Editar Usuario</h1>
            <a href="{{ route('usuarios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i> Volver
            </a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Usuario -->
                    <div class="md:col-span-2">
                        <x-input-label for="usuario" value="Nombre del Usuario" />
                        <x-text-input id="usuario" name="usuario" type="text" class="mt-1 block w-full" 
                            value="{{ old('usuario', $usuario->usuario) }}" required />
                        <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
                    </div>

                    <!-- Contraseña -->
                    <div class="md:col-span-2">
                        <x-input-label for="password" value="Nueva Contraseña (dejar en blanco para mantener la actual)" />
                        <div class="relative">
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                            <button type="button"
                                onclick="togglePasswordVisibility('password', this)"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                                <i data-feather="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="md:col-span-2">
                        <x-input-label for="password_confirmation" value="Confirmar Nueva Contraseña" />
                        <div class="relative">
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
                            <button type="button"
                                onclick="togglePasswordVisibility('password_confirmation', this)"
                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                                <i data-feather="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Puesto -->
                    <div>
                        <x-input-label for="puesto_id" value="Puesto" />
                        <select id="puesto_id" name="puesto_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                            required
                        >
                            <option value="">Seleccionar puesto</option>
                            @foreach($puestos as $puesto)
                                <option value="{{ $puesto->idPuesto }}" 
                                    {{ old('puesto_id', $usuario->puesto_usuario) == $puesto->idPuesto ? 'selected' : '' }}>
                                    {{ $puesto->nombre_puesto }} - {{ $puesto->departamento->nombre_departamento}}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('puesto_id')" class="mt-2" />
                    </div>

                    <!-- Rol -->
                    <div>
                        <x-input-label for="rol_usuario" value="Rol" />
                        <select id="rol_usuario" name="rol_usuario" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                            required
                        >
                            <option value="">Seleccionar Rol</option>
                                <option value="capacitador" {{ old('rol_usuario', $usuario->rol_usuario) == 'capacitador' ? 'selected' : '' }}>Capacitador</option>
                                <option value="usuario" {{ old('rol_usuario', $usuario->rol_usuario) == 'usuario' ? 'selected' : '' }}>Usuario</option>
                        </select>
                        <x-input-error :messages="$errors->get('rol_usuario')" class="mt-2" />
                    </div>

                    <!-- Fecha -->
                    <div>
                        <x-input-label for="fecha_ingreso" value="Fecha de Ingreso" />
                        <x-text-input id="fecha_ingreso" name="fecha_ingreso" type="date" class="mt-1 block w-full" 
                            value="{{ old('fecha_ingreso', $usuario->fecha_ingreso) }}" />
                        <x-input-error :messages="$errors->get('fecha_ingreso')" class="mt-2" />
                    </div>
                    
                    <!-- Estado -->
                    <div>
                        <x-input-label for="estatus" value="Estado" />
                        <select id="estatus" name="estatus" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-600"
                            required
                        >
                            <option value="">Seleccionar Estado</option>
                                <option value="1" {{ old('estatus', $usuario->estatus) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('estatus', $usuario->estatus) == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <x-input-error :messages="$errors->get('estatus')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('usuarios.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition">
                        Cancelar
                    </a>
                    <x-primary-button icon="save">
                        Actualizar Usuario
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout> 