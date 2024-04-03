@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}" title="Botón Cerrar Sesión">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    <form action="{{ route('canario.update', ['canario' => $canario->id]) }}" method="POST" class="formulario">
        @csrf
        @method('put')
        <label for="nombreRaza">Nombre Raza: </label>
        <input type="text" name="nombreRaza" value="{{ $canario->nombreRaza }}" required>
        <br>
        <br>
        <label for="anioNacimiento">Año de Nacimiento: </label>
        <input type="number" name="anioNacimiento" value="{{ $canario->anioNacimiento }}" required>
        <br>
        <br>
        <label for="sexo">Sexo: </label>
        <input type="text" name="sexo" value="{{ $canario->sexo }}" required>
        <br>
        <br>
        <label for="numeroAnilla">Numero Anilla: </label>
        <input type="number" name="numeroAnilla" value="{{ $canario->numeroAnilla }}" required>
        <br>
        <br>
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" value="{{ $canario->descripcion }}" required>
        <br>
        <br>
        <label for="vaConcurso">Selecciona el concurso:</label>
        <select name="vaConcurso">
            <option value="">Selecciona un concurso</option>
            @foreach($concursos as $concurso)
                <option value="{{ $concurso->id }}" {{ $concurso->id == $canario->vaConcurso ? 'selected' : '' }}>
                    {{ $concurso->sede }}
                </option>
            @endforeach
        </select>
        <br>
        <br>
        <input type="submit" value="Guardar">
    </form>
@endsection

