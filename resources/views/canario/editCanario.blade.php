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
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('canario.update', ['canario' => $canario->id]) }}" method="POST" class="formulario" onsubmit="return validarFormularioCanarios();">
        @csrf
        @method('put')
        <label for="nombreRaza">Nombre Raza: </label>
        <input type="text" name="nombreRaza" id="nombreRaza" value="{{ old('nombreRaza', $canario->nombreRaza) }}" tabindex="1" required onblur="validacionCanarios(this)">
        <div class="error-message" id="nombreRaza-error"></div>
        <br>
        <label for="anioNacimiento">Año de Nacimiento: </label>
        <input type="number" name="anioNacimiento" id="anioNacimiento" value="{{ old('anioNacimiento', $canario->anioNacimiento) }}" tabindex="2" required onblur="validacionCanarios(this)">
        <div class="error-message" id="anioNacimiento-error"></div>
        <br>
        <label for="sexo">Sexo: </label>
        <input type="text" name="sexo" id="sexo" value="{{ old('sexo', $canario->sexo) }}" tabindex="3" required onblur="validacionCanarios(this)">
        <div class="error-message" id="sexo-error"></div>
        <br>
        <label for="numeroAnilla">Numero Anilla: </label>
        <input type="number" name="numeroAnilla" id="numeroAnilla" value="{{ old('numeroAnilla', $canario->numeroAnilla) }}" tabindex="4" required onblur="validacionCanarios(this)">
        <div class="error-message" id="numeroAnilla-error"></div>
        <br>
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $canario->descripcion) }}" tabindex="5" required onblur="validacionCanarios(this)">
        <div class="error-message" id="descripcion-error"></div>
        <br>
        <input type="submit" tabindex="6" value="Guardar">
    </form>
@endsection
