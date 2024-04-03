@forelse($canarios as $canario)
    <div class="card">
        <div class="card-content">
            <h3 class="nombre-raza">{{ $canario->nombreRaza }}</h3>
            <ul class="card-info">
                <li><strong>Numero Criador:</strong> {{ $canario->criador->numeroCriador }}</li>
                <li><strong>Numero Anilla:</strong> {{ $canario->numeroAnilla }}</li>
                <li><strong>Año de nacimiento:</strong> {{ $canario->anioNacimiento }}</li>
                <li><strong>Sexo:</strong> {{ $canario->sexo }}</li>
                <li><strong>Descripcion:</strong> {{ $canario->descripcion }}</li>
            </ul>
            <div class="card-actions">
                <a href="{{ route('canario.edit', ['canario' => $canario->id]) }}" title="Botón Editar"><input type="button" value="Editar"></a>
                <form action="{{ route('canario.destroy', ['canario' => $canario->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar el canario {{ $canario->numeroAnilla }}')">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Borrar">
                </form>
            </div>
        </div>
    </div>
@empty
    <p>No se encontraron resultados</p>
@endforelse
