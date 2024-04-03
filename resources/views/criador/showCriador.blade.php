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
                <li><a href="{{ route('criador.menu') }}" class="boton" title="Botón Volver">Volver al menú de opciones</a></li>
            </ul>
    
            <div class="contenidoBuscador">
                <div class="buscador">
                    <input type="text" id="search" name="buscador" placeholder="Buscar criador...">
                </div>
            </div>
        </div>
    </div>

    <h2>Criadores Registrados</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Número de Criador</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Localidad</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col" colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody id="criadores-container">
            @forelse($criadores as $criador)
                <tr>
                    <td>{{ $criador->numeroCriador }}</td>
                    <td>{{ $criador->nombre }}</td>
                    <td>{{ $criador->apellidos }}</td>
                    <td>{{ $criador->fechaNacimiento }}</td>
                    <td>{{ $criador->localidad }}</td>
                    <td>{{ $criador->email }}</td>
                    <td>{{ $criador->telefono }}</td>
                    <td><a href="{{ route('criador.edit', ['criador' => $criador->id]) }}"><input type="button" value="Editar"></a></td>
                    <form action="{{ route('criador.destroy', ['criador' => $criador->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar el criador {{ $criador->nombre }}?')">
                        @csrf
                        @method('delete')
                        <td><input type="submit" value="Dar de baja"></td>
                    </form>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay criadores registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <script>
        // Guardar el HTML original de los criadores
        var originalCriadoresHTML = document.getElementById('criadores-container').innerHTML;

        // Función para manejar el evento de cambio en el campo de búsqueda
        document.getElementById('search').addEventListener('input', function() {
            // Obtener el valor del campo de búsqueda
            var query = this.value.trim();

            // Si la consulta no está vacía
            if (query !== '') {
                // Realizar una solicitud AJAX al servidor
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route("criador.search") }}?buscador=' + query, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Actualizar el contenido del contenedor de criadores con la respuesta del servidor
                        document.getElementById('criadores-container').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            } else {
                // Si la consulta está vacía, restaurar los criadores originales
                document.getElementById('criadores-container').innerHTML = originalCriadoresHTML;
            }
        });
    </script>

@endsection

