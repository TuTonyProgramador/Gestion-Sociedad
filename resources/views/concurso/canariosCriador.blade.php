@extends('layout.plantilla')

@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}" title="Botón Cerrar Sesión">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection

@section('contenido')
    <div class="menu">
        <ul>
            <li><a href="{{ route('canario.showCanA') }}" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <h2>Canarios que van a concurso</h2>
    <div class="filtro">
        <label for="numero_anilla">Número de Anilla:</label>
        <select name="numero_anilla" id="numero_anilla">
            <option value="">Todos</option>
            @foreach($anillas as $anilla)
                <option value="{{ $anilla }}" {{ request('numero_anilla') == $anilla ? 'selected' : '' }}>{{ $anilla }}</option>
            @endforeach
        </select>

        <label for="concurso_id">Concurso:</label>
        <select name="concurso_id" id="concurso_id">
            <option value="">Todos</option>
            @foreach($concursos as $concurso)
                <option value="{{ $concurso->id }}" {{ request('concurso_id') == $concurso->id ? 'selected' : '' }}>{{ $concurso->sede }}</option>
            @endforeach
        </select>
    </div>
    <div class="table-container">
        @if($sinCanarios)
            <p>No tienes ningún canario para concurso.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th scope="col">Número de anilla</th>
                        <th scope="col">Nombre de la raza</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Año de nacimiento</th>
                        <th scope="col">Concurso</th>
                    </tr>
                </thead>
                <tbody id="canarios-container">
                    @foreach($concursos as $concurso)
                        @foreach($concurso->canarios as $canario)
                            <tr class="canario-row" data-concurso-id="{{ $concurso->id }}">
                                <td>{{ $canario->numeroAnilla }}</td>
                                <td>{{ $canario->nombreRaza }}</td>
                                <td>{{ $canario->sexo }}</td>
                                <td>{{ $canario->anioNacimiento }}</td>
                                <td>{{ $concurso->sede }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Detectar cambios en los selects y filtrar la tabla
            document.querySelectorAll('.filtro select').forEach(function(select) {
                select.addEventListener('change', function() {
                    var anillaSeleccionada = document.getElementById('numero_anilla').value.toLowerCase();
                    var concursoSeleccionado = document.getElementById('concurso_id').value;
                    var filas = document.querySelectorAll('.canario-row');
    
                    filas.forEach(function(fila) {
                        var anilla = fila.cells[0].textContent.toLowerCase();
                        var concurso = fila.getAttribute('data-concurso-id');

                        if ((anilla === anillaSeleccionada || anillaSeleccionada === '') && (concurso === concursoSeleccionado || concursoSeleccionado === '')) {
                            fila.style.display = '';
                        } else {
                            fila.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
