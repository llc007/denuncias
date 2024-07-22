<!-- resources/views/components/denuncias/mensajeria.blade.php -->
<div class="w-full lg:w-1/2 lg:pl-6">
    <div class="mb-4">
        <h3 class="font-semibold text-lg">Mensajería</h3>
    </div>
    <div class="bg-gray-100 p-4 rounded-lg overflow-y-auto h-96">
        @php
            $previousAuthor = null;
            $colorAnterior = 'bg-gray-200';
            $colorNuevo = 'bg-gray-100';
        @endphp
        @forelse($denuncia->mensajes as $mensaje)
            @php
                $isDifferentAuthor = $previousAuthor !== $mensaje->usuario->id;
                $previousAuthor = $mensaje->usuario->id;

            @endphp

            <div class="mb-4 p-2 rounded-md {{ $isDifferentAuthor ? $colorNuevo : $colorAnterior   }}">
                <div class="flex items-center">
                    <span class="font-semibold text-gray-700">{{ $mensaje->usuario->name }}</span>

                    @php
                        if($isDifferentAuthor){
                            $aux=$colorNuevo;
                            $colorNuevo = $colorAnterior;
                            $colorAnterior=$aux;
                        }
                    @endphp
                    @if($mensaje->usuario->hasRole('admin'))
                        <span class="ml-2 text-sm text-gray-700 bg-yellow-100 px-2 py-1 rounded">Administrador</span>
                    @endif
                    <span class="ml-2 text-sm text-gray-500">{{ $mensaje->created_at->format('d-m-Y H:i') }}</span>
                </div>
                <p class="text-gray-600">{{ $mensaje->contenido }}</p>
                @if($mensaje->adjuntos->isNotEmpty())
                    <div class="mt-2">
                        <h4 class="font-semibold text-gray-700">Archivos Adjuntos:</h4>
                        <ul>
                            @foreach($mensaje->adjuntos as $adjunto)
                                <li>
                                    <a href="{{ Storage::url($adjunto->archivo) }}" target="_blank" class="text-blue-500">{{ basename($adjunto->archivo) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No hay mensajes.</p>
        @endforelse
    </div>
    <div class="mt-4">
        <form method="POST" action="{{ route('mensajes.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="denuncia_id" value="{{ $denuncia->id }}">
            <textarea name="contenido" rows="3" class="form-textarea mt-1 block w-full" placeholder="Escribe un mensaje..."></textarea>
            <input type="file" name="adjuntos[]" multiple class="form-input mt-2 block w-full">
            <div class="mt-2 text-right">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Enviar
                </button>
            </div>
        </form>
    </div>
</div>
