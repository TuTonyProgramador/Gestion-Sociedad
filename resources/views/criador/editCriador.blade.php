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
            <li><a href="{{ route('criador.showC') }}" class="boton" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <form action="{{ route('criador.update', ['criador' => $criador->id]) }}" method="POST" class="formulario">
        @csrf
        @method('put')
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" name="numeroCriador" value="{{ $criador->numeroCriador }}" required>
        <br>
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" value="{{ $criador->nombre }}" required>
        <br>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" value="{{ $criador->apellidos }}" required>
        <br>
        <br>
        <label for="fechaNacimiento">Fecha Nacimiento: </label>
        <input type="date" name="fechaNacimiento" value="{{ $criador->fechaNacimiento }}" required>
        <br>
        <br>
        <label for="localidad">Localidad: </label>
        <input type="text" name="localidad" value="{{ $criador->localidad }}" required>
        <br>
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" value="{{ $criador->email }}" required>
        <br>
        <br>
        <label for="telefono">Telefono: </label>
        <input type="number" name="telefono" value="{{ $criador->telefono }}" required>
        <br>
        <br>
        <label for="esAdmin">Admin: </label>
        <input type="number" name="esAdmin" value="{{ $criador->esAdmin }}" required>
        <br>
        <br>
        <input type="submit" value="Guardar">
    </form>
@endsection