@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}" title="Botón Cerrar Sesión">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    <br>
    <h2>Bienvenido Administrador {{ $criador->nombre }} {{ $criador->apellidos }}</h2>

    <div class="menu">
        <ul>
            <li><a href="{{ route('canario.showCanA') }}" title="Botón Mis Canarios">Mis Canarios</a></li>
            <li><a href="{{ route('criador.showC') }}" title="Botón Listado Criadores">Listado Criadores</a></li>
            <li><a href="{{ route('concurso.showCon') }}" title="Botón Gestionar Concursos">Gestionar Concursos</a></li>
        </ul>
    </div>

@endsection