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
            <li><a href="{{ route('canario.showCan') }}" class="boton">Volver</a></li>
        </ul>
    </div>
    <form action="" method="POST" class="formulario">
        <h2>Mis datos</h2>
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" name="numeroCriador" value="{{ $criador->numeroCriador }}" readonly>
        <br>
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" value="{{ $criador->nombre }}" readonly>
        <br>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" value="{{ $criador->apellidos }}" readonly>
        <br>
        <br>
        <label for="fechaNacimiento">Fecha Nacimiento: </label>
        <input type="date" name="fechaNacimiento" value="{{ $criador->fechaNacimiento }}" readonly>
        <br>
        <br>
        <label for="localidad">Localidad: </label>
        <input type="text" name="localidad" value="{{ $criador->localidad }}" readonly>
        <br>
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" value="{{ $criador->email }}" readonly>
        <br>
        <br>
        <label for="telefono">Telefono: </label>
        <input type="number" name="telefono" value="{{ $criador->telefono }}" readonly>
    </form>
@endsection