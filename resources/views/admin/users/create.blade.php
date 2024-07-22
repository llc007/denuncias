<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Nombre') }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Contraseña') }}</label>
                            <input id="password" class="block mt-1 w-full" type="password" name="password" required />
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mt-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        </div>

                        <!-- Roles -->
                        <div class="mt-4">
                            <label for="roles" class="block font-medium text-sm text-gray-700">{{ __('Roles') }}</label>
                            <select name="roles[]" id="roles" class="block mt-1 w-full" multiple required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ (collect(old('roles'))->contains($role->name)) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Crear Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
