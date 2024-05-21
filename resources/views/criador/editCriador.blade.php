@extends('layout.plantilla')
<script src="{{ asset('js/script.js') }}"></script>
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
    <form action="{{ route('criador.update', ['criador' => $criador->id]) }}" method="POST" class="formulario" onsubmit="return validarFormularioEditCriador();">
        @csrf
        @method('put')
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" name="numeroCriador" id="numC" value="{{ $criador->numeroCriador }}" tabindex="1" required disabled>
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="{{ $criador->nombre }}" tabindex="2" required onblur="validacionCriador(this)">
        <div class="error-message" id="nombre-error"></div>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" id="apellidos" value="{{ $criador->apellidos }}" tabindex="3" required onblur="validacionCriador(this)">
        <div class="error-message" id="apellidos-error"></div>
        <br>
        <label for="fechaNacimiento">Fecha Nacimiento: </label>
        <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="{{ $criador->fechaNacimiento }}" tabindex="4" required onblur="validacionCriador(this)">
        <div class="error-message" id="fechaNacimiento-error"></div>
        <br>
        <label for="localidad">Localidad: </label>
        <input type="text" name="localidad" id="localidad" value="{{ $criador->localidad }}" tabindex="5" required onblur="validacionCriador(this)">
        <div class="error-message" id="localidad-error"></div>
        <br>
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" value="{{ $criador->email }}" tabindex="6" required onblur="validacionCriador(this)">
        <div class="error-message" id="email-error"></div>
        <br>
        <label for="telefono">Telefono: </label>
        <input type="number" name="telefono" id="telefono" value="{{ $criador->telefono }}" tabindex="7" required onblur="validacionCriador(this)">
        <div class="error-message" id="telefono-error"></div>
        <br>
        <label for="esAdmin">Admin:</label>
        <select name="esAdmin" id="esAdmin" tabindex="8" required>
            <option value="0" {{ $criador->esAdmin == 0 ? 'selected' : '' }}>No eres administrador</option>
            <option value="1" {{ $criador->esAdmin == 1 ? 'selected' : '' }}>Eres administrador</option>
        </select>
        <br>
        <br>
        <input type="submit" tabindex="9" value="Guardar">
    </form>
@endsection