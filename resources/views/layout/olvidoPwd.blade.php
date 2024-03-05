@extends('layout.plantilla')
@section('contenido')
    <form action="" class="formulario">
        <p>Recuperar Contraseña</p>
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <div class="centrar-botones">
            <a href="{{ route('layout.inicioCriador') }}"><input type="button" value="Enviar"></a>
            <a href="{{ route('criador.sesionC') }}"><input type="button" value="Volver"></a>
        </div>
    </form>
@endsection