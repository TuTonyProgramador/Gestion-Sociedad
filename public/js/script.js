/*
  Funcion que verifica si existe una cookie de visitas. 
  Recibe: nada
  Devuelve: nada
*/
function checkCookie() {
    // Obtienemos el valor de la cookie visitas
    var visitas = getCookie("visitas"); 
    // Verificamos si la cookie existe
    if (visitas != "") {
        visitas++;
        // Actualizamos el elemento con un nuevo valor de visitas
        document.getElementById("numeroVeces").innerText = visitas;
        // Actualizamos la cookie con el nuevo valor y la misma duración
        setCookie("visitas", visitas, 365);
    } else {
        // Si la cookie no existe, creamos una nueva con valor inicial 1 y duración de 365 días
        setCookie("visitas", 1, 365);
        // Actualizamos el elemento con el valor inicial de visitas
        document.getElementById("numeroVeces").innerText = 1;
    }
}

/*
  Funcion que se utiliza para establecer una cookie en el navegador del usuario
  Recibe: una string que es nombre de la cookie cname
  Recibe: una string que es el valor de la cookie cvalue
  Recibe: una numero que es la duracion de la cookie exdays
  Devuelve: nada
*/
function setCookie(cname, cvalue, exdays) {
    // Obtenemos la fecha actual
    const date = new Date();
    // Añadimos la duración en días a la fecha actual para obtener la fecha de expiración
    date.setTime(date.getTime() + (exdays * 24 * 60 * 60 * 1000));
    // Formateamos la fecha de expiración 
    let expires = "expires=" + date.toUTCString();
    // Establecemos la cookie con el nombre, valor y fecha de expiración
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/*
  Funcion que obtiene el valor de una cookie por su nombre.
  Recibe: una string que es nombre de la cookie cname
  Devuelve: una string
*/
function getCookie(cname) {
    // Creamos una cadena con el nombre de la cookie 
    let name = cname + "=";
    // Dividimos la cadena de cookies en partes individuales
    let cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        // Verificamos si la cookie actual comienza con el nombre buscado
        if (cookie.indexOf(name) == 0) {
            // Si coincide, devuelvemos el valor de la cookie
            return cookie.substring(name.length, cookie.length);
        }
    }
    return "";
}

/*
  Funcion que carga un archivo JSON desde el servidor y crea una tabla con los datos obtenidos.
  Recibe: nada
  Devuelve: nada
*/
function cargarJSON() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            // Almacenamos los datos del foro
            datosForo = JSON.parse(xhttp.responseText);
            // Llamamos a la funcion crearTabla para crear la tabla con los datos cargados
            crearTabla(datosForo); 
        } 
    };

    // Realizamos una solicitud GET para obtener los datos del JSON
    xhttp.open("GET", "/json/foro.json", true);
    xhttp.send(); 
}

/*
  Función que crea una tabla HTML a partir de un array de objetos JSON.
  Recibe: un array de objetos JSON datos.
  Devuelve: nada
*/
function crearTabla(datos) {
    // Obtener la referencia al elemento de la tabla en el documento HTML
    var tabla = document.getElementById('tabla');

    // Recorrer los datos y crear filas y celdas para la tabla
    for (let i = 0; i < datos.length; i++) {
        var fila = document.createElement('tr'); // Creamos una nueva fila para la tabla

        // Recorrer las columnas y crear celdas 
        for (let j = 0; j < Object.keys(datos[i]).length; j++) {
            var celda = document.createElement('td'); // Creamos una nueva celda para la fila
            celda.textContent = datos[i][Object.keys(datos[i])[j]]; // Asignamos el valor de la celda
            fila.appendChild(celda); // Agregamos la celda a la fila
        }

        tabla.appendChild(fila); // Agregamos la fila a la tabla
    }
}

window.onload = function() { 
    checkCookie();
    cargarJSON();
}

// Inicializar el gráfico de barras

// Obtener los datos de los canarios por año del atributo 'data-canarios' del script actual
var canariosPorAnio = JSON.parse(document.currentScript.getAttribute('data-canarios'));

// Extraer las etiquetas y los datos del array de objetos canariosPorAnio
var labels = canariosPorAnio.map(function(data) {
    return data.anio;
});

var data = canariosPorAnio.map(function(data) {
    return data.total;
});

// Obtener el contexto del lienzo del gráfico en el documento HTML
var ctx = document.getElementById('graficoCanariosPorAnio').getContext('2d');

// Crear un nuevo gráfico de barras utilizando Chart.js
var myChart = new Chart(ctx, {
    type: 'bar', // Tipo de gráfico: barras
    data: {
        labels: labels, // Etiquetas en el eje X (años)
        datasets: [{
            label: 'Canarios por Año', // Etiqueta de la serie de datos
            data: data, // Datos de la serie de datos (cantidad de canarios por año)
        }]
    },
    options: {
        scales: {
            y: { // Configuración del eje Y
                beginAtZero: true, // Iniciar el eje Y desde cero
                max: 100, // Establecer el máximo del eje Y en 100
                ticks: {
                    stepSize: 5, // Establecer el paso en la escala Y a 5
                }
            }
        }
    }
});


/*
  Función para validar los datos de un formulario relacionado con canarios.
  Recibe: un elemento de entrada de formulario (input).
  Devuelve: un mensaje de error si la validación falla, de lo contrario, devuelve una cadena vacía.
*/
function validacionCanarios(input) {
    // Obtiene el valor del input
    var valorInput = input.value; 

    // Variable para almacenar mensajes de error
    var error = ""; 

    // Switch para manejar la validación según el id del input
    switch (input.id) {
         // Validación del nombre de la raza
        case 'nombreRaza':
            // Comprueba si el valor contiene solo letras y espacios
            if (!/^[a-zA-Z\sñÑ]+$/.test(valorInput)) {
                error = "El campo nombre de raza no es válido.";
            }           
            break;
        // Validación del año de nacimiento
        case 'anioNacimiento':
            // Convierte el valor a un número entero
            var valorNumerico = parseInt(valorInput);
            // Comprueba si es un número y si está dentro del rango permitido
            if (isNaN(valorNumerico) || valorNumerico < 2015 || valorNumerico > new Date().getFullYear()) {
                error = "El año de nacimiento no es válido.";
            }
            break;
        // Validación del sexo
        case 'sexo':
            // Comprueba si el valor está en blanco
            if (valorInput.trim() === '') {
                error = "El campo sexo es obligatorio.";
            } 
            // Comprueba si el valor contiene solo letras y espacios
            else if (!/^[a-zA-Z\sñÑ]+$/.test(valorInput)) {
                error = "El campo sexo no es válido.";
            }            
            break;
        // Validación del número de anilla
        case 'numeroAnilla':
            // Comprueba si el valor está en blanco
            if (valorInput.trim() === '') {
                error = "El número de anilla es obligatorio.";
            }
            break;
        // Validación de la descripción
        case 'descripcion':
            // Comprueba si el valor está en blanco
            if (valorInput.trim() === '') {
                error = "El campo descripción es obligatorio.";
            } 
            // Comprueba si el valor contiene solo letras y espacios
            else if (!/^[a-zA-Z\sñÑ]+$/.test(valorInput)) {
                error = "El campo descripcion no es válido.";
            }            
            break;
    }

    // Muestra el mensaje de error correspondiente en el elemento HTML
    document.getElementById(input.id + '-error').innerText = error;
    
    // Devuelve el mensaje de error (puede estar vacío si no hay error)
    return error;
} 

/*
  Función para validar un formulario relacionado con canarios antes de su envío.
  Recibe: nada
  Devuelve: true si el formulario es válido y puede ser enviado, false si hay errores.
*/
function validarFormularioCanarios() {
    // Obtener referencias a los campos del formulario
    var nombreRazaInput = document.getElementById('nombreRaza');
    var anioNacimientoInput = document.getElementById('anioNacimiento');
    var sexoInput = document.getElementById('sexo');
    var numeroAnillaInput = document.getElementById('numeroAnilla');
    var descripcionInput = document.getElementById('descripcion');

    // Validar cada campo individualmente
    var nombreRazaError = validacionCanarios(nombreRazaInput);
    var anioNacimientoError = validacionCanarios(anioNacimientoInput);
    var sexoError = validacionCanarios(sexoInput);
    var numeroAnillaError = validacionCanarios(numeroAnillaInput);
    var descripcionError = validacionCanarios(descripcionInput);

    // Mostrar los mensajes de error en el formulario
    document.getElementById('nombreRaza-error').innerText = nombreRazaError;
    document.getElementById('anioNacimiento-error').innerText = anioNacimientoError;
    document.getElementById('sexo-error').innerText = sexoError;
    document.getElementById('numeroAnilla-error').innerText = numeroAnillaError;
    document.getElementById('descripcion-error').innerText = descripcionError;

    // Verificar si hay algún error en los campos
    if (nombreRazaError || anioNacimientoError || sexoError || numeroAnillaError || descripcionError) {
        // Si hay algún error, evitar que se envíe el formulario
        return false;
    } else {
        // Si no hay errores, permitir el envío del formulario
        return true;
    }
} 

/*
  Función para validar los datos de un formulario relacionado con concursos.
  Recibe: un elemento de entrada de formulario (input).
  Devuelve: un mensaje de error si la validación falla, de lo contrario, devuelve una cadena vacía.
*/
function validacionConcursos(input) {
    // Obtener el valor del input
    var valorInput = input.value; 

    // Variable para almacenar mensajes de error
    var error = ""; 

    // Switch para manejar la validación según el id del input
    switch (input.id) {
        // Validación de la fecha del concurso
        case 'fechaConcurso':
            // Comprobar si el valor está en blanco
            if (valorInput.trim() === '') {
                error = "El campo fecha de concurso es obligatorio.";
            } else {
                // Obtener la fecha actual
                var fechaActual = new Date();
                
                // Convertir la fecha ingresada a un objeto Date
                var fechaIngresada = new Date(valorInput);
                
                // Comparar las fechas
                if (fechaIngresada < fechaActual) {
                    error = "La fecha de concurso no puede ser anterior a la fecha actual.";
                }
            }
            break;
        // Validación de la sede del concurso
        case 'sede':
            // Comprobar si el valor está en blanco
            if (valorInput.trim() === '') {
                error = "El campo sede no puede estar vacío.";
            } else if (!/^[a-zA-Z\sñÑ]+$/.test(valorInput)) {
                error = "El campo sede no es válido";
            }
            break;
        // Validación de la ubicación del concurso
        case 'ubicacion':
            // Comprobar si el valor está en blanco
            if (valorInput.trim() === '') {
                error = "El campo ubicacion es obligatorio.";
            } else if (!/^[a-zA-Z\sñÑ]+$/.test(valorInput)) {
                error = "El campo ubicacion no es válido";
            }            
            break;
    }

    // Mostrar el mensaje de error correspondiente en el elemento HTML
    document.getElementById(input.id + '-error').innerText = error;

    // Devolver el mensaje de error (puede estar vacío si no hay error)
    return error;
}

/*
  Función para validar un formulario relacionado con concursos antes de su envío.
  Recibe: nada
  Devuelve: true si el formulario es válido y puede ser enviado, false si hay errores.
*/
function validarFormularioConcursos() {
    // Obtener referencias a los campos del formulario de Concursos
    var fechaConcursoInput = document.getElementById('fechaConcurso');
    var sedeInput = document.getElementById('sede');
    var ubicacionInput = document.getElementById('ubicacion');

    // Validar cada campo individualmente
    var fechaConcursoError = validacionConcursos(fechaConcursoInput);
    var sedeError = validacionConcursos(sedeInput);
    var ubicacionError = validacionConcursos(ubicacionInput);

    // Mostrar los mensajes de error en el formulario de Concursos
    document.getElementById('fechaConcurso-error').innerText = fechaConcursoError;
    document.getElementById('sede-error').innerText = sedeError;
    document.getElementById('ubicacion-error').innerText = ubicacionError;

    // Verificar si hay algún error en los campos de Concursos
    if (fechaConcursoError || sedeError || ubicacionError) {
        // Si hay algún error en Concursos, evitar que se envíe el formulario
        return false;
    } else {
        // Si no hay errores en Concursos, permitir el envío del formulario
        return true;
    }
}


/*
  Función para validar los datos de un formulario relacionado con la creación y edición de criadores.
  Recibe: un elemento de entrada de formulario (input).
  Devuelve: un mensaje de error si la validación falla, de lo contrario, devuelve una cadena vacía.
*/
function validacionCriador(input) {
    // Obtener el valor del input
    var valorInput = input.value; 
    // Variable para almacenar mensajes de error
    var error = ""; 

    // Switch para manejar la validación según el id del input
    switch (input.id) {
        // Validación del número de criador
        case 'numC':
            if (valorInput.trim() === '') {
                error = "El campo número criador es obligatorio.";
            } else if (!/^.{1,6}$/.test(valorInput)) {
                error = "El número de criador debe contener de 1 a 6 caracteres alfanuméricos.";
            }
            break;
            // Validación del nombre
        case 'nombre':
            if (valorInput.trim() === '') {
                error = "El campo nombre es obligatorio.";
            } else if (!/^[a-zA-ZñÑ\s]+$/.test(valorInput)) {
                error = "El nombre solo puede contener letras y espacios.";
            }
            break;
            // Validación de los apellidos
        case 'apellidos':
            if (valorInput.trim() === '') {
                error = "El campo apellidos es obligatorio.";
            } else if (!/^[a-zA-ZñÑ\s]+$/.test(valorInput)) {
                error = "Los apellidos solo pueden contener letras y espacios.";
            }
            break;
            // Validación de la fecha de nacimiento
        case 'fechaNacimiento':
            if (valorInput.trim() === '') {
                error = "El campo fecha de nacimiento es obligatorio.";
            } else {
                var fechaActual = new Date();
                var fechaIngresada = new Date(valorInput);
                var edadMinima = new Date(fechaActual.getFullYear() - 10, fechaActual.getMonth(), fechaActual.getDate());
                var edadMaxima = new Date(fechaActual.getFullYear() - 100, fechaActual.getMonth(), fechaActual.getDate());
                
                if (fechaIngresada > fechaActual) {
                    error = "La fecha de nacimiento no puede ser posterior a la fecha actual.";
                } else if (fechaIngresada > edadMinima) {
                    error = "El criador debe tener al menos diez años de edad.";
                } else if (fechaIngresada < edadMaxima) {
                    error = "La fecha de nacimiento no puede ser mayor a 100 años antes de la fecha actual.";
                }
            }
            break;
            // Validación de la localidad
        case 'localidad':
            if (valorInput.trim() === '') {
                error = "El campo localidad es obligatorio.";
            } else if (!/^[a-zA-ZñÑ\s]+$/.test(valorInput)) {
                error = "La localidad solo puede contener letras y espacios.";
            }
            break;
            // Validación de la contraseña
        case 'password':
            if (valorInput.trim() === '') {
                error = "El campo contraseña es obligatorio.";
            } else if (valorInput.length < 8) {
                error = "La contraseña debe tener al menos 8 caracteres.";
            }
            break;
            // Validación del email
        case 'email':
            if (valorInput.trim() === '') {
                error = "El campo email es obligatorio.";
            } else if (!/\S+@\S+\.\S+/.test(valorInput)) {
                error = "Ingrese un email válido.";
            }
            break;
            // Validación del teléfono
        case 'telefono':
            if (valorInput.trim() === '') {
                error = "El campo teléfono es obligatorio.";
            } else if (!/^\d{9}$/.test(valorInput)) {
                error = "El teléfono debe contener 9 dígitos numéricos.";
            }
            break;
    }

    // Mostrar el mensaje de error correspondiente en el elemento HTML
    document.getElementById(input.id + '-error').innerText = error;

    return error;
}

/*
  Función para validar un formulario de registro de criadores antes de su envío.
  Recibe: nada
  Devuelve: true si el formulario es válido y puede ser enviado, false si hay errores.
*/
function validarFormularioCriador() {
    // Obtener referencias a los campos del formulario de registro de criadores
    var numCInput = document.getElementById('numC');
    var nombreInput = document.getElementById('nombre');
    var apellidosInput = document.getElementById('apellidos');
    var fechaNacimientoInput = document.getElementById('fechaNacimiento');
    var localidadInput = document.getElementById('localidad');
    var passwordInput = document.getElementById('password');
    var emailInput = document.getElementById('email');
    var telefonoInput = document.getElementById('telefono');

    // Validar cada campo individualmente
    var numCError = validacionCriador(numCInput);
    var nombreError = validacionCriador(nombreInput);
    var apellidosError = validacionCriador(apellidosInput);
    var fechaNacimientoError = validacionCriador(fechaNacimientoInput);
    var localidadError = validacionCriador(localidadInput);
    var passwordError = validacionCriador(passwordInput);
    var emailError = validacionCriador(emailInput);
    var telefonoError = validacionCriador(telefonoInput);

    // Mostrar los mensajes de error en el formulario de registro de criadores
    document.getElementById('numC-error').innerText = numCError;
    document.getElementById('nombre-error').innerText = nombreError;
    document.getElementById('apellidos-error').innerText = apellidosError;
    document.getElementById('fechaNacimiento-error').innerText = fechaNacimientoError;
    document.getElementById('localidad-error').innerText = localidadError;
    document.getElementById('password-error').innerText = passwordError;
    document.getElementById('email-error').innerText = emailError;
    document.getElementById('telefono-error').innerText = telefonoError;

    // Verificar si hay algún error en los campos del formulario de registro de criadores
    if (numCError || nombreError || apellidosError || fechaNacimientoError || localidadError || passwordError || emailError || telefonoError) {
        // Si hay algún error, evitar que se envíe el formulario
        return false;
    } else {
        // Si no hay errores, permitir el envío del formulario
        return true;
    }
} 

/*
  Función para validar un formulario de edición de criadores antes de su envío.
  Recibe: nada
  Devuelve: true si el formulario es válido y puede ser enviado, false si hay errores.
*/
function validarFormularioEditCriador() {
    // Obtener referencias a los campos del formulario de edición de criadores
    var nombreInput = document.getElementById('nombre');
    var apellidosInput = document.getElementById('apellidos');
    var fechaNacimientoInput = document.getElementById('fechaNacimiento');
    var localidadInput = document.getElementById('localidad');
    var emailInput = document.getElementById('email');
    var telefonoInput = document.getElementById('telefono');
    var esAdminInput = document.getElementById('esAdmin');

    // Validar cada campo individualmente
    var nombreError = validacionCriador(nombreInput);
    var apellidosError = validacionCriador(apellidosInput);
    var fechaNacimientoError = validacionCriador(fechaNacimientoInput);
    var localidadError = validacionCriador(localidadInput);
    var emailError = validacionCriador(emailInput);
    var telefonoError = validacionCriador(telefonoInput);
    var esAdminError = ''; 

    // Mostrar los mensajes de error en el formulario de edición de criadores
    document.getElementById('nombre-error').innerText = nombreError;
    document.getElementById('apellidos-error').innerText = apellidosError;
    document.getElementById('fechaNacimiento-error').innerText = fechaNacimientoError;
    document.getElementById('localidad-error').innerText = localidadError;
    document.getElementById('email-error').innerText = emailError;
    document.getElementById('telefono-error').innerText = telefonoError;
    // Es posible que quieras mostrar un mensaje de error específico para esAdmin si es necesario

    // Verificar si hay algún error en los campos del formulario de edición de criadores
    if (nombreError || apellidosError || fechaNacimientoError || localidadError || emailError || telefonoError || esAdminError) {
        // Si hay algún error, evitar que se envíe el formulario
        return false;
    } else {
        // Si no hay errores, permitir el envío del formulario
        return true;
    }
} 
