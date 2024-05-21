@extends('layout.plantilla')
<script src="{{ asset('js/script.js') }}"></script>
<link rel="stylesheet" href="../../style/style.css">
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
    
    <div class="formulario-container">
        <form action="{{ route('canario.seleccionarCUpdate', ['canario' => $canario->id]) }}" method="POST" class="formulario">
            @csrf
            @method('put')
            <div class="centrar-elementos">
                <label for="vaConcurso">Selecciona el concurso:</label>
                <select name="vaConcurso" id="vaConcurso">
                    <option value="">Selecciona un concurso</option>
                    @foreach($concursos as $concurso)
                        <option value="{{ $concurso->id }}" {{ $concurso->id == $canario->vaConcurso ? 'selected' : '' }}>
                            {{ $concurso->sede }}
                        </option>
                    @endforeach
                </select>
                <div class="error-message" id="vaConcurso-error"></div>
            </div>
            <br>
            <input type="submit" value="Guardar">
        </form>
    </div>
@endsection
