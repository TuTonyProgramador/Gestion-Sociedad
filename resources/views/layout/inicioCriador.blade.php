@extends('layout.plantilla')
@section('contenido')
    <div class="menu">
        <ul>
            <li><a href="{{ route('criador.create') }}">Registro</a></li>
            <li><a href="{{ route('criador.sesionC') }}">Inicio de Sesión</a></li>
        </ul>
    </div>
@endsection