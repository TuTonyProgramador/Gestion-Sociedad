<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canario;
use App\Models\Criador;
use App\Models\Concurso;
use Illuminate\Support\Facades\Auth;

class CanarioController extends Controller
{
    /*
    Funcion para mostrarle al criador sus canarios (usuario normal)
    Recibe: nada
    Devuelve: la vista 'canario.showCanario'
    */
    public function showCan() {
        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Obtenemos todos los canarios asociados al usuario
        $canarios = $user->canarios;

        return view('canario.showCanario', compact('canarios'));
    }

    /*
    Funcion para mostrarle al criador sus canarios (usuario admin)
    Recibe: nada
    Devuelve: la vista 'canario.showCanarioAdmin'
    */
    public function showCanA() {
        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Obtenemos todos los canarios asociados al usuario
        $canarios = $user->canarios;

        return view('canario.showCanarioAdmin', compact('canarios'));
    }
    
    /*
    Funcion para mostrar la vista del crear un canario 
    Recibe: nada
    Devuelve: la vista 'canario.createCanario'
    */
    public function create() {
        $concursos = Concurso::all();
    
        return view('canario.createCanario', compact('concursos'));
    }
    
    /*
    Funcion para crear un canario
    Recibe: un objeto de tipo Request 
    Devuelve: la vista 'criador.showCanA' si el criador es Admin
    Devuelve: la vista 'criador.showCan' si el criador es normal
    Devuelve: la vista del crear el canario si hay algun error
    */
    public function store(Request $request) {
        try {
            // Obtenemos el criador autenticado
            $criador = Auth::user();
            
            // Comprobar si existe un canario con el mismo número de anilla, año y criador
            $existingCanario = Canario::where([
                'numeroAnilla' => $request->numeroAnilla,
                'anioNacimiento' => $request->anioNacimiento,
                'criador_id' => $criador->id
            ])->first();
    
            // Si existe un canario con las mismas características, mostramos un mensaje de error
            if ($existingCanario) {
                return redirect()->back()->with('error', 'Este canario ya existe');
            }
    
            // Obtenemos el valor del concurso seleccionado
            $concursoSeleccionado = $request->input('vaConcurso');
    
            // Creamos un nuevo canario con los datos proporcionados
            $canarioData = $request->except('vaConcurso');
            $canarioData['vaConcurso'] = $concursoSeleccionado;
            $canario = Canario::create($canarioData);
    
            if ($concursoSeleccionado) {
                // Asociar el canario con el concurso mediante el campo vaConcurso
                $canario->concursos()->attach($concursoSeleccionado);
            }
    
            // Comprobamos si el usuario es administrador
            if ($criador->esAdmin) {
                // Si el usuario es un administrador, redirigir a la vista showCanA
                return redirect()->route('canario.showCanA');
            } else {
                // Si el usuario no es un administrador, redirigir a la vista showCan
                return redirect()->route('canario.showCan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error');
        }
    }
    

    /*
    Función para mostrar el formulario de edición de un criador.
    Recibe: un objeto de tipo Canario
    Devuelve: la vista 'canario.editCanario' con los datos del canario
    */
    public function edit(Canario $canario) {
        $concursos = Concurso::all();

        return view('canario.editCanario', compact('canario'), compact('concursos'));
    }
    
    /*
    Función para actualizar los datos de un canario en la base de datos.
    Recibe: un objeto de tipo Request con los nuevos datos del canario
    Recibe: un objeto de tipo Canario a actualizar
    Devuelve: la vista 'canario.showCan' 
    */
    public function update(Request $request, Canario $canario) {
        // Actualiza los datos del canario, incluido el campo vaConcurso
        $canario->update($request->all());
    
        // Obtenemos el valor del concurso seleccionado
        $concursoSeleccionado = $request->input('vaConcurso');
    
        // Actualiza la relación en la tabla intermedia
        if ($concursoSeleccionado) {
            $canario->concursos()->sync([$concursoSeleccionado]);
        } else {
            $canario->concursos()->detach();
        }
    
        // Redirecciona según el rol del usuario
        if (Auth::user()->esAdmin) {
            return redirect()->route('canario.showCanA');
        } else {
            return redirect()->route('canario.showCan');
        }
    }
    
    /*
    Función para eliminar un canario de la base de datos.
    Recibe: un objeto de tipo Canario 
    Devuelve: la vista 'canario.showCan' 
    */
    public function destroy(Canario $canario) {
        // Obtenemos el criador autenticado
        $criador = Auth::user();

        // Desasocia el canario de la tabla concurso 
        $canario->concursos()->detach();

        // Elimina el canario de la base de datos
        $canario->delete();
    
        if ($criador->esAdmin) {
            // Si el usuario es un administrador, redirigir a la vista showCanA
            return redirect()->route('canario.showCanA');
        } else {
            // Si el usuario no es un administrador, redirigir a la vista showCan
            return redirect()->route('canario.showCan');
        }
    }

    /*
    Función para realizar una búsqueda de canarios.
    Recibe: la solicitud HTTP.
    Devuelve: la vista canario.resultados_busqueda.
    */
    public function search(Request $request) {
        // Obtener el término de búsqueda del formulario
        $query = $request->input('buscador');
    
        // Obtener el ID del criador autenticado
        $criador_id = Auth::id();
    
        // Inicializar la consulta para obtener todos los canarios del criador autenticado
        $canariosQuery = Canario::where('criador_id', $criador_id);
    
        // Verificar si hay un término de búsqueda
        if (!empty($query)) {
            // Si hay un término de búsqueda, aplicar filtros
            $canariosQuery->where(function($q) use ($query) {
                $q->where('nombreRaza', $query)
                  ->orWhere('numeroAnilla', $query)
                  ->orWhere('anioNacimiento', $query)
                  ->orWhere('sexo', $query)
                  ->orWhere('descripcion', $query);
            });
        }
    
        // Obtener los resultados de la búsqueda
        $canarios = $canariosQuery->get();
    
        // Devolver los resultados de la búsqueda en formato HTML
        return view('canario.resultados_busqueda', compact('canarios'));
    }
    
     
}