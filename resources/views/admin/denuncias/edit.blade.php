<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Denuncia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.denuncias.update', $denuncia->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="estado" class="block text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="form-select mt-1 block w-full" required>
                                <option value="Nueva" {{ $denuncia->estado == 'Nueva' ? 'selected' : '' }}>Nueva</option>
                                <option value="En curso" {{ $denuncia->estado == 'En curso' ? 'selected' : '' }}>En curso</option>
                                <option value="Finalizada" {{ $denuncia->estado == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                                <option value="Descartada" {{ $denuncia->estado == 'Descartada' ? 'selected' : '' }}>Descartada</option>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
