<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canario;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    /*
    Función para generar un gráfico de canarios por año.
    Recibe: nada.
    Devuelve: la vista 'graficos.graficoCanarios'.
    */
    public function graficoCanarios() {
        // Recuperamos los canarios y se agrupan por año
        $canariosPorAnio = Canario::select(DB::raw('YEAR(created_at) as anio'), DB::raw('count(*) as total'))
            ->groupBy('anio')
            ->get();

        return view('graficos.graficoCanarios', ['canariosPorAnio' => $canariosPorAnio]);
    }
}
