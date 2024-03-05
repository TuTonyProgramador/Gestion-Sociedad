@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    <br>
    <h2>Bienvenido Administrador {{ $criador->nombre }} {{ $criador->apellidos }}</h2>

    <div class="menu">
        <ul>
            <li><a href="{{ route('canario.showCanA') }}">Mis Canarios</a></li>
            <li><a href="{{ route('criador.showC') }}">Listado Criadores</a></li>
            <li><a href="{{ route('concurso.showCon') }}">Gestionar Concursos</a></li>
        </ul>
    </div>

@endsection