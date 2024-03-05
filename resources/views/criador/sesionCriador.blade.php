@extends('layout.plantilla')
@section('contenido')
    <br>
    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{route('criador.login')}}" method="POST" class="formulario">
        @csrf
        <label for="numeroCriador">Numero Criador: </label>
        <input type="text" name="numeroCriador" value="{{ old('numeroCriador') }}" required>
        <br>
        <br>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" required>
        <br>
        <br>
        <div class="centrar-botones"> 
            <input type="submit" value="Acceder">
            <a href="{{ route('layout.inicioCriador') }}"><input type="button" value="Volver"></a>
        </div>
        <div class="botones-container">
            <a href="{{ route('layout.olvido') }}">Forgot Password?</a>
        </div> 
    </form> 
@endsection