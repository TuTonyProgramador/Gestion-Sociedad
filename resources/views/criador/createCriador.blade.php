@extends('layout.plantilla')
@section('contenido')
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('criador.store') }}" method="POST" class="formulario">
        @csrf
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" id="numC" name="numeroCriador" required>
        <br>
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required>
        <br>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" required>
        <br>
        <br>
        <label for="fechaNacimiento">Fecha Nacimiento: </label>
        <input type="date" name="fechaNacimiento" required>
        <br>
        <br>
        <label for="localidad">Localidad: </label>
        <input type="text" name="localidad" required>
        <br>
        <br>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" required>
        <br>
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email" required>
        <br>
        <br>
        <label for="telefono">Teléfono: </label>
        <input type="text" name="telefono" required>
        <br>
        <br>
        <div class="centrar-botones">
            <input type="submit" value="Registrar">
            <a href="{{ route('layout.inicioCriador') }}"><input type="button" value="Volver"></a>
        </div>
    </form>
@endsection