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
        @if(Auth::user()->esAdmin)
        <!-- Menú para administradores -->
        <ul>
            <li><a href="{{ route('canario.create') }}" title="Botón Registrar Pájaros">Registrar Pájaro</a></li>
            <li><a href="{{ route('graficos.graficoCanarios') }}" title="Botón Canarios Registrados Por Año">Canarios Registrados Por Año</a></li>
            <li><a href="{{ route('concurso.canariosCriador') }}" title="Botón Mis Canarios para Concurso">Mis Canarios para Concurso</a></li>
            <li><a href="{{ route('criador.menu') }}" title="Botón Volver">Volver al menú de opciones</a></li>
        </ul>
        @else
        <!-- Menú para usuarios normales -->
        <ul>
            <li><a href="{{ route('canario.create') }}" title="Botón Registrar Pájaros">Registrar Pájaro</a></li>
            <li><a href="{{ route('graficos.graficoCanarios') }}" title="Botón Canarios Registrados Por Año">Canarios Registrados Por Año</a></li>
            <li><a href="{{ route('concurso.canariosCriador') }}" title="Botón Mis Canarios para Concurso">Mis Canarios para Concurso</a></li>
            <li><a href="{{ route('concurso.showConL') }}" title="Botón Consultar Concursos">Consultar Concursos</a></li>
            <li><a href="{{ route('criador.formularioCorreo') }}" title="Botón Soporte">Soporte</a></li>
            <li><a href="{{ route('criador.showCL') }}" title="Botón Mis Datos">Mis Datos</a></li>
        </ul>
        @endif

        <div class="contenidoBuscador">
            <div class="buscador">
                <i class="fas fa-search"></i>
                <input type="text" id="search" name="buscador" placeholder="Buscar canario...">
            </div>
        </div>
    </div>
</div>

<h2>Mis canarios</h2>
<div class="tarjetas-container" id="canarios-container">
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
                <div class="seleccionar-concurso-container">
                    <a href="{{ route('canario.seleccionarCEdit', ['canario' => $canario->id]) }}" title="Botón Seleccionar Concurso"><input type="button" value="Seleccionar Concurso"></a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p>No hay canarios registrados</p>
    @endforelse
</div>

<div class="pagination">
    {{ $canarios->links() }}
</div>

<script>
    // Guardamos el HTML original de los canarios
    var originalCanariosHTML = document.getElementById('canarios-container').innerHTML;

    // Función para manejar el evento de cambio en el campo de búsqueda
    document.getElementById('search').addEventListener('input', function() {
        // Obtenemos el valor del campo de búsqueda
        var query = this.value.trim();

        if (query !== '') {
            // Realizamos una solicitud AJAX al servidor
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route("canario.search") }}?buscador=' + query, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Actualizamos el contenido del contenedor de canarios con la respuesta del servidor
                    document.getElementById('canarios-container').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        } else {
            // Si la consulta está vacía, restauramos los canarios originales
            document.getElementById('canarios-container').innerHTML = originalCanariosHTML;
        }
    });


</script>
@endsection
