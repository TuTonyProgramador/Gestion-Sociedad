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
            <li><a href="{{ route('concurso.showCon') }}" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <form action="{{ route('concurso.update', ['concurso' => $concurso->id]) }}" method="POST" class="formulario">
        @csrf
        @method('put')
        <label for="fechaConcurso">Fecha Concurso: </label>
        <input type="date" name="fechaConcurso" value="{{ $concurso->fechaConcurso }}" required>
        <br>
        <br>
        <label for="sede">Sede: </label>
        <input type="text" name="sede" value="{{ $concurso->sede }}" required>
        <br>
        <br>
        <label for="ubicacion">Ubicacion: </label>
        <input type="text" name="ubicacion" value="{{ $concurso->ubicacion }}" required>
        <br>
        <br>
        <input type="submit" value="Guardar">
    </form>
@endsection

