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
            <li><a href="{{ route('canario.showCanA') }}" class="boton" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <form action="" method="POST" class="formulario">
        <h2>Mis datos</h2>
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" name="numeroCriador" tabindex="1" value="{{ $criador->numeroCriador }}" readonly>
        <br>
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" tabindex="2" value="{{ $criador->nombre }}" readonly>
        <br>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" tabindex="3" value="{{ $criador->apellidos }}" readonly>
        <br>
        <br>
        <label for="fechaNacimiento">Fecha Nacimiento: </label>
        <input type="date" name="fechaNacimiento" tabindex="4" value="{{ $criador->fechaNacimiento }}" readonly>
        <br>
        <br>
        <label for="localidad">Localidad: </label>
        <input type="text" name="localidad" tabindex="5" value="{{ $criador->localidad }}" readonly>
        <br>
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" tabindex="6" value="{{ $criador->email }}" readonly>
        <br>
        <br>
        <label for="telefono">Telefono: </label>
        <input type="number" name="telefono" tabindex="7" value="{{ $criador->telefono }}" readonly>
    </form>
@endsection