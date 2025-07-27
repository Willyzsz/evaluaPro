@props(['editUrl' => '#', 'showUrl' => '#', 'deleteUrl' => '#'])

<div class="flex items-center justify-center gap-3">
    <a href="{{ $editUrl }}" class="text-blue-600 hover:underline">Editar</a>
    <a href="{{ $showUrl }}" class="text-green-600 hover:underline">Ver</a>
    <form action="{{ $deleteUrl }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este elemento?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer">Eliminar</button>
    </form>
</div>