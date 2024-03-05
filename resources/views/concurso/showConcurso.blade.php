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
            <li><a href="{{ route('concurso.create') }}">Crear Concurso</a></li>
            <li><a href="{{ route('criador.menu') }}">Volver al menu de opciones</a></li>
        </ul>
    </div>
    <h2>Concursos Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>Id Concurso</th>
                <th>Fecha Concurso</th>
                <th>Sede</th>
                <th>Ubicacion</th>
                <th>Añadido por</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($concursos as $concurso)
                <tr>
                    <td>{{ $concurso->id }}</td>
                    <td>{{ $concurso->fechaConcurso }}</td>
                    <td>{{ $concurso->sede }}</td>
                    <td>{{ $concurso->ubicacion }}</td>
                    <td>{{ $concurso->criador->numeroCriador }}</td>
                    <td><a href="{{ route('concurso.edit', ['concurso' => $concurso->id]) }}"><input type="button" value="Editar"></a></td>
                    <form action="{{ route('concurso.destroy', ['concurso' => $concurso->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <td><input type="submit" value="Borrar"></td>
                    </form>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay concurso</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection