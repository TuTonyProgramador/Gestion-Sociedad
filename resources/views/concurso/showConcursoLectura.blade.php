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
            <li><a href="{{ route('canario.showCan') }}">Volver</a></li>
        </ul>
    </div>
    <h2>Listado de concursos</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha Concurso</th>
                <th>Sede</th>
                <th>Ubicacion</th>
            </tr>
        </thead>
        <tbody>
            @forelse($concursos as $concurso)
                <tr>
                    <td>{{ $concurso->fechaConcurso }}</td>
                    <td>{{ $concurso->sede }}</td>
                    <td>{{ $concurso->ubicacion }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay concursos</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection