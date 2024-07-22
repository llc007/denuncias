<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Canal de Denuncias') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ tab: 'actives' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Botón crear denuncia -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('denuncias.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ingresar Denuncia
                        </a>
                    </div>

                    <ul class="flex border-b">
                        <li class="-mb-px mr-1">
                            <a @click.prevent="tab = 'actives'" :class="{'border-l border-t border-r rounded-t text-blue-700': tab === 'actives'}" class="bg-white inline-block py-2 px-4 font-semibold cursor-pointer">
                                Activas
                            </a>
                        </li>
                        <li class="mr-1">
                            <a @click.prevent="tab = 'history'" :class="{'border-l border-t border-r rounded-t text-blue-700': tab === 'history'}" class="bg-white inline-block py-2 px-4 font-semibold cursor-pointer">
                                Historial
                            </a>
                        </li>
                    </ul>

                    <!-- Activas -->
                    <div x-show="tab === 'actives'" class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Denuncias Activas</h3>
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Identificador</th>
                                <th class="py-2 px-4 border-b">Fecha de creación</th>
                                <th class="py-2 px-4 border-b">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($denunciasActivas as $denuncia)
                                <tr onclick="window.location='{{ route('denuncias.show', $denuncia->id) }}'" class="cursor-pointer hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b text-center">{{ $denuncia->folio }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $denuncia->created_at->format('d-m-Y') }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        @if ($denuncia->estado == 'En curso')
                                            <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $denuncia->estado }}</span>
                                        @elseif($denuncia->estado == 'Nueva')
                                            <span class="bg-orange-500 text-white px-2 py-1 rounded">{{ $denuncia->estado }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Historial -->
                    <div x-show="tab === 'history'" class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Historial de Denuncias</h3>
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Identificador</th>
                                <th class="py-2 px-4 border-b">Fecha de creación</th>
                                <th class="py-2 px-4 border-b">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($denunciasHistorial as $denuncia)
                                <tr onclick="window.location='{{ route('denuncias.show', $denuncia->id) }}'" class="cursor-pointer hover:bg-gray-100">
                                    <td class="py-2 px-4 border-b text-center">{{ $denuncia->folio }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $denuncia->created_at->format('d-m-Y') }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        @if ($denuncia->estado == 'Finalizada')
                                            <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $denuncia->estado }}</span>
                                        @elseif($denuncia->estado == 'Nueva')
                                            <span class="bg-red-500 text-white px-2 py-1 rounded">{{ $denuncia->estado }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
