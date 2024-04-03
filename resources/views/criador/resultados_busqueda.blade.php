
<tbody>
    @foreach ($criadores as $criador)
        <tr>
            <td>{{ $criador->numeroCriador }}</td>
            <td>{{ $criador->nombre }}</td>
            <td>{{ $criador->apellidos }}</td>
            <td>{{ $criador->fechaNacimiento }}</td>
            <td>{{ $criador->localidad }}</td>
            <td>{{ $criador->email }}</td>
            <td>{{ $criador->telefono }}</td>
            <td><a href="{{ route('criador.edit', ['criador' => $criador->id]) }}" title="Botón Editar"><input type="button" value="Editar"></a></td>
            <form action="{{ route('criador.destroy', ['criador' => $criador->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar el criador {{ $criador->nombre }}?')">
                @csrf
                @method('delete')
                <td><input type="submit" value="Dar de baja"></td>
            </form>
        </tr>
    @endforeach
</tbody>

