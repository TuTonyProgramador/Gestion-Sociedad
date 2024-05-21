<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concurso;
use App\Models\Criador;
use App\Models\Canario;
use Illuminate\Support\Facades\Auth;

class ConcursoController extends Controller
{
    /*
    Funcion para mostrar la vista de los concursos (solo lectura)
    Recibe: nada
    Devuelve: la vista 'concurso.showConcursoLectura'
    */
    public function showConL() {
        // Recuperamos los concursos de la base de datos
        $concursos = Concurso::all();
        return view('concurso.showConcursoLectura', compact('concursos'));
    }

    /*
    Funcion para mostrar la vista de los concursos para admin (editar y eliminar)
    Recibe: nada
    Devuelve: la vista 'concurso.showConcurso'
    */
    public function showCon() {
        // Recuperamos los concursos de la base de datos
        $concursos = Concurso::all();
        return view('concurso.showConcurso', compact('concursos'));
    }

    /*
    Funcion para mostrar la vista del crear un concurso
    Recibe: nada
    Devuelve: la vista 'concurso.createConcurso'
    */
    public function create() {
        return view('concurso.createConcurso');
    }

    /*
    Funcion para crear un concurso
    Recibe: un objeto de tipo Request
    Devuelve: la vista 'concurso.showCon' si se ha creado correctamente
    Devuelve: la vista del crear concurso si hay algun error
    */
    public function store(Request $request){
        // Obtienemos el admin asociado al usuario autenticado
        $admin = Auth::user();
    
        // Verificamos si existe un concurso con la misma fecha, sede y ubicación
        $existeConcurso = Concurso::where('fechaConcurso', $request->fechaConcurso)
                                    ->where('sede', $request->sede)
                                    ->where('ubicacion', $request->ubicacion)
                                    ->first();
    
        if ($existeConcurso) {
            return redirect()->back()->with('error', 'Ya existe un concurso con la misma fecha, sede y ubicación.');
        } 
    
        // Verificamos si existe una sede y ubicación registradas en otro concurso
        $existeSedeUbicacion = Concurso::where('sede', $request->sede)
                                          ->where('ubicacion', $request->ubicacion)
                                          ->exists();
    
        if ($existeSedeUbicacion) {
            return redirect()->back()->with('error', 'Ya existe un concurso con la misma sede y ubicación.');
        }
    
        // Creamos el nuevo concurso
        Concurso::create($request->all());
    
        return redirect()->route('concurso.showCon');
    }

    /*
    Función para mostrar el formulario de edición de un concurso.
    Recibe: un objeto de tipo Concurso
    Devuelve: la vista 'concurso.editConcurso' con los datos del concurso
    */
    public function edit(Concurso $concurso) {
        return view('concurso.editConcurso', compact('concurso'));
    }
    
    /*
    Función para actualizar los datos de un concurso en la base de datos.
    Recibe: un objeto de tipo Request con los nuevos datos del concurso
    Recibe: un objeto de tipo COncurso a actualizar
    Devuelve: la vista 'concurso.showCon' 
    */
    public function update(Request $request, Concurso $concurso) {
        // Actualizamos los datos del concurso
        $concurso->update($request->all());

        return redirect()->route('concurso.showCon');
    }

    /*
    Función para eliminar un concurso de la base de datos.
    Recibe: un objeto de tipo Concurso 
    Devuelve: la vista 'concurso.showCon' 
    */
    public function destroy(Concurso $concurso) {
        // Eliminamos el concurso de la base de datos
        $concurso->delete();
    
        return redirect()->route('concurso.showCon');
    }

    /*
    Función para mostrar los canarios asociados a un concurso específico.
    Recibe: un objeto de tipo Concurso
    Devuelve: la vista 'concurso.canariosConcurso' 
    */

    public function canariosConcurso(Concurso $concurso) {
        // Obtenemos los canarios asociados a este concurso específico
        $canarios = $concurso->canarios;
        
        // Obtenemos valores únicos para los filtros
        $sexos = $canarios->pluck('sexo')->unique();
        $anillas = $canarios->pluck('numeroAnilla')->unique();
        $nacimientos = $canarios->pluck('anioNacimiento')->unique();
        $criadores = $canarios->pluck('criador.numeroCriador')->unique();
        
        return view('concurso.canariosConcurso', compact('concurso', 'canarios', 'sexos', 'anillas', 'nacimientos', 'criadores'));
    }
    
    /*
    Función para mostrar los canarios por concurso del criador autenticado.
    Recibe: nada
    Devuelve: la vista 'concurso.canariosCriador' 
    
    public function canariosCriador(){
        // Obtenemos el criador actualmente autenticado
        $criador = Auth::user(); 
        
        // Obtenemos todos los concursos
        $concursos = Concurso::with(['canarios' => function($query) use ($criador) {
            // Filtramos los canarios para que solo sean los asociados con el criador actual
            $query->where('criador_id', $criador->id);
        }])->get();
        
        // Verificamos si no hay ningún canario asociado en ningún concurso
        $sinCanarios = $concursos->pluck('canarios')->collapse()->isEmpty();
        
        return view('concurso.canariosCriador', compact('concursos', 'sinCanarios'));
    }*/


    public function canariosCriador(Request $request) {
        // Obtenemos el criador actualmente autenticado
        $criador = Auth::user();
        
        // Obtener todos los números de anilla asociados al criador que están en concursos
        $anillas = Canario::where('criador_id', $criador->id)
            ->whereHas('concursos') // Asegúrate de que hay una relación definida en el modelo Canario con concursos
            ->pluck('numeroAnilla')
            ->unique();
        
        // Obtener todos los concursos
        $concursosQuery = Concurso::with(['canarios' => function($query) use ($criador) {
            // Filtramos los canarios para que solo sean los asociados con el criador actual y que están en concursos
            $query->where('criador_id', $criador->id);
        }]);
        
        // Filtrar por número de anilla si se proporciona
        if ($request->has('numero_anilla') && !empty($request->numero_anilla)) {
            $concursosQuery->whereHas('canarios', function ($query) use ($request) {
                $query->where('numeroAnilla', $request->numero_anilla);
            });
        }
        
        // Filtrar por ID de concurso si se proporciona
        if ($request->has('concurso_id') && !empty($request->concurso_id)) {
            $concursosQuery->where('id', $request->concurso_id);
        }
        
        // Obtener los resultados
        $concursos = $concursosQuery->get();
        
        // Verificamos si no hay ningún canario asociado en ningún concurso
        $sinCanarios = $concursos->pluck('canarios')->collapse()->isEmpty();
        
        return view('concurso.canariosCriador', compact('concursos', 'sinCanarios', 'anillas'));
    }
    
    
}
