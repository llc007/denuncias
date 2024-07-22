<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administración de Denuncias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full bg-white mt-4">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Identificador</th>
                            <th class="px-4 py-2">Fecha de creación</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($denuncias as $denuncia)
                            <tr>
                                <td class="border px-4 py-2">{{ $denuncia->folio }}</td>
                                <td class="border px-4 py-2">{{ $denuncia->created_at->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2">{{ $denuncia->estado }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.denuncias.show', $denuncia->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Ver</a>
                                    <a href="{{ route('admin.denuncias.edit', $denuncia->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Editar</a>
                                    <form action="{{ route('admin.denuncias.destroy', $denuncia->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
