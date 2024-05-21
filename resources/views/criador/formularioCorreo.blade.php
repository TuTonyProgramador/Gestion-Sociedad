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
        <li><a href="{{ route('canario.showCanA') }}" class="boton" title="Botón Volver">Volver</a></li>
    </ul>
</div>
<form method="POST" action="{{ route('criador.enviarCorreo') }}" class="formulario">
    @csrf
    <label for="destinatario">Correo Electrónico del Administrador</label>
    <input id="destinatario" type="email" class="form-control" name="destinatario" required>
    <br>
    <br>
    <label for="asunto">Asunto</label>
    <input id="asunto" type="text" class="form-control" name="asunto" required>
    <br>
    <br>
    <label for="mensaje">Mensaje</label>
    <textarea id="mensaje" class="form-control" name="mensaje" rows="8" style="width: 105%;" required></textarea>
    <br>
    <br>
    <input type="submit" title="Botón Editar" value="Enviar Correo">
</form>
@endsection
