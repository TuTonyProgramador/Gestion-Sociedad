@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('canario.store') }}" method="POST" class="formulario">
        @csrf
        <label for="nombreRaza">Nombre Raza: </label>
        <input type="text" name="nombreRaza" required>
        <br>
        <br>
        <label for="anioNacimiento">Año de Nacimiento: </label>
        <input type="number" name="anioNacimiento" required>
        <br>
        <br>
        <label for="sexo">Sexo: </label>
        <input type="text" name="sexo" required>
        <br>
        <br>
        <label for="numeroAnilla">Numero Anilla: </label>
        <input type="number" name="numeroAnilla" required>
        <br>
        <br>
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" required>
        <br>
        <br>
        <label for="vaConcurso">Va a concurso</label>
        <input type="checkbox" name="vaConcurso">
        <br>
        <br>

        <input type="hidden" name="criador_id" value="{{ Auth::id() }}">

        <input type="submit" value="Registrar">
        
    </form>
@endsection