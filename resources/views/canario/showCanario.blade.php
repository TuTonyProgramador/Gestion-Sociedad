@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}" title="Botón Cerrar Sesión">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="{{ route('canario.create') }}" title="Botón Registrar Pájaro">Registrar Pájaro</a></li>
                <li><a href="{{ route('graficos.graficoCanarios') }}" title="Botón Canarios Registrados Por Año">Canarios Registrados Por Año</a></li>
                <li><a href="{{ route('concurso.canariosCriador') }}" title="Botón Mis Canarios para Concurso">Mis Canarios para Concurso</a></li>
                <li><a href="{{ route('concurso.showConL') }}" title="Botón Consultar Concursos">Consultar Concursos</a></li>
                <li><a href="{{ route('criador.showCL') }}" title="Botón Mis Datos">Mis Datos</a></li>
            </ul>

            <div class="contenidoBuscador">
                <div class="buscador">
                    <input type="text" id="search" name="buscador" placeholder="Buscar canario...">
                </div>
            </div>
        </div>
    </div>
    
    <h2>Mis canarios</h2>
    <div class="tarjetas-container">
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
            <p>No hay canarios registrados</p>
        @endforelse
    </div>
    
    <script>
        // Guardar el HTML original de los canarios
        var originalCanariosHTML = document.getElementById('canarios-container').innerHTML;
    
        // Función para manejar el evento de cambio en el campo de búsqueda
        document.getElementById('search').addEventListener('input', function() {
            // Obtener el valor del campo de búsqueda
            var query = this.value.trim();
    
            // Si la consulta no está vacía
            if (query !== '') {
                // Realizar una solicitud AJAX al servidor
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route("canario.search") }}?buscador=' + query, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Actualizar el contenido del contenedor de canarios con la respuesta del servidor
                        document.getElementById('canarios-container').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            } else {
                // Si la consulta está vacía, restaurar los canarios originales
                document.getElementById('canarios-container').innerHTML = originalCanariosHTML;
            }
        });
    </script>
@endsection


