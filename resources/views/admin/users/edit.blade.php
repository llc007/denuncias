<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Nombre') }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                        </div>

                        <!-- Contraseña -->
                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Contraseña') }}</label>
                            <input id="password" class="block mt-1 w-full" type="password" name="password" />
                            <small>{{ __('Dejar en blanco si no desea cambiar la contraseña') }}</small>
                        </div>

                        <!-- Roles (si es necesario) -->
                        @if ($roles)
                            <div class="mt-4">
                                <label for="roles" class="block font-medium text-sm text-gray-700">{{ __('Roles') }}</label>
                                <select name="roles[]" id="roles" class="block mt-1 w-full" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <button class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Actualizar Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
