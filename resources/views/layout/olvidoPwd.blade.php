@extends('layout.plantilla')
@section('contenido')
    <form action="{{ route('layout.enviarLinkRecuperacion') }}" class="formulario" method="POST">
        @csrf
        <p>Recuperar Contraseña</p>
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <div class="centrar-botones">
            <a href="{{ route('layout.inicioCriador') }}" title="Botón Enviar"><input type="button" value="Enviar"></a>
            <a href="{{ route('criador.sesionC') }}" title="Botón Volver"><input type="button" value="Volver"></a>
        </div>
    </form>
@endsection