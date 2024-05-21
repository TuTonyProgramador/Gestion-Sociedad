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
            <li><a href="{{ route('concurso.create') }}" title="Botón Crear Concursos">Crear Concurso</a></li>
            <li><a href="{{ route('criador.menu') }}" title="Botón Volver">Volver al menú de opciones</a></li>
        </ul>
    </div>
    <h2>Concursos Registrados</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Id Concurso</th>
                    <th scope="col">Fecha Concurso</th>
                    <th scope="col">Sede</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Añadido por</th>
                    <th scope="col" colspan="2">Acciones</th>
                    <th scope="col">Canarios Concurso</th>
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
                        <td><a href="{{ route('concurso.edit', ['concurso' => $concurso->id]) }}" title="Botón Editar"><input type="button" value="Editar"></a></td>
                        <form action="{{ route('concurso.destroy', ['concurso' => $concurso->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <td><input type="submit" value="Borrar"></td>
                        </form>
                        <td><a href="{{ route('concurso.canariosConcurso', ['concurso' => $concurso->id]) }}" title="Botón Ver Canarios"><input type="button" value="Ver canarios"></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No hay concursos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection