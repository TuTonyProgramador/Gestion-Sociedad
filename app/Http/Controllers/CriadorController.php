<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criador;
use App\Models\Canario;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCorreoMailable;

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
                // Si el usuario es administrador, redirige a la vista de administrador
                return redirect()->route('criador.menu');
            } else {
                // Si el usuario no es administrador, redirige a la vista de usuario normal (showCanarioAdmin)
                return redirect()->route('canario.showCanA');
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

    /*
    Función para realizar una búsqueda de criadores.
    Recibe: un objeto de tipo Request con la solicitud HTTP.
    Devuelve: la vista criador.resultados_busqueda.
    */
    public function search(Request $request) {
        // Obtener el término de búsqueda del formulario
        $query = $request->input('buscador');
    
        // Buscar los criadores que coincidan con el término de búsqueda
        $criadores = Criador::where('numeroCriador', 'LIKE', '%' . $query . '%')
                            ->orWhere('nombre', 'LIKE', '%' . $query . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $query . '%')
                            ->orWhere('localidad', 'LIKE', '%' . $query . '%')
                            ->get();
    
        // Devolver solo los resultados de la búsqueda en formato HTML
        return view('criador.resultados_busqueda', compact('criadores'));
    }

    /*
    Función para mostrar el formulario de envío de correo electrónico.
    Recibe: nada
    Devuelve: la vista 'criador.formularioCorreo' con el formulario para enviar correo electrónico.
    */
    public function formularioCorreo() {
        return view('criador.formularioCorreo');
    }

    /*
    Función para procesar el envío de correo electrónico.
    Recibe: un objeto de tipo Request con los datos del formulario de envío de correo.
    Devuelve: una redirección a la aplicación de correo con los datos prellenados, o redirecciona de vuelta al formulario con un mensaje de error.
    */
    public function enviarCorreo(Request $request) {
        // Validamos los datos del formulario
        $request->validate([
            'destinatario' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required',
        ]);
    
        // Obtienemos los datos del formulario
        $destinatario = $request->input('destinatario');
        $asunto = $request->input('asunto');
        $mensaje = $request->input('mensaje');
    
        try {
            // Creamos el enlace para abrir la aplicación de Gmail con el correo del administrador predeterminado
            $url = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($destinatario) . '&su=' . urlencode($asunto) . '&body=' . urlencode($mensaje);
    
            // Redirigimos al usuario a la aplicación de Gmail con el enlace
            return redirect()->away($url);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al abrir la aplicación de Gmail.');
        }
    } 
}