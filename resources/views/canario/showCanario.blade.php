@extends('layout.plantilla')
@section('contenido_extra')
<div class="menu">
    <ul>
        <li class="cerrar-sesion"><a href="{{ route('layout.logout') }}">Cerrar Sesión</a></li>
    </ul>
</div>
@endsection
@section('contenido')
    <div class="menu">
        <ul>
            <li><a href="{{ route('canario.create') }}">Registrar Pájaro</a></li>
            <li><a href="{{ route('concurso.showConL') }}">Consultar Concursos</a></li>
            <li><a href="{{ route('criador.showCL') }}">Mis Datos</a></li>
        </ul>
    </div>
    <h2>Mis canarios</h2>
    <div class="tarjetas-container">
        @forelse($canarios as $canario)
        <div class="card">
            <div class="card-content">
                <h3 class="nombre-raza">{{ $canario->nombreRaza }}</h3>
                <ul class="card-info">
                    <li><strong>Numero Criador:</strong> {{ $canario->criador->numeroCriador }}</li>
                    <li><strong>Numero Anilla:</strong> {{ $canario->numeroAnilla }}</li>
                    <li><strong>Año de nacimiento:</strong> {{ $canario->anioNacimiento }}</li>
                    <li><strong>Sexo:</strong> {{ $canario->sexo }}</li>
                    <li><strong>Descripcion:</strong> {{ $canario->descripcion }}</li>
                </ul>
                <div class="card-actions">
                    <a href="{{ route('canario.edit', ['canario' => $canario->id]) }}"><input type="button" value="Editar"></a>
                    <form action="{{ route('canario.destroy', ['canario' => $canario->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar el canario {{ $canario->numeroAnilla }}')">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Borrar">
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p>No hay canarios registrados</p>
        @endforelse
    </div>
    
@endsection


