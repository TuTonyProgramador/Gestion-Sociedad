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
            <li><a href="{{ route('concurso.showCon') }}" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <form action="{{ route('concurso.update', ['concurso' => $concurso->id]) }}" method="POST" class="formulario" onsubmit="return validarFormularioConcursos();">
        @csrf
        @method('put')
        <label for="fechaConcurso">Fecha Concurso: </label>
        <input type="date" name="fechaConcurso" id="fechaConcurso" value="{{ $concurso->fechaConcurso }}" tabindex="1" required onblur="validacionConcursos(this)">
        <div class="error-message" id="fechaConcurso-error"></div>
        <br>
        <label for="sede">Sede: </label>
        <input type="text" name="sede" id="sede" value="{{ $concurso->sede }}" tabindex="2" required onblur="validacionConcursos(this)">
        <div class="error-message" id="sede-error"></div>
        <br>
        <label for="ubicacion">Ubicacion: </label>
        <input type="text" name="ubicacion" id="ubicacion" value="{{ $concurso->ubicacion }}" tabindex="3" required onblur="validacionConcursos(this)">
        <div class="error-message" id="ubicacion-error"></div>
        <br>
        <input type="submit" tabindex="4" value="Guardar">
    </form>
@endsection

