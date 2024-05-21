@extends('layout.plantilla')
<script src="{{ asset('js/script.js') }}"></script>
@section('contenido')
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('criador.store') }}" method="POST" class="formulario" onsubmit="return validarFormularioCriador();">
        @csrf
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" id="numC" name="numeroCriador" placeholder="Numero Criador" tabindex="1" required onblur="validacionCriador(this)">
        <div class="error-message" id="numC-error"></div>
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" tabindex="2" required onblur="validacionCriador(this)">
        <div class="error-message" id="nombre-error"></div>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" tabindex="3" required onblur="validacionCriador(this)">
        <div class="error-message" id="apellidos-error"></div>
        <br>
        <label for="fechaNacimiento">Fecha Nacimiento: </label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" tabindex="4" required onblur="validacionCriador(this)">
        <div class="error-message" id="fechaNacimiento-error"></div>
        <br>
        <label for="localidad">Localidad: </label>
        <input type="text" id="localidad" name="localidad" placeholder="Localidad" tabindex="5" required onblur="validacionCriador(this)">
        <div class="error-message" id="localidad-error"></div>
        <br>
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password" placeholder="Contraseña" tabindex="6" required onblur="validacionCriador(this)">
        <div class="error-message" id="password-error"></div>
        <br>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email" placeholder="Email" tabindex="7" required onblur="validacionCriador(this)">
        <div class="error-message" id="email-error"></div>
        <br>
        <label for="telefono">Teléfono: </label>
        <input type="text" id="telefono" name="telefono" placeholder="Telefono" tabindex="8" required onblur="validacionCriador(this)">
        <div class="error-message" id="telefono-error"></div>
        <br>
        <div class="centrar-botones">
            <input type="submit" tabindex="9" value="Registrar">
            <a href="{{ route('layout.inicioCriador') }}"><input type="button" value="Volver"></a>
        </div>
    </form>
@endsection 
