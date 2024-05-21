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
        <li><a href="{{ route('canario.showCanA') }}" title="Botón Volver">Volver</a></li>
    </ul>
</div>

<h2>Canarios Registrados Por Año</h2>

<div class="grafico-container">
    <canvas id="graficoCanariosPorAnio"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../js/script.js" data-canarios="{{ $canariosPorAnio }}"></script> 

@endsection
