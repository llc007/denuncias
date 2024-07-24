<!-- resources/views/components/denuncias/descripcion.blade.php -->
<div x-data="{ showFull: false }">
    <p x-show="!showFull">
        {{ \Illuminate\Support\Str::words($text, 100, '...') }}
        <a href="#" @click.prevent="showFull = true" class="text-blue-500">Ver más</a>
    </p>
    <div x-show="showFull" x-cloak>
        <p>{!! nl2br(e($text)) !!}</p>
        <a href="#" @click.prevent="showFull = false" class="text-blue-500">Ver menos</a>
    </div>
</div>


