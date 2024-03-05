@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    <div class="menu">
        <ul>
            <li><a href="{{ route('concurso.showCon') }}">Volver</a></li>
        </ul>
    </div>
    <form action="{{ route('concurso.store') }}" method="POST" class="formulario">
        @csrf
        <label for="fechaConcurso">Fecha Concurso: </label>
        <input type="date" name="fechaConcurso" required>
        <br>
        <br>
        <label for="sede">Sede: </label>
        <input type="text" name="sede" required>
        <br>
        <br>
        <label for="ubicacion">Ubicacion: </label>
        <input type="text" name="ubicacion" required>
        <br>
        <br>
        <input type="hidden" name="criador_id" value="{{ Auth::id() }}">
        <input type="submit" value="Crear Concurso">
    </form>
@endsection