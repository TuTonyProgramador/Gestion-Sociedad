@extends('layout.plantilla')

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
            @if(Auth::check() && Auth::user()->esAdmin)
                <li><a href="{{ route('canario.showCanA') }}" title="Botón Volver">Volver</a></li>
            @else
                <li><a href="{{ route('canario.showCan') }}" title="Botón Volver">Volver</a></li>
            @endif
        </ul>
    </div>
    <div class="container">
        <h2>Canarios que van a concurso</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Numero de anilla</th>
                    <th scope="col">Nombre de la raza</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Año de nacimiento</th>
                    <th scope="col">Concurso</th>
                </tr>
            </thead>
            <tbody>
                @foreach($concursos as $concurso)
                    @foreach($concurso->canarios as $canario)
                        <tr>
                            <td>{{ $canario->numeroAnilla }}</td>
                            <td>{{ $canario->nombreRaza }}</td>
                            <td>{{ $canario->sexo }}</td>
                            <td>{{ $canario->anioNacimiento }}</td>
                            <td>{{ $concurso->sede }}</td>
                        </tr>
                    @endforeach
                @endforeach                     
            </tbody>
        </table>
    </div>
@endsection
