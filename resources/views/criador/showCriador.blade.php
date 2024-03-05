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
            <li><a href="{{ route('criador.menu') }}" class="boton">Volver al menu de opciones</a></li>
        </ul>
    </div>
    <h2>Criadores Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>Número de Criador</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha de Nacimiento</th>
                <th>Localidad</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($criadores as $criador)
                <tr>
                    <td>{{ $criador->numeroCriador }}</td>
                    <td>{{ $criador->nombre }}</td>
                    <td>{{ $criador->apellidos }}</td>
                    <td>{{ $criador->fechaNacimiento }}</td>
                    <td>{{ $criador->localidad }}</td>
                    <td>{{ $criador->email }}</td>
                    <td>{{ $criador->telefono }}</td>
                    <td><a href="{{ route('criador.edit', ['criador' => $criador->id]) }}"><input type="button" value="Editar"></a></td>
                    <form action="{{ route('criador.destroy', ['criador' => $criador->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar el criador {{ $criador->nombre }}?')">
                        @csrf
                        @method('delete')
                        <td><input type="submit" value="Dar de baja"></td>
                    </form>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay criadores registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

