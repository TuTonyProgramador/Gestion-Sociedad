@extends('layout.plantilla')
<style>
body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 30px;
    background-color: #333;
    color: #fff;
}

.header h1 {
    margin: 0 auto;
    font-size: 30px;
}

.header img {
    width: 160px;
    height: auto;
    margin-right: 30px;
}

h2 {
    color: #333; 
    background-color: #f0f0f0; 
    margin-top: 0px;
    padding: 10px; 
    border-radius: 5px; 
    text-align: center; 
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
}

.cerrar-sesion {
    margin-left: auto;
}

/* Menú */
.container {
    margin: 0 auto; /* Centers the container horizontally */
    width: 80%; /* Adjust the width as needed */
    display: flex;
    flex-direction: column;
    align-items: center;
}

.menu {
    display: flex;
    justify-content: center;
    align-items: center; /* Center menu items vertically */
    margin: 20px 0; /* Adjusted margin */
}

.menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
}

.menu ul li {
    display: inline-block;
    margin-right: 10px;
}

.menu ul li:last-child {
    margin-right: 0;
}

.menu ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #f0f0f0;
    transition: background-color 0.3s ease;
}

.menu ul li a:hover {
    background-color: #ccc;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    color: #fff;
    background-color: #007bff;
}

th:hover {
    color: black;
    background-color: #0056b3;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

footer {
    margin-top: 3em; /* Margen superior */
    display: flex; /* Muestra los elementos flexibles */
    justify-content: space-around; /* Distribuye el espacio entre los elementos */
    align-items: center; /* Alinea los elementos al centro verticalmente */
    padding: 1.5em; /* Espaciado interno */
    text-align: center; /* Alineación del texto al centro */
    background-color: #333;
    color: white;
}

footer p {
    margin: 0; /* Elimina el margen predeterminado de los párrafos */
    text-align: center; /* Alinea el texto al centro */
}

footer p:first-child {
    text-align: center; /* Alinea el texto al centro */
    flex: 1; /* El primer párrafo ocupa todo el espacio disponible */
}

footer p:last-child {
    margin-left: auto; /* Mueve el último párrafo a la derecha */
}
</style>

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
            <li><a href="{{ route('concurso.showCon') }}" title="Botón Volver">Volver</a></li>
        </ul>
    </div>
    <div class="container">
        <h2>Canarios en el concurso: {{ $concurso->sede }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Numero de anilla</th>
                    <th scope="col">Nombre de la raza</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Año de nacimiento</th>
                    <th scope="col">Criador</th>
                </tr>
            </thead>
            <tbody>
                @foreach($canarios as $canario)
                    <tr>
                        <td>{{ $canario->numeroAnilla }}</td>
                        <td>{{ $canario->nombreRaza }}</td>
                        <td>{{ $canario->sexo }}</td>
                        <td>{{ $canario->anioNacimiento }}</td>
                        <td>{{ $canario->criador->numeroCriador }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection