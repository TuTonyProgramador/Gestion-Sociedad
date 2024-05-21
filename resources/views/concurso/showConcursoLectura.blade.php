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
            <li><a href="{{ route('canario.showCanA') }}" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <h2>Listado de concursos</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Fecha Concurso</th>
                <th scope="col">Sede</th>
                <th scope="col">Ubicacion</th>
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