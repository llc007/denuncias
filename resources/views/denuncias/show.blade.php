<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver Denuncia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Información de la Denuncia -->
                        <div class="w-full lg:w-1/2 mb-6 lg:mb-0">
                            <div class="mb-4">
                                <h3 class="font-semibold text-lg">Detalles de la Denuncia</h3>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Folio:</label>
                                <p class="text-gray-600">{{ $denuncia->folio }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">¿Es anónima?</label>
                                <p class="text-gray-600">{{ $denuncia->anonima ? 'Sí' : 'No' }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Tipo de Denuncia:</label>
                                <p class="text-gray-600">{{ $denuncia->tipo_denuncia }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">¿Dónde Sucedió?</label>
                                <p class="text-gray-600">{{ $denuncia->donde_sucedio }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">¿Cuándo Sucedió?</label>
                                <p class="text-gray-600">{{ date('d-m-Y', strtotime($denuncia->cuando_sucedio)) }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Descripción del Hecho:</label>
                                <p class="text-gray-600">{{ $denuncia->descripcion_hecho }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Estado:</label>
                                <p class="text-gray-600">{{ $denuncia->estado }}</p>
                            </div>
                            <div class="mb-4">
                                <h3 class="font-semibold text-lg">Archivos Adjuntos</h3>
                                @if($denuncia->adjuntos->isEmpty())
                                    <p class="text-gray-600">No hay archivos adjuntos.</p>
                                @else
                                    <ul>
                                        @foreach($denuncia->adjuntos as $adjunto)
                                            <li>
                                                <a href="{{ Storage::url($adjunto->archivo) }}" target="_blank" class="text-blue-500">{{ basename($adjunto->archivo) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('denuncias.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Volver
                                </a>
                            </div>
                        </div>

                        <!-- Mensajería -->
                        <x-denuncias.mensajeria :denuncia="$denuncia"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
