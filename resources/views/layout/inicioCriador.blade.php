@extends('layout.plantilla')
@section('contenido')
    <div class="menu">
        <ul>
            <li><a href="{{ route('criador.create') }}" title="Botón Registro">Registro</a></li>
            <li><a href="{{ route('criador.sesionC') }}" title="Botón Inicio Sesión">Inicio de Sesión</a></li>
        </ul>
    </div>

    <div class="portada">
        <img src="{{ asset('IMG/fotoE.jpg') }}" alt="Imagen de portada">
    </div>
@endsection