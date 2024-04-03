@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}" title="Botón Cerrar Sesión">Cerrar Sesión</a></li>
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
        <input type="text" name="nombreRaza" placeholder="Nombre Raza" required>
        <br>
        <br>
        <label for="anioNacimiento">Año de Nacimiento: </label>
        <input type="number" name="anioNacimiento" placeholder="Año Nacimiento" required>
        <br>
        <br>
        <label for="sexo">Sexo: </label>
        <input type="text" name="sexo" placeholder="Sexo" required>
        <br>
        <br>
        <label for="numeroAnilla">Numero Anilla: </label>
        <input type="number" name="numeroAnilla" placeholder="Numero Anilla" required>
        <br>
        <br>
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" placeholder="Descripcion" required>
        <br>
        <br>
        <label for="vaConcurso">Selecciona el concurso:</label>
        <select name="vaConcurso">
            <option value="">Selecciona un concurso</option>
            @foreach($concursos as $concurso)
                <option value="{{ $concurso->id }}">{{ $concurso->sede }}</option>
            @endforeach
        </select>        
        <br>
        <br>

        <input type="hidden" name="criador_id" value="{{ Auth::id() }}">

        <input type="submit" value="Registrar">
        
    </form>
@endsection