{{-- resources/views/auth/login.blade.php --}}
<x-gradient-layout>
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md mx-4">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center bg-blue-100 p-4 rounded-full mb-4">
                <i data-feather="lock" class="text-blue-600 w-6 h-6"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">EvaluaPro</h1>
            <p class="text-gray-500 mt-1">Sistema de Evaluación de Personal</p>
        </div>
    

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Usuario -->
            <div>
                <x-input-label for="usuario" :value="'Usuario'" />
                <x-text-input id="usuario" class="block mt-1 w-full"
                            type="text"
                            name="usuario"
                            :value="old('usuario')"
                            required autofocus autocomplete="usuario" />
                <x-input-error :messages="$errors->get('usuario')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="md:col-span-2">
                <x-input-label for="password" :value="'Contraseña'" />
                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                    <button type="button"
                        onclick="togglePasswordVisibility('password', this)"
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                        <i data-feather="eye" class="w-5 h-5"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-center">
                <x-primary-button>
                        {{ __('Iniciar sesión') }}
                </x-primary-button>
            </div>
            
        </form>
      </form>
    </div>
</x-gradient-layout>