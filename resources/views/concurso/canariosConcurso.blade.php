@extends('layout.plantilla')
<link rel="stylesheet" href="../../style/style.css">
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
        <li><a href="{{ route('concurso.showCon') }}" title="Botón Volver">Volver</a></li>
    </ul>
</div>
<h2>Canarios en el concurso: {{ $concurso->sede }}</h2>
@if(count($canarios) > 0)
    <div class="filtro">
        <label for="filtro-anilla">Número de anilla:</label>
        <select id="filtro-anilla">
            <option value="">Todos</option>
            @foreach($anillas as $anilla)
            <option value="{{ $anilla }}">{{ $anilla }}</option>
            @endforeach
        </select>

        <label for="filtro-sexo">Sexo:</label>
        <select id="filtro-sexo">
            <option value="">Todos</option>
            @foreach($sexos as $sexo)
            <option value="{{ $sexo }}">{{ $sexo }}</option>
            @endforeach
        </select>

        <label for="filtro-nacimiento">Año de nacimiento:</label>
        <select id="filtro-nacimiento">
            <option value="">Todos</option>
            @foreach($nacimientos as $nacimiento)
            <option value="{{ $nacimiento }}">{{ $nacimiento }}</option>
            @endforeach
        </select>

        <label for="filtro-criador">Criador:</label>
        <select id="filtro-criador">
            <option value="">Todos</option>
            @foreach($criadores as $criador)
            <option value="{{ $criador }}">{{ $criador }}</option>
            @endforeach
        </select>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Numero de anilla</th>
                    <th scope="col">Nombre de la raza</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Año de nacimiento</th>
                    <th scope="col">Criador</th>
                </tr>
            </thead>
            <tbody id="canarios-container">
                @foreach($canarios as $canario)
                <tr>
                    <td>{{ $canario->numeroAnilla }}</td>
                    <td>{{ $canario->nombreRaza }}</td>
                    <td>{{ $canario->sexo }}</td>
                    <td>{{ $canario->anioNacimiento }}</td>
                    <td>{{ $canario->criador->numeroCriador }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Obtenemos referencias a los elementos de filtro por su ID
    var filtroSexo = document.getElementById("filtro-sexo");
    var filtroAnilla = document.getElementById("filtro-anilla");
    var filtroNacimiento = document.getElementById("filtro-nacimiento");
    var filtroCriador = document.getElementById("filtro-criador");

    // Para cada elemento de filtro, agregamos un listener para el evento "change"
    [filtroSexo, filtroAnilla, filtroNacimiento, filtroCriador].forEach(function(filtro) {
        filtro.addEventListener("change", function() {
            var sexoSeleccionado = filtroSexo.value.toLowerCase();
            var anilla = filtroAnilla.value.trim().toLowerCase();
            var nacimiento = filtroNacimiento.value.trim().toLowerCase();
            var criador = filtroCriador.value.trim().toLowerCase();

            // Obtienemos todos los elementos de la tabla
            var canarios = document.querySelectorAll(".table tbody tr");

            // Iteramos sobre cada elemento de la tabla
            canarios.forEach(function(canario) {
                // Obtienemos los valores de cada celda y los convertimos a minúsculas para comparar
                var tdSexo = canario.cells[2].textContent.toLowerCase();
                var tdAnilla = canario.cells[0].textContent.toLowerCase();
                var tdNacimiento = canario.cells[3].textContent.toLowerCase();
                var tdCriador = canario.cells[4].textContent.toLowerCase();

                var mostrar = true;

                 // Comprobamos si los valores seleccionados coinciden con los valores de la fila
                if (sexoSeleccionado !== "" && sexoSeleccionado !== tdSexo) {
                    mostrar = false;
                }

                if (anilla !== "" && !tdAnilla.includes(anilla)) {
                    mostrar = false;
                }

                if (nacimiento !== "" && !tdNacimiento.includes(nacimiento)) {
                    mostrar = false;
                }

                if (criador !== "" && !tdCriador.includes(criador)) {
                    mostrar = false;
                }
                // Muestra o oculta la fila según el valor de la variable "mostrar"
                if (mostrar) {
                    canario.style.display = "table-row";
                } else {
                    canario.style.display = "none";
                }
            });
        });
    });
});
</script>
@else
    <p>No hay canarios para este concurso.</p>
@endif
@endsection
