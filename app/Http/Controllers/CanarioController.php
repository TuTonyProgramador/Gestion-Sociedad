<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canario;
use App\Models\Criador;
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
        return view('canario.createCanario');
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
    
            // Comprobamos si el canario va a participar en un concurso
            $vaConcurso = $request->has('vaConcurso') ? 1 : 0;
    
            // Creamos un nuevo canario con los datos proporcionados 
            $canario = Canario::create(array_merge($request->all(), ['vaConcurso' => $vaConcurso]));
    
            if ($request->has('vaConcurso')) {
                // Asociar el canario con el concurso mediante la tabla canario_concurso
                $canario->concursos()->attach($criador->id);
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
        return view('canario.editCanario', compact('canario'));
    }
    
    /*
    Función para actualizar los datos de un canario en la base de datos.
    Recibe: un objeto de tipo Request con los nuevos datos del canario
    Recibe: un objeto de tipo Canario a actualizar
    Devuelve: la vista 'canario.showCan' 
    */
    public function update(Request $request, Canario $canario) {
        // Obtenemos el criador autenticado
        $criador = Auth::user();

        // Verifica si el checkbox está marcado y establece el valor de vaConcurso en consecuencia
        $request->merge(['vaConcurso' => $request->has('vaConcurso') ? 1 : 0]);
    
        // Actualiza los datos del canario
        $canario->update($request->all());
    
        // Si el checkbox está marcado, lo asociamos a la tabla intermedia
        if ($request->input('vaConcurso')) {
            // Asociar el canario con el concurso mediante la tabla canario_concurso
            $canario->concursos()->attach($criador->id);
        } else {
            // Si el checkbox no está marcado, desasociamos el canario de todos los concursos
            $canario->concursos()->detach();
        }
    
        if ($criador->esAdmin) {
            // Si el usuario es un administrador, redirigir a la vista showCanA
            return redirect()->route('canario.showCanA');
        } else {
            // Si el usuario no es un administrador, redirigir a la vista showCan
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
}