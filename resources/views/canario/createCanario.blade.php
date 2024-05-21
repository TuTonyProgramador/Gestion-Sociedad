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
            <li><a href="{{ route('canario.showCanA') }}" class="boton" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('canario.store') }}" method="POST" class="formulario" onsubmit="return validarFormularioCanarios();">
        @csrf
        <label for="nombreRaza">Nombre Raza: </label>
        <input type="text" name="nombreRaza" id="nombreRaza" placeholder="Nombre Raza" tabindex="1" required onblur="validacionCanarios(this)">
        <div class="error-message" id="nombreRaza-error"></div>
        <br>
        <label for="anioNacimiento">Año de Nacimiento: </label>
        <input type="number" name="anioNacimiento" id="anioNacimiento" placeholder="Año Nacimiento" tabindex="2" required onblur="validacionCanarios(this)">
        <div class="error-message" id="anioNacimiento-error"></div>
        <br>
        <label for="sexo">Sexo: </label>
        <input type="text" name="sexo" id="sexo" placeholder="Sexo" tabindex="3" required onblur="validacionCanarios(this)">
        <div class="error-message" id="sexo-error"></div>
        <br>
        <label for="numeroAnilla">Numero Anilla: </label>
        <input type="number" name="numeroAnilla" id="numeroAnilla" placeholder="Numero Anilla" tabindex="4" required onblur="validacionCanarios(this)">
        <div class="error-message" id="numeroAnilla-error"></div>
        <br>
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" tabindex="5" required onblur="validacionCanarios(this)">
        <div class="error-message" id="descripcion-error"></div>
        <br>
        <label for="vaConcurso">Selecciona el concurso:</label>
        <select name="vaConcurso" id="vaConcurso" tabindex="6">
            <option value="">Selecciona un concurso</option>
            @foreach($concursos as $concurso)
                <option value="{{ $concurso->id }}">{{ $concurso->sede }}</option>
            @endforeach
        </select>
        <div class="error-message" id="vaConcurso-error"></div>
        <br>
        <br>

        <input type="hidden" tabindex="7" name="criador_id" value="{{ Auth::id() }}">

        <input type="submit" tabindex="8" value="Registrar">
        
    </form>
@endsection