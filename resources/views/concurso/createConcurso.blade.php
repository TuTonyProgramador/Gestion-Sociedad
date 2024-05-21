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
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('concurso.store') }}" method="POST" class="formulario" onsubmit="return validarFormularioConcursos();">
        @csrf
        <label for="fechaConcurso">Fecha Concurso: </label>
        <input type="date" name="fechaConcurso" id="fechaConcurso" tabindex="1" required onblur="validacionConcursos(this)">
        <div class="error-message" id="fechaConcurso-error"></div>
        <br>
        <label for="sede">Sede: </label>
        <input type="text" name="sede" placeholder="Sede" id="sede" tabindex="2" required onblur="validacionConcursos(this)">
        <div class="error-message" id="sede-error"></div>
        <br>
        <label for="ubicacion">Ubicacion: </label>
        <input type="text" name="ubicacion"  placeholder="Ubicacion" id="ubicacion" tabindex="3" required onblur="validacionConcursos(this)">
        <div class="error-message" id="ubicacion-error"></div>
        <br>
        <input type="hidden" tabindex="4" name="criador_id" value="{{ Auth::id() }}">
        <input type="submit" tabindex="5" value="Crear Concurso">
    </form>
@endsection