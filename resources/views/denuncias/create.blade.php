<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Denuncia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="anonima" class="block text-gray-700">¿Denuncia Anónima?</label>
                            <select name="anonima" id="anonima" class="form-select mt-1 block w-full">
                                <option value="0">No</option>
                                <option value="1">Sí</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tipo_denuncia" class="block text-gray-700">Tipo de Denuncia</label>
                            <input type="text" name="tipo_denuncia" id="tipo_denuncia" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="donde_sucedio" class="block text-gray-700">¿Dónde Sucedió?</label>
                            <input type="text" name="donde_sucedio" id="donde_sucedio" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="cuando_sucedio" class="block text-gray-700">¿Cuándo Sucedió?</label>
                            <input type="date" name="cuando_sucedio" id="cuando_sucedio" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="descripcion_hecho" class="block text-gray-700">Descripción del Hecho en Detalle</label>
                            <textarea name="descripcion_hecho" id="descripcion_hecho" class="form-textarea mt-1 block w-full" rows="5" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="adjuntos" class="block text-gray-700">Archivos Adjuntos</label>
                            <input type="file" name="adjuntos[]" id="adjuntos" class="form-input mt-1 block w-full" multiple>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear Denuncia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

