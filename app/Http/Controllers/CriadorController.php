<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criador;
use App\Models\Canario;
use Illuminate\Support\Facades\Auth; 

class CriadorController extends Controller
{
    /*
    Funcion para mostrar la vista de la sesion del criador
    Recibe: nada
    Devuelve: la vista 'criador.sesionCriador'
    */
    public function sesionC() {
        return view('criador.sesionCriador');
    }

    /*
    Funcion para mostrar la vista de la sesion del admin
    Recibe: nada
    Devuelve: la vista 'criador.sesionAdmin'
    */
    public function sesionA() {
        return view('criador.sesionAdmin');
    }

    /*
    Funcion para mostrar la vista de la sesion del admin
    Recibe: nada
    Devuelve: la vista 'criador.sesionAdmin'
    */
    public function menu() {
        $criador = Auth::user();
        return view('criador.menuOpcion', compact('criador'));
    }

    /*
    Funcion para mostrar la vista de los criadores para admin (editar y eliminar)
    Recibe: nada
    Devuelve: la vista 'criador.showCriador'
    */
    public function showC() {
        // Recuperamos los criadores de la base de datos
        $criadores = Criador::all();
        return view('criador.showCriador', compact('criadores'));
    }

    /*
    Funcion para mostrarle a un criador sus datos 
    Recibe: nada
    Devuelve: la vista 'criador.showCriadorLectura'
    */
    public function showCL() {
        // Obtenemos el usuario autenticado 
        $criador = Auth::user(); 
        return view('criador.showCriadorLectura', compact('criador'));
    }

    /*
    Funcion para mostrarle a un criador sus datos 
    Recibe: un objeto de tipo Request
    Devuelve: la vista 'criador.menu' si el usuario es administrador
    Devuelve: la vista 'criador.showCanario' si el usuario no es administrador
    Devuelve: la vista 'criador.sesionC' si las credenciales son incorrectas
    */
    public function login(Request $request) {
        // Validamos las credenciales proporcionadas en la solicitud
        $credenciales = $request->validate([
            'numeroCriador' => 'required',
            'password' => 'required',
        ]);
        
        // Intentamos autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credenciales)) {
            // Obtenemos el usuario autenticado
            $criador = Auth::user(); 
             // Obtenemos los canarios asociados al criador autenticado
            $canarios = $criador->canarios()->get();
            
            // Comprobamos si el usuario es administrador
            if ($criador->esAdmin) {
                // Si el usuario es administrador, redirige a una vista de administrador
                return redirect()->route('criador.menu');
            } else {
                // Si el usuario no es administrador, redirige a una vista de usuario normal
                return view('canario.showCanario', compact('canarios')); 
            }
        }
        
        return redirect()->route('criador.sesionC')->with('error', 'Credenciales incorrectas')->withInput($request->only('numeroCriador'));
    }
    
    /*
    Funcion para mostrar la vista del crear o registrarse un criador 
    Recibe: nada
    Devuelve: la vista 'criador.createCriador'
    */
    public function create() {
        return view('criador.createCriador');
    }

    /*
    Funcion para crear un criador
    Recibe: un objeto de tipo Request
    Devuelve: la vista 'criador.sesionC' si se ha creado correctamente
    Devuelve: la vista del registro si hay algun error
    */
    public function store(Request $request) {
        try {
            // Creacion de un nuevo criador utilizando los datos de la solicitud
            Criador::create($request->all());

            return redirect()->route('criador.sesionC');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Este criador ya esta registrado');
        }
    }

    /*
    Función para mostrar el formulario de edición de un criador.
    Recibe: un objeto de tipo Criador
    Devuelve: la vista 'criador.editCriador' con los datos del criador
    */
    public function edit(Criador $criador) {
        return view('criador.editCriador', compact('criador'));
    }
    
    /*
    Función para actualizar los datos de un criador en la base de datos.
    Recibe: un objeto de tipo Request con los nuevos datos del criador
    Recibe: un objeto de tipo Criador a actualizar
    Devuelve: la vista 'criador.showC' 
    */
    public function update(Request $request, Criador $criador) {
        // Actualiza los datos del criador
        $criador->update($request->all());

        return redirect()->route('criador.showC');
    }

    /*
    Función para eliminar un criador de la base de datos.
    Recibe: un objeto de tipo Criador 
    Devuelve: la vista 'criador.showC' 
    */
    public function destroy(Criador $criador) {
        // Elimina el criador de la base de datos
        $criador->delete();
    
        return redirect()->route('criador.showC');
    }
}
