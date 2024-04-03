<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concurso;
use App\Models\Criador;
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
        // Obtiene el admin asociado al usuario autenticado
        $admin = Auth::user();

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
        // Actualiza los datos del concurso
        $concurso->update($request->all());

        return redirect()->route('concurso.showCon');
    }

    /*
    Función para eliminar un concurso de la base de datos.
    Recibe: un objeto de tipo Concurso 
    Devuelve: la vista 'concurso.showCon' 
    */
    public function destroy(Concurso $concurso) {
        // Elimina el concurso de la base de datos
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
        
        return view('concurso.canariosConcurso', compact('concurso', 'canarios'));
    }

    /*
    Función para mostrar los canarios por concurso del criador autenticado.
    Recibe: nada
    Devuelve: la vista 'concurso.canariosCriador' 
    */
    public function canariosCriador(){
        // Obtenemos el criador actualmente autenticado
        $criador = Auth::user(); 
        
        // Obtenemos los concursos del criador actual, con los canarios asociados a cada concurso
        $concursos = $criador->concursos()->with('canarios')->get();
        
        return view('concurso.canariosCriador', compact('concursos'));
    }

}
